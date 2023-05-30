<?php
require ('top.inc.php');
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
        $update_status_sql = "update locations set status ='$status'where id = '$id' ";
        mysqli_query($con, $update_status_sql);
    }
if($type == 'delete'){
    $id=get_safe_value ($con,$_GET['id']);
    $delete_sql = "delete from locations where id = '$id' ";
    mysqli_query($con, $delete_sql);
    }
}
$sql = "SELECT locations.id,locations.locations,locations.status,categories.categories FROM locations LEFT JOIN categories on locations.categories_id = categories.id
";
$res = mysqli_query($con,$sql);
?>
<div class="content pb-0">
<div class="orders">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <div class="card-body">
                <h4 class="box-title">Manage Locations </h4>
                <a href="add_locations.php"><button type="button" class="btn btn-primary">&plus; Add Location</button></a>
                    
            </div>
            <div class="card-body--">
                <div class="table-stats order-table ov-h">
                    <table class="table ">
                        <thead>
                        <tr>
                            <th class="serial">Serial</th>
                            <th>Location ID</th>
                            <th>Category</th>
                            <th>Locations</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                             $i=1; 
                            while($row = mysqli_fetch_assoc($res)){ ?>  
                        <tr>
                        <td class="serial">
                            <?php
                                echo $i++; ?> 
                          </td>
                        <td><?php echo $row['id'] ?> </td>
                        <td><?php echo $row['categories'] ?> </td>
                        <td><?php echo $row['locations'] ?> </td>
                        
                        <td>
                            <?php 
                            if($row['status']==1) {
                                echo "<a href='?type=status&operation=deactive&id=".$row['id']."'><span class='badge badge-complete'>Active</span> &nbsp;</a>";
                            } else{
                                echo "<a href='?type=status&operation=active&id=".$row['id']."'><span class='badge badge-pending'>Deactive</span>&nbsp;</a>";
                            }  
                                echo "<a href='add_locations.php?id=".$row['id']."'><span class='badge badge-edit'>Edit</span>&nbsp;</a>";
                                
                                echo "<a href='?type=delete&id=".$row['id']."' onclick=\"return confirm('Are you sure?')\"><span class='badge badge-delete'>Delete</span>&nbsp;</a>";
                           
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
<?php
require ('footer.inc.php');

?>