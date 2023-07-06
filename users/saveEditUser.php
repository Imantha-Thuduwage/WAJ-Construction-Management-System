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
    $sql = "SELECT * FROM tbl_user WHERE user_name = '$userName' AND user_id <> '$userId'";
    $db = dbConn();
    $result = $db->query($sql);

    // Checks if another project name already exists with the same name
    if ($result->num_rows > 0) {
        $errors['error_userName'] = "User Name is Already Exists";
    }
    // Check Validation is Completed
    else if (empty($_SESSION['status'])) {
        // Retrieving values for fields that are not in the form
        $updateUser = $_SESSION['userid'];
        $updateDate = date('y-m-d');
    }
}

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling to DB Connection
    $sql = "UPDATE tbl_user
    SET `user_name` = '$userName', `first_name` = '$firstName', `last_name` = '$lastName', 
    `role_id` = '$userRole', `update_user` = '$updateUser', `update_date` = '$updateDate'
    WHERE `user_id` = '$userId'";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form Updated successfully"));
    } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
