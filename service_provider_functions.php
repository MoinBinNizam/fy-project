<?php
require('top.php');
require('service_provider_register.php');



//$msg = '';
$login_email = '';
$login_password = '';

function service_provider_login(){
  global $con;

  if(isset ($_POST['login_submit'])){
    $login_email = get_safe_value($con, $_POST['login_email']);
    $login_password = get_safe_value($con, $_POST['login_password']);
    $sql = "SELECT * from service_provider where email = '$login_email' and password = '$login_password'";
    $result = mysqli_query($con, $sql);
    $count= mysqli_num_rows($result);
    if ($count >0){
      $_SESSION['SERVICE_PROVIDER_LOGIN']='yes';
      $_SESSION['SERVICE_PROVIDER_EMAIL']=$login_email;
      echo "<div class='alert alert-success' role='alert'> Login successful. 
      </div>";
      header('Refresh:5', 'url:manage_services.php');
      //header('location:manage_services.php');
      die();
    }else{
     //$msg = "Please enter the correct login details again";
     echo  "<div class='alert alert-danger' role='alert'> Please enter the correct login details. 
     </div>";
     header('Refresh:5', 'url:service_provider.php');
     
    }
  }
}

?>