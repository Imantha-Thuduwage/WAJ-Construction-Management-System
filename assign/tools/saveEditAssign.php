<?php
session_start();

include '../../function.php';

// Create array to store error messages
$errors = array();

// This function uses array keys as variable names and values as variable values
extract($_POST);

// Required Fields Validation
if (empty($proId)) {
    $errors['error_proId'] = "Project ID is Required";
}
if (empty($toolId)) {
    $errors['error_toolId'] = "Machine ID is Required";
}
if (empty($assignDate)) {
    $errors['error_assignDate'] = "Assign Date is Required";
}
if (empty($returnDate)) {
    $errors['error_returnDate'] = "Return Date is Required";
}

// Check Validation is Completed
else if (empty($_SESSION['status'])) {
    // Retrieving values for fields that are not in the form
    $updateUser = $_SESSION['userid'];
    $updateDate = date('y-m-d');
}

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling DB Connection
    $sql = "UPDATE tbl_tool_assign
    SET `project_id` = '$proId', `tool_id` = '$toolId', `assign_date` = '$assignDate', `return_date` = '$returnDate', 
    `special_note` = '$description', `update_user` = '$updateUser', `update_date` = '$updateDate'
    WHERE `assign_id` = '$assignId'";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form Updated successfully"));
    } else {
        echo json_encode(array('error' => "Form Updating failed"));
    }
}
