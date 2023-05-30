<?php
    unset($_SESSION['SP_LOGIN']);
    unset($_SESSION['SP_EMAIL']);
    //unset($_SESSION['USER_NAME']);

    header('location:index.php');
die();