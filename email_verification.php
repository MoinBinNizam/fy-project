<?php
$to_email = "blackhatbd35@gmail.com";
$subject = "User verification through Email";
$body = "Hi, This is verification email.";
$headers = "From:moin301197@gmail.com";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}