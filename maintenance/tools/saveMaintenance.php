<?php
session_start();

include '../../function.php';

// Create array to store error messages
$errors = array();

// This function uses array keys as variable names and values as variable values
 extract($_POST);
 
// Required Fields Validation
if (empty($toolId)) {
    $errors['error_toolId'] = "Tool ID is Required";
}
if (empty($maintainedDate)) {
    $errors['error_maintainedDate'] = "Maintained Date is Required";
}

// Check Validation is Completed
if (empty($_SESSION['status'])) {
    // Retrieving values for fields that are not in the form
    $addUser = $_SESSION['userid'];
    $addDate = date('y-m-d');
}


if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling DB Connection
    $sql = "INSERT INTO tbl_tool_maintenance
            (`tool_id`, `maintenance_date`, `special_note`, `add_user`, `add_date`) 
            VALUES ('$toolId', '$maintainedDate', '$description', '$addUser', '$addDate')";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form submitted successfully"));
    } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
