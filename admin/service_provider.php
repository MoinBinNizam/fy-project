<?php
require 'top.inc.php';
$operation = '';

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    if ($type == 'status') {
        $operation = get_safe_value($con, $_GET['operation']);
        $id = get_safe_value($con, $_GET['id']);
        if ($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $update_status_sql = "update service_provider set status ='$status'where id = '$id' ";
        mysqli_query($con, $update_status_sql);
    }

}

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from users where id = '$id' ";
        mysqli_query($con, $delete_sql);
    }
}
$sql = "SELECT * FROM `service_provider`order by id desc";
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
<div class="orders">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <div class="card-body">
                <h4 class="box-title">Service Provider</h4>
                 </div>
            <div class="card-body--">
                <div class="table-stats order-table ov-h">
                    <table class="table ">
                        <thead>
                        <tr>
                            <th class="serial">Serial</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
$i = 1;
while ($row = mysqli_fetch_assoc($res)) {?>
                        <tr>
                        <td class="serial">
                            <?php
echo $i++; ?>
                          </td>
                        <td><?php echo $row['name'] ?> </td>
                        <td><?php echo $row['email'] ?> </td>
                        <td><?php echo $row['mobile'] ?> </td>
                        <td><?php echo $row['address'] ?> </td>
                        <td>
                            <?php
if ($row['status'] == 1) {
    echo "<a href='?type=status&operation=deactive&id=" . $row['id'] . "'><span class='badge badge-complete'>Actived</span> &nbsp;</a>";
} else {
    echo "<a href='?type=status&operation=active&id=" . $row['id'] . "'><span class='badge badge-pending'>Deactived</span>&nbsp;</a>";
}
    ?>
                        </td>
                        </tr>
                            <?php }?>
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