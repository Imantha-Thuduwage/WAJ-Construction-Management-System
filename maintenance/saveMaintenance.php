<?php
session_start();

include '../function.php';

// Create array to store error messages
$errors = array();

// This function uses array keys as variable names and values as variable values
 extract($_POST);
 
// Required Fields Validation
if (empty($maintainedDate)) {
    $errors['error_maintainedDate'] = "Maintained Date is Required";
}

// Check Validation is Completed
else if (empty($_SESSION['status'])) {
    // Retrieving values for fields that are not in the form
    $addUser = $_SESSION['userid'];
    $addDate = date('y-m-d');
}

// // Check if $machineId is empty and set it to NULL
// if (empty($machineId)) {
//     $machineId = null;
// }

// // Check if $toolId is empty and set it to NULL
// if (empty($toolId)) {
//     $toolId = null;
// }

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling DB Connection
    $sql = "INSERT INTO tbl_maintenance
            (`tool_id`, `machine_id`, `maintenance_date`, `special_note`, `add_user`, `add_date`) 
            VALUES ('$toolId', '$machineId', '$maintainedDate', '$description', '$addUser', '$addDate')";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form submitted successfully"));
    } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
