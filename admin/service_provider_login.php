<?php
  require ('connection.inc.php');
  require ('functions.inc.php');
    if(isset($_SESSION["ADMIN_LOGIN"]) && !empty($_SESSION["ADMIN_LOGIN"])){
        header('location:service_provider_manage_services.php');
    }
  $msg = '';
  if(isset ($_POST['submit'])){
    $email = get_safe_value($con, $_POST['email']);
    $password = get_safe_value($con, $_POST['password']);
    $sql = "select * from service_provider where email = '$email' and password = '$password'";
    $result = mysqli_query($con, $sql);
    $count= mysqli_num_rows($result);
    while($row = mysqli_fetch_assoc($result)){
        $_SESSION['ADMIN_USERNAME']=$row["name"];
        $_SESSION['id']=$row["id"];
    }
    if ($count >0){
      $_SESSION['ADMIN_LOGIN']='yes';
      header('location:service_provider_manage_services.php');
      die();
    }else{
      $msg = "Please enter the correct login details";
    }
  }
?>
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body class="bg-dark">
    
      <div class="sufee-login d-flex align-content-center flex-wrap">
         <div class="container">
            <div class="login-content">
               <div class="login-form mt-150">
               <strong><h1 >Service Provider Login</h1></strong>
                  <form method='POST'>
                     <div class="form-group">
                        <label>Email address</label>
                        <input type="text" name="email" class="form-control" placeholder="Enter your Username" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your Password" required>
                     </div>
                     <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
               </form>
               <div class="field_error"> 
                  <?php echo $msg ?>
               </div>
            </div> 
         </div>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>