<?php

// if(isset($_SESSION['SP_ID'])){
    //required pages should be in this block
require 'top.inc.php';
require_once 'connection.inc.php';

$userId = $_SESSION['SP_ID'];

$sql = "select services.*,categories.categories,locations.locations 
from services,categories,locations where
 services.categories_id=categories.id and services.locations_id=locations.id 
 and services.service_provider_id='{$userId}' order by services.id desc";


$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
<div class="orders">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <div class="card-body">
                <h3 class="box-title">Manage Service Gig </h3>
                <a href="add_services.php"> <button type="button" class="btn btn-primary">&plus; Create Gig</button></a>
            </div>
            <div class="card-body--">
                <table class="table ">
                    <thead>
                    <tr>
                        <th class="serial">Serial</th>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Name</th>
                        <th>Unit price</th>
                        <th>Total price</th>
                        <th>Image</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($res)) {?>
                                                <tr>
                                            <div class="table-stats order-table ov-h">
                                                    <td class="serial">
                                                        <?php
                            echo $i++; ?>
                          </td>
                        <td><?php echo $row['id'] ?> </td>
                        <td><?php echo $row['categories'] ?> </td>
                        <td><?php echo $row['locations'] ?> </td>
                        <td><?php echo $row['name'] ?> </td>
                        <td><?php echo $row['unit_price'] ?> </td>
                        <td><?php echo $row['total_price'] ?> </td>
                        <td><img src="<?php echo SERVICE_IMAGE_SITE_PATH . $row['img'] ?>"> </td>

                        <td>

                            <?php

if($row['status']==1) {
echo "<span class='badge badge-complete badge-primary'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span> &nbsp;";
} else{
echo "<span class='badge badge-pending badge-success'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
}
echo "<span class='badge badge-edit badge-info'><a href='add_services.php?id=".$row['id']."'>Edit</a></span>&nbsp;";

echo "<span class='badge badge-danger'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>&nbsp;";
 
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
require 'footer.php';
// }else{
//     header('location:../service_provider_login.php');
// }
?>