<?php
require 'top.inc.php';
$locations = '';
$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $sql = "select * from locations where id = '$id'";
    $res = mysqli_query($con, $sql);
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $locations = $row['locations'];
    } else {
        header('location:manage_locations.php ');
        die();
    }
}

if (isset($_POST['submit'])) {
    $locations = get_safe_value($con, $_POST['locations']);
    $category = get_safe_value($con, $_POST['category']);


    $result = mysqli_query($con, "select * from locations where locations = '$locations'");
    $check = mysqli_num_rows($result);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($result);
            if ($id == $getData['id']) {
            } else {
                $msg = "Notice: Location already exist";
            }
        } else {
            $msg = "Notice: Location already exist";
        }
    }
    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            mysqli_query($con, "update locations set locations= '$locations'where id ='$id'");
        } else {
            mysqli_query($con, "insert into locations(categories_id,locations,status) values ('$category','$locations','1')");
        }
        header('location:manage_locations.php');
        die();
    }
}

?>
<div class="content pb-0">
   <div class="animated fadeIn">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-header">
                  <strong>Location Form</strong>
               </div>
                  <form method="post">
                     <div class="card-body card-block">
                     <div class="form-group">
                        <label for="locations" class=" form-control-label">&plus; Add locations
                        </label>
                        <input type="text" name="locations" placeholder="Enter locations name" class="form-control" required value="<?php echo $locations; ?>">
                     </div>
                     <div class="form-group">
                     <label for="locations" class=" form-control-label">&plus; Add Category
                        </label>
                     <select name="category" id="category" class="form-control">
                  <option value="">Select Category</option>
                  <?php
$sql = "select * from categories where status = '1' order by categories asc";
$res = mysqli_query($con, $sql);
while ($row = mysqli_fetch_assoc($res)) {?>
                      <option value="<?=$row["id"];?>"><?=$row["categories"];?></option>
                  <?php }?>
              </select>
                     </div>
                     <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                        <span id="payment-button-amount">Add Location</span>
                     </button>
                     <div class="field_error">
                  <?php echo $msg ?>
               </div>
                  </div>
               </form>

            </div>
         </div>
      </div>
   </div>
</div>

<?php
require 'footer.inc.php';

?>