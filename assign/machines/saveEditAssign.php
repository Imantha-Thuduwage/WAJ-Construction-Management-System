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
if (empty($machineId)) {
    $errors['error_machineId'] = "Machine ID is Required";
}
if (empty($assignDate)) {
    $errors['error_assignDate'] = "Assign Date is Required";
}

// Advanced Validation
else if (empty($errors)) {
    $sql = "SELECT * FROM tbl_machine_assign WHERE machine_id = '$machineId' 
    AND assign_date = '$assignDate' AND assign_id <> '$assignId'";
    $db = dbConn();
    $result = $db->query($sql);

    // Checks if another project name already exists with the same name
    if ($result->num_rows > 0) {
        $errors['error_already_booked'] = "Already reserved for that date";
    }
}

// Check Validation is Completed
if (empty($_SESSION['status'])) {
    // Retrieving values for fields that are not in the form
    $updateUser = $_SESSION['userid'];
    $updateDate = date('y-m-d');
}

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling DB Connection
    $sql = "UPDATE tbl_machine_assign
    SET `project_id` = '$proId', `machine_id` = '$machineId', `assign_date` = '$assignDate', `return_date` = '$returnDate', 
    `special_note` = '$description', `update_user` = '$updateUser', `update_date` = '$updateDate'
    WHERE `assign_id` = '$assignId'";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form Updated successfully"));
    } else {
        echo json_encode(array('error' => "Form Updating failed"));
    }
}
