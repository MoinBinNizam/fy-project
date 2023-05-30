<?php

// if(isset($_SESSION['SP_EMAIL'])){
//     //required pages should be in this block
require 'top.inc.php';
require_once 'connection.inc.php';
$operation = '';
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from users where id = '$id' ";
        mysqli_query($con, $delete_sql);
    }
}
$sql = "select * from users order by id desc";
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
<div class="orders">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <div class="card-body">
                <h4 class="box-title">Manage Orders</h4>
                 </div>
            <div class="card-body--">
                <div class="table-stats order-table ov-h">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="service-thumbnail">Order ID</th>
                            <th class="service-name"><span class="nobr"> Order Date</span></th>
                            <th class="service-name"><span class="nobr"> Cutomer</span></th>
                            <th class="service-name"><span class="nobr"> Service</span></th>
                            <th class="service-price"><span class="nobr"> Address </span></th>
                            <th class="service-stock-stauts"><span class="nobr"> Payment Type </span></th>
                            <th class="service-stock-stauts"><span class="nobr"> Payment Status </span></th>
                            <th class="service-stock-stauts"><span class="nobr"> Order Status </span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
$res = mysqli_query($con, "select `order`.*,order_status.name as order_status_str from
                         `order`,order_status where order_status.id=`order`.order_status order by `order`.id desc");

while ($row = mysqli_fetch_assoc($res)) {
    $order_id = $row["id"];
    $user_id = $row["user_id"];
    $sql = "SELECT * , users.name as `user_name` , services.name as `service_name` FROM `order_detail` ,`services` , `categories` , `users` WHERE order_detail.order_id = '$order_id' AND order_detail.services_id = services.id AND services.categories_id = categories.id AND users.id = '$user_id'";
    $res2 = mysqli_query($con, $sql);
    while ($row2 = mysqli_fetch_assoc($res2)) {
        $sp_id_db = $row2["service_provider_id"];
        if ($sp_id_db == $_SESSION['SP_ID']) {?>
                            <tr>
                                <td class="service-add-to-cart ">
                                <?php echo $row['id'] ?>
                                    </td>
                                <td class="service-name"><?php echo $row['added_on'] ?></td>
                                <td class="service-name">
                                    <?php echo $row2['user_name'] ?>
                                </td>
                                <td class="service-name"><?php echo $row2['service_name'] ?></td>
                                <td class="service-name">
                                    <?php echo $row['address'] ?>,
                                    <?php echo $row['city'] ?>,
                                    <?php echo $row['post_code'] ?>
                                </td>
                                <td class="service-name"><?php echo $row['payment_type'] ?></td>
                                <td class="service-name"><?php echo $row['payment_status'] ?></td>
                                <td class="service-name"><?php echo $row['order_status_str'] ?></td>

                            </tr>
                        <?php }}}?>

                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
require 'footer.inc.php';

?>