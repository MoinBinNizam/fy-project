<?php

// initializing variables
$name = '';
$email = '';
$password = '';
$c_password = '';
$mobile = '';


$errors = array();
// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $c_password = filter_input(INPUT_POST,'c_password',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mobile = filter_input(INPUT_POST,'mobile',FILTER_SANITIZE_NUMBER_INT);
    


    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($name)) {
        array_push($errors, "Name is required");
    } else {
        $name = get_safe_value($con, $_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            array_push($errors, "Name: Only letters and white space allowed");
            //$nameErr = "Only letters and white space allowed";
        }
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    } else {
        $email = get_safe_value($con, $_POST["email"]);
        // check if e-mail address is well-formed
        // check if e-mail address syntax is valid
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
            array_push($errors, "Email: Invalid format");
        }
    }
    if (empty($password)) {
        array_push($errors, "Password: is required");
    } else {
        $password = get_safe_value($con, $_POST['password']); 
        //Checking if the password is valid, length, mix of upper & lower case etc.
        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
    }
    if (strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
        // $msg = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
        array_push($errors, "Password must be at least 8 characters in
            length and must contain at least one number, one upper case letter,
             one lower case letter and one special character.");
        //long password is !12345Moin!
    } 
    if ($password != $c_password) {
        array_push($errors, "The two passwords do not match");
    }
    // else {
    //     array_push($errors, "Your password is strong.");
    // }

    if (empty($mobile)) {
        array_push($errors, "Mobile number: is required");
    }else {
    $mobile = get_safe_value($con, $_POST["mobile"]);
    // check if mobile address is well-formed
    // check if mobile address syntax is valid
    if (!preg_match('/^[0-9]{11}+$/',  $mobile)){
        array_push($errors, "Mobile number must be 11 digit.");
    }
    }
    

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE email='$email' OR mobile='$mobile' LIMIT 1";
    $result = mysqli_query($con, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['email'] === $email) {
            array_push($errors, "This Email already exists. Try another!");
        }

        if ($user['mobile'] === $mobile) {
            array_push($errors, "Mobile no. already exists. Try another!");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        //$password = md5($password_1);//encrypt the password before saving in the database
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $c_password = password_hash($_POST['c_password'], PASSWORD_DEFAULT);
        $added_on=date('Y-m-d h:i:s');
        // password 123
        // !12345Moin!
       
        $query = "INSERT INTO users (name, email, password, c_password, mobile, added_on)
  			  VALUES('$name', '$email', '$password','$c_password', '$mobile', '$added_on')";
        mysqli_query($con, $query);
        //login
        $_SESSION['email'] = $email;
        //$_SESSION['id'] = $id;
        $_SESSION['name'] = $name;

        //set flash message
        $_SESSION['success'] = "You are now successfully logged in.";
        $_SESSION['alert-class'] = "alert-success";
        header('location: login.php');
        exit();
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if (empty($email)) {
        array_push($errors, "Email is required");
    } else {
        $email = get_safe_value($con, $_POST["email"]);
        // check if e-mail address is well-formed
        // check if e-mail address syntax is valid
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
            array_push($errors, "Email: Invalid format");
        }
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE email='$email'";
        $results = mysqli_query($con, $query);
        $num_rows = mysqli_num_rows($results);
        $fetch_assoc = mysqli_fetch_assoc($results);
        $db_password = $fetch_assoc['password'];
        $decrypt_password = password_verify($password, $db_password);

        //setting up session array
        $_SESSION['USER_LOGIN'] = 'yes';
        $_SESSION['USER_ID'] = $fetch_assoc['id'];
        $_SESSION['USER_NAME'] = $fetch_assoc['name'];
        if ($num_rows == 1 && $password == $decrypt_password) {
            $_SESSION['USER_EMAIL'] = $fetch_assoc['email'];
            //$_SESSION['success'] = "You are now logged in";

            header("Location: index.php");
            ?>
            
            <?php
        } else {
            //         echo "<div class='alert alert-danger' role='alert'>
            //   Login failed. Email and Password did not match
            //   </div>";
            //         header("Refresh:2; login.php");
            array_push($errors, "Wrong username/password combination");
            //header("Refresh:.01; login.php");

        }
    }
}
