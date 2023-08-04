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
    AND assign_date = '$assignDate'";
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
    $addUser = $_SESSION['userid'];
    $addDate = date('y-m-d');
}

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling DB Connection
    $sql = "INSERT INTO tbl_machine_assign
            (`project_id`, `machine_id`, `assign_date`, `return_date`, `special_note`, `add_user`, `add_date`) 
            VALUES ('$proId', '$machineId', '$assignDate', '$returnDate', '$description', '$addUser', '$addDate')";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form submitted successfully"));
    } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
