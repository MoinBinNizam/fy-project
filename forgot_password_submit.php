<?php

  require ('connection.inc.php');
  require ('function.inc.php');

$email=get_safe_value($con,$_POST['email']);
$res = mysqli_query($con,"SELECT * FROM users WHERE email='$email'");
$check_user = mysqli_num_rows($res);
if($check_user>0){
  $row= mysqli_fetch_assoc($res);
  $pwd=$row['password'];
  $html="Your password is $pwd";
  include('smtp/PHPMailerAutoload.php');
  $mail = new PHPMailer(true);
  $email->isSMTP();
  $mail->Host="smtp.gmail.com";
  $mail->POST=587;
  $mail->SMTPSecure="tls";
  $mail->SMTPAuth=ture;
  $mail->Username="SMTP_EMAIL_ID";
  $mail->Password="SMTP_EMIAL_PASSWORD";
  $mail->setFrom("SMTP_EMAIL_ID");
  $mail->addAddress($email);
  $mail->isHTML(true);
  $mail->Subject="New OTP";
  $mail->Body=$html;
  $mail->SMTPOptions=array('ssl'=>array(
      'verify_peer'=>false,
      'verify_peer_name'=>false,
      'allow_self_signed'=>false
  ));
  if($mail->send()){
    echo "Done";
  }else{
  }
  }else{
  echo "Not";
  die();
}

?>