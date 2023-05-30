<?php
require 'functions.inc.php';
require 'connection.inc.php';

if (isset($_POST['submit'])) {
    $categories_id = get_safe_value($con, $_POST['categories_id']);
    $locations_id = get_safe_value($con, $_POST['locations_id']);
    $name = get_safe_value($con, $_POST['name']);
    $unit_price = get_safe_value($con, $_POST['unit_price']);
    $total_price = get_safe_value($con, $_POST['total_price']);
    $short_desc = get_safe_value($con, $_POST['short_desc']);
    $descpt = get_safe_value($con, $_POST['descpt']);
    $meta_title = get_safe_value($con, $_POST['meta_title']);
    $meta_desc = get_safe_value($con, $_POST['meta_desc']);
    $service_provider_id = get_safe_value($con, $_POST['service_provider_id']);

    $result = mysqli_query($con, "select * from services where name = '$name'");
    $check = mysqli_num_rows($result);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($result);
            if ($id == $getData['id']) {
            } else {
                $msg = "Service already exist";
            }
        } else {
            $msg = "Service already exist";
        }
    }
    $img_msg = '';
    if ($_FILES['img']['type'] != 'img/png' &&
        $_FILES['img']['type'] != 'img/jpg' &&
        $_FILES['img']['type'] != 'img/jpeg') {
        $img_msg = "Please select only png, jpg, jpeg image formate";
    }
    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            if ($_FILES['img']['name'] != '') {
                $img = rand(111111111, 999999999) . '_' . $_FILES['img']['name'];
                move_uploaded_file($_FILES['img']['tmp_name'], SERVICE_IMAGE_SERVER_PATH . $img);

                $update_sql = "update services set categories_id= '$categories_id',locations_id= '$locations_id',name= '$name',
       unit_price= '$unit_price',total_price= '$total_price',short_desc= '$short_desc',
       descpt= '$descpt',meta_title= '$meta_title',meta_desc= '$meta_desc', img= '$img' where id ='$id'";
            } else {
                $update_sql = "update services set categories_id= '$categories_id',locations_id= '$locations_id',name= '$name',
       unit_price= '$unit_price',total_price= '$total_price',short_desc= '$short_desc',
       descpt= '$descpt',meta_title= '$meta_title',meta_desc= '$meta_desc' where id ='$id'";
            }
            mysqli_query($con, $update_sql);
        } else {
            //Image Upload
            $img = rand(111111111, 999999999) . '_' . $_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'], SERVICE_IMAGE_SERVER_PATH . $img);

            mysqli_query($con, "insert into services(
          categories_id,locations_id,name,unit_price,total_price,short_desc,descpt,meta_title,meta_desc,status,img,service_provider_id)
          values ('$categories_id','$locations_id','$name','$unit_price','$total_price','$short_desc','$descpt',
          '$meta_title','$meta_desc','1','$img','$service_provider_id')");
        }
        header('location:create_gig_service.php ');
        die();
    }
}
