<?php
session_start();

include '../../function.php';

// Create array to store error messages
$errors = array();

// This function uses array keys as variable names and values as variable values
extract($_POST);

// Required Fields Validation
if (empty($machineId)) {
    $errors['error_machineId'] = "Machine ID is Required";
}
if (empty($maintainedDate)) {
    $errors['error_maintainedDate'] = "Maintained Date is Required";
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
    $sql = "UPDATE tbl_machine_maintenance
    SET `machine_id` = '$machineId', `maintenance_date` = '$maintainedDate', `special_note` = '$description',
    `update_user` = '$updateUser', `update_date` = '$updateDate'
    WHERE `maintenance_id` = '$maintenanceId'";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form Updated successfully"));
    } else {
        echo json_encode(array('error' => "Form Updating failed"));
    }
}