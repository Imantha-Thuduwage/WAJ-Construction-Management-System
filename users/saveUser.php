<?php
session_start();

include '../function.php';

// Create array for store Error Meassages
$errors = array();

// This function uses array keys as variable names and values as variable values
extract($_POST);

// Required Fields Validation
if (empty($userName)) {
    $errors['error_userName'] = "User Name is Required";
}
if (!filter_var($userName, FILTER_VALIDATE_EMAIL)){
    $message['error_userName'] = "Invalid Email";
}
if (empty($password)) {
    $errors['error_password'] = "Password is Required";
}
if (empty($firstName)) {
    $errors['error_firstName'] = "first Name is Required";
}
if (empty($lastName)) {
    $errors['error_lastName'] = "last Name is Required";
}
if (empty($userRole)) {
    $errors['error_userRole'] = "user Role is Required";
}

// Advanced Validation 
else if (!empty($userName)) {
    $sql = "SELECT * FROM tbl_user WHERE user_name = '$userName'";
    $db = dbConn();
    $result = $db->query($sql);

    // Checks if another project name already exists with the same name
    if ($result->num_rows > 0) {
        $errors['error_already'] = "User Name is Already Exists";
    }
    // Check Validation is Completed
    else if (empty($_SESSION['status'])) {
        // Retrieving values for fields that are not in the form
        $addUser = $_SESSION['userid'];
        $addDate = date('y-m-d');
    }

    $password = sha1($password);
    $status = 1;
}

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling to DB Connection
    $sql = "INSERT INTO tbl_user
            (`user_name`,`password`,`first_name`,`last_name`,`role_id`,`status`,`add_user`,`add_date`) 
            VALUES('$userName','$password','$firstName','$lastName','$userRole','$status','$addUser','$addDate')";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form submitted successfully"));
    } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
