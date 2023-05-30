
<?php
require ('service_provider_top.inc.php');
$operation= '';
if(isset($_GET['type']) && $_GET['type'] != '' ){
    $type =get_safe_value ($con,$_GET['type']);
   
    if($type == 'delete'){
    $id=get_safe_value ($con,$_GET['id']);
    $delete_sql = "delete from users where id = '$id' ";
    mysqli_query($con, $delete_sql);
    }
}
?>
<div class="content pb-0">
<div class="orders">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <div class="card-body">
                <h4 class="box-title">Manage Order</h4>
                 </div>
            <div class="card-body--">
                <div class="table-stats order-table ov-h">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="service-thumbnail">Order ID</th>
                            <th class="service-name"><span class="nobr"> Order Date</span></th>
                            <th class="service-price"><span class="nobr"> Address </span></th>
                            <th class="service-stock-stauts"><span class="nobr"> Payment Type </span></th>
                            <th class="service-stock-stauts"><span class="nobr"> Payment Status </span></th>
                            <th class="service-stock-stauts"><span class="nobr"> Order Status </span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = 'select * from services WHERE services.service_provider_id=11';
                        $res=mysqli_query($con, $sql);
                        while ($row=mysqli_fetch_assoc($res)){
                            $service_id = $row["id"];
                            $sql = "select * from  `order`,order_status , order_detail where order.id = order_detail.order_id and order_status.id=`order`.order_status AND services_id ='$service_id'";
                            $res=mysqli_query($con, $sql);
                            while ($row=mysqli_fetch_assoc($res)){
                                    $order_id = $row["order_id"];
                                ?>

                            <tr>
                                <td class="service-add-to-cart ">
                                    <button type="button" class="btn btn-info"><a class="order_id" href="order_details.php?id=<?php echo $order_id ?>"> <?php echo $order_id ?></a></button>
                                    </td>
                                <td class="service-name"><?php echo $row['added_on'] ?></td>
                                <td class="service-name">
                                    <?php echo $row['address'] ?><br>
                                    <?php echo $row['city'] ?><br>
                                    <?php echo $row['post_code'] ?>

                                </td>
                                <td class="service-name"><?php echo $row['payment_type'] ?></td>
                                <td class="service-name"><?php echo $row['payment_status'] ?></td>
                                <td class="service-name"><?php echo $row['name'] ?></td>

                           </tr>




                            <?php }
                        }?>

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
require ('footer.inc.php');
/*
 SELECT * FROM `order` , `order_detail` , `order_status` , `services` WHERE order.id = order_detail.order_id AND order.order_status = order_status.id AND services.id = order_detail.services_id AND services.service_provider_id = 11
 * */
?>