<?php

// if(isset($_SESSION['SP_ID'])){
//     //required pages should be in this block
require 'top.inc.php';
require_once 'connection.inc.php';

$userId = $_SESSION['SP_ID'];
$sp_name = '';
$sp_email = '';
$sp_mobile = '';
$sp_address = '';
$sp_experience = '';


$sql = "select * from service_provider where id ='$userId'";

$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
<div class="orders">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <div class="card-body">
                <h3 class="box-title">Service Provider Profile</h3>
                <!-- <a href="add_services.php"> <button type="button" class="btn btn-primary">&plus; Create Gig</button></a> -->
            </div>
            <div class="card-body--">
                <table class="table ">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Experience</th>


                    </tr>
                    </thead>
                    <tbody>
                            <tr>
                            <div class="table-stats order-table ov-h">
                            <?php
                            while ($row = mysqli_fetch_assoc($res)) {?>
                            <tr>
                            <div class="table-stats order-table ov-h">
                            
                            <?php
                            //echo $i++; ?>
                          </td>
                          </td>
                        <td><?php echo $row['name'] ?> </td>
                        <td><?php echo $row['email'] ?> </td>
                        <td><?php echo $row['mobile'] ?> </td>
                        <td><?php echo $row['address'] ?> </td>
                        <td><?php echo $row['experience']." years" ?> </td>
                        <td><img src="<?php // echo SERVICE_IMAGE_SITE_PATH . $row['img'] ?>"> </td>

                        <td>
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
?>