<?php

// if(isset($_SESSION['SP_ID'])){
//    //required pages should be in this block
require 'top.inc.php';
require 'functions.inc.php';
require 'connection.inc.php';

// }else{
//    header('location: ../user/service_provider_login.php');
// }
$categories_id = '';
$locations_id = '';
$name = '';
$unit_price = '';
$total_price = '';
$img = '';
$short_desc = '';
$descpt = '';
$meta_title = '';
$meta_desc = '';

$msg = '';
$image_required = 'required';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $image_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $sql = "select * from services where id = '$id'";
    $res = mysqli_query($con, $sql);
    $check = mysqli_num_rows($res);

    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $categories_id = $row['categories_id'];
        $locations_id = $row['locations_id'];
        $name = $row['name'];
        $unit_price = $row['unit_price'];
        $total_price = $row['total_price'];
        $short_desc = $row['short_desc'];
        $descpt = $row['descpt'];
        $meta_title = $row['meta_title'];
        $meta_desc = $row['meta_desc'];
    } else {
        header('location:add_services.php ');
        die();

    }
}

?>
<div class="content pb-0">
   <div class="animated fadeIn">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-header">
               <h4 class="box-title">Create Your Gig </h4>
               </div>
                  <form method="post" enctype="multipart/form-data" action="service_process.php">
                     <div class="card-body card-block">
                     <div class="form-group">
                        <label for="categories" class=" form-control-label">Categories
                        </label>
                           <select class="form-control" name="categories_id">
                              <option>Select Category</option>
                              <?php
$res = mysqli_query($con, "select id,categories from categories order by categories asc");
while ($row = mysqli_fetch_assoc($res)) {
    if ($row['id'] == $categories_id) {
        echo "<option selected value=" . $row['id'] . ">" . $row['categories'] . "</option>";
    } else {
    }
    echo "<option value=" . $row['id'] . ">" . $row['categories'] . "</option>";
}
?>
                           </select>
                        </div>
                        <div class="form-group">
                        <label for="categories" class=" form-control-label">Locations
                        </label>
                           <select class="form-control" name="locations_id">
                              <option>Select Location</option>
                              <?php
$res = mysqli_query($con, "select id,locations from locations order by locations asc");
while ($row = mysqli_fetch_assoc($res)) {
    if ($row['id'] == $locations_id) {
        echo "<option selected value=" . $row['id'] . ">" . $row['locations'] . "</option>";
    } else {
    }
    echo "<option value=" . $row['id'] . ">" . $row['locations'] . "</option>";
}
?>
                           </select>
                        </div>
                     <div class="form-group">
                        <label for="categories" class=" form-control-label">Service name
                        </label>
                        <input type="text" name="name" placeholder="Enter Service name" class="form-control" required value="<?php echo $name; ?>">
                     </div>
                     <div class="form-group">
                        <label for="categories" class=" form-control-label">Service unit price
                        </label>
                        <input type="text" name="unit_price" placeholder="Enter unit price" class="form-control" required value="<?php echo $unit_price; ?>">
                     </div>
                     <div class="form-group">
                        <label for="categories" class=" form-control-label">Service total price
                        </label>
                        <input type="text" name="total_price" placeholder="Enter total price" class="form-control" required value="<?php echo $total_price; ?>">
                     </div>
                     <div class="form-group">
                        <label for="categories" class=" form-control-label">Service short description
                        </label>
                        <textarea  name="short_desc" placeholder="Enter short description" class="form-control"  <?php echo $short_desc; ?>></textarea>
                     </div>
                     <div class="form-group">
                        <label for="categories" class=" form-control-label">Service description
                        </label>
                        <textarea  name="descpt" placeholder="Enter description" class="form-control" <?php echo $descpt; ?>></textarea>
                     </div>
                     <div class="form-group">
                        <label for="categories" class=" form-control-label">Service meta title
                        </label>
                        <textarea  name="meta_title" placeholder="Enter meta title" class="form-control"  <?php echo $meta_title; ?>></textarea>
                     </div>
                     <div class="form-group">
                        <label for="categories" class=" form-control-label">Service meta description
                        </label>
                        <textarea  name="meta_desc" placeholder="Enter meta description" class="form-control"  <?php echo $meta_desc; ?>></textarea>
                     </div>
                     <div class="form-group">
                        <label for="categories" class=" form-control-label">Image
                        </label>
                        <input type="file" name="img"  class="form-control" <?php $image_required;?> >
                        <div class="field_error">
                           <?php // echo $img_msg;?>
                        </div>
                     </div>


                     <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                        <span id="payment-button-amount">Add Service</span>
                     </button>
                     <div class="field_error">
                  <?php echo $msg; ?>
               </div>
                  </div>
                  <input type="hidden" value="<?php echo $_SESSION['SP_ID'] ?>" name="service_provider_id" />
               </form>

            </div>
         </div>
      </div>
   </div>
</div>
<?php
require 'footer.inc.php';
?>