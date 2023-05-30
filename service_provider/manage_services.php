<?php
require 'top.inc.php';
require 'functions.inc.php';
require 'connection.inc.php';
/*
$operation= '';
if(isset($_GET['type']) && $_GET['type'] != '' ){
    $type =get_safe_value ($con,$_GET['type']);
    if($type == 'status'){
        $operation =get_safe_value ($con,$_GET['operation']);
        $id=get_safe_value ($con,$_GET['id']);
        if($operation == 'active'){
            $status='1';
        }else{
            $status='0';
        }
        $update_status_sql = "update services set status ='$status'where id = '$id' ";
        mysqli_query($con, $update_status_sql);
    }
if($type == 'delete'){
    $id=get_safe_value ($con,$_GET['id']);
    $delete_sql = "delete from services where id = '$id' ";
    mysqli_query($con, $delete_sql);
    }
}
*/
 $sql = "select services.*,categories.categories,locations.locations from services,categories,locations where 
 services.categories_id=categories.id and services.locations_id=locations.id order by services.id desc";
// $sql = "select services.*,categories.categories from services,categories where 
// services.categories_id=categories.id order by services.id desc";

$res = mysqli_query($con,$sql);
?>

<section class="htc__produc__decription bg__white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
            <div class="card">
            <div class="card-body">
                <h4 class="box-title">Manage Services </h4>
               <!-- <h4 class="box-link"><a href="add_services.php">&plus; Add Service</a> </h4>-->
            </div>
            
            <div class="card-body--">
                <div class="table-stats order-table ov-h">
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
                            <th>Quantity</th>
                            <th>Image</th>
                            <th></th>
                           
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                             $i=1; 
                            while($row = mysqli_fetch_assoc($res) ){ ?>  
                        <tr>
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
                        <td><?php // echo $row['qty'] ?> </td>
                        <!-- <td><img/><?php // echo $row['qty'] ?> </td>
                         -->
                        <td>
                            <div class="service">
                                <img src="<?php echo SERVICE_IMAGE_SITE_PATH.$row['img'] ?>"> </td>
                            </div>
                        <td>
                            
                            <?php
                            /*
                             if($row['status']==1) {
                                echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span> &nbsp;";
                            } else{
                                echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
                            }
                            echo "<span class='badge badge-edit'><a href='add_services.php?id=".$row['id']."'>Edit</a></span>&nbsp;";

                            echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>&nbsp;";
                            */
                                        ?> 
                                    </td>
                                    </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
<!-- End service Description -->




<?php
require ('footer.php');

?>