<?php
// initializing variables
$sp_name = '';
$sp_email = '';
$sp_mobile = '';
$sp_password = '';
$sp_c_password = '';
$sp_address = '';
$sp_experience = '';
$sp_nid = '';
// $added_on=date('Y-m-d h:i:s');
$errors = array();
// REGISTER USER
if (isset($_POST['sp_register'])) {
    // receive all input values from the form
    $sp_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sp_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sp_mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sp_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sp_c_password = filter_input(INPUT_POST, 'c_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sp_address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sp_experience = filter_input(INPUT_POST, 'experience', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sp_nid = filter_input(INPUT_POST, 'nid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error into $errors array
    if (empty($sp_name)) {
        array_push($errors, "Name is required");
    } else {
        $sp_name = get_safe_value($con, $_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $sp_name)) {
            array_push($errors, "Name: Only letters and white space allowed");
            //$nameErr = "Only letters and white space allowed";
        }
    }
    if (empty($sp_email)) {
        array_push($errors, "Email is required");
    } else {
        $sp_email = get_safe_value($con, $_POST["email"]);
        // check if e-mail address is well-formed
        // check if e-mail address syntax is valid
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $sp_email)) {
            array_push($errors, "Email: Invalid format");
        }
    }
    if (empty($sp_mobile)) {
        array_push($errors, "Mobile number: is required");
    } else {
        $sp_mobile = get_safe_value($con, $_POST["mobile"]);
        // check if mobile address is well-formed
        // check if mobile address syntax is valid
        if (!preg_match('/^[0-9]{11}+$/', $sp_mobile)) {
            array_push($errors, "Mobile number must be 11 digit.");
        }
    }

    if (empty($sp_password)) {
        array_push($errors, "Password: is required");
    } else {
        $sp_password = get_safe_value($con, $_POST['password']);
        //Checking if the password is valid, length, mix of upper & lower case etc.
        $number = preg_match('@[0-9]@', $sp_password);
        $uppercase = preg_match('@[A-Z]@', $sp_password);
        $lowercase = preg_match('@[a-z]@', $sp_password);
        $specialChars = preg_match('@[^\w]@', $sp_password);
    }
    if (strlen($sp_password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
        // $msg = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
        array_push($errors, "Password must be at least 8 characters in
            length and contain at least one number, one upper case letter,
             one lower case letter and one special character.");
        //encrypted password is !12345Moin!
    }
    if ($sp_password != $sp_c_password) {
        array_push($errors, "The two passwords do not match");
    }
    if (empty($sp_address)) {
        array_push($errors, "Address is required");
    } else {
        $sp_address = get_safe_value($con, $_POST["address"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[ a-z0-9,.+!:;()-]+$/i", $sp_address)) {
            array_push($errors, "Letters, number, space character, and common punctuation are allowed");
           
        }
    }
    if (empty($sp_experience)) {
        array_push($errors, "Experience is required");
    } else {
        $sp_experience = get_safe_value($con, $_POST["experience"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[ a-z0-9,.+!:;()-]+$/i", $sp_experience)) {
            array_push($errors, "Letters, number, space character, and common punctuation are allowed");
            //$nameErr = "Only letters and white space allowed";
        }
    }

    /*first check the database to make sure
     a user does not already exist with the same email and/or  mobile
  */
    $user_check_query = "SELECT * FROM service_provider WHERE email='$sp_email' OR mobile='$sp_mobile' LIMIT 1";
    $result = mysqli_query($con, $user_check_query);
    $sp_user = mysqli_fetch_assoc($result);

    if ($sp_user) { // if user exists
        if ($sp_user['email'] === $sp_email) {
            array_push($errors, "This Email already exists. Try another!");
        }

        if ($sp_user['mobile'] === $sp_mobile) {
            array_push($errors, "Mobile no. already exists. Try another!");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        //$password = md5($password_1);//encrypt the password before saving in the database
        $sp_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sp_c_password = password_hash($_POST['c_password'], PASSWORD_DEFAULT);

        // password 123
        // !12345Moin!
        $sp_added_on = date('Y-m-d h:i:s');
        $query = "INSERT INTO service_provider (name, email, mobile, password, c_password, address, experience, added_on)
  			  VALUES('$sp_name', '$sp_email', '$sp_mobile', '$sp_password','$sp_c_password', '$sp_address', '$sp_experience','$sp_added_on')";
        $result = mysqli_query($con, $query);
        echo '$result';
        /* login session variables*/
        $_SESSION['SP_NAME'] = $sp_name;
        $_SESSION['SP_EMAIL'] =$sp_email;
        $_SESSION['SP_MOBILE'] = $sp_mobile;
        $_SESSION['SP_ID'] = $sp_user['id'];
        

        //aler session
        $_SESSION['message'] = "Service provider Registratoin successful.";

         //header('location: service_provider/dashboard.php');
        
        header('location: service_provider_login.php');
        ?>
        <script> alert('Registration successful. Log in Now')</script>
        <?php
    }
}




// LOGIN USER
if (isset($_POST['sp_login'])) {
    $sp_email = mysqli_real_escape_string($con, $_POST['email']);
    $sp_password = mysqli_real_escape_string($con, $_POST['password']);

    if (empty($sp_email)) {
        array_push($errors, "Email is required");
    } else {
        $sp_email = get_safe_value($con, $_POST["email"]);
        // check if e-mail address is well-formed
        // check if e-mail address syntax is valid
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $sp_email)) {
            array_push($errors, "Email: Invalid format");
        }
    }
    if (empty($sp_password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM service_provider WHERE email='$sp_email'";
        $results = mysqli_query($con, $query);
        $num_rows = mysqli_num_rows($results);
        $fetch_assoc = mysqli_fetch_assoc($results);
        $sp_db_password = $fetch_assoc['password'];
        $sp_decrypt_password = password_verify($sp_password, $sp_db_password);

            $_SESSION['SP_ID'] = $fetch_assoc['id'];
            $_SESSION['SP_NAME'] = $fetch_assoc['name'];
            $_SESSION['SP_LOGIN'] = 'yes';
        if ($num_rows == 1 && $sp_password == $sp_decrypt_password) {
            $_SESSION['SP_EMAIL'] =$fetch_assoc['email'];
        
            //setting up session array
            //$_SESSION['success'] = "You are now logged in";
                // $_SESSION['SP_NAME'] = $sp_name;
                // $_SESSION['SP_EMAIL'] =$sp_email;
                // $_SESSION['SP_MOBILE'] = $sp_mobile;
            
        header('location: service_provider/dashboard.php');

        } else {
            
            array_push($errors, "Wrong username/password combination");
          

        }
    }
}


//service provider logout
if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['SP_ID']);
    unset($_SESSION['SP_NAME']);
    unset($_SESSION['SP_LOGIN']);
    unset($_SESSION['SP_EMAIL']);
    header('location: ../user/service_provider_login.php');
exit();

}



