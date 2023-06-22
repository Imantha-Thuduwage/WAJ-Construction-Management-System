<?php
session_start();

include '../function.php';

// Create array for store Error Meassages
$errors = array();

// This function uses array keys as variable names and values as variable values
extract($_POST);

// Required Fields Validation
if (empty($startDate)) {
    $errors['error_startDate'] = "Starting Date is Required";
}
if (empty($endDate)) {
    $errors['error_endDate'] = "Ending Date is Required";
}

if (empty($description)) {
    $errors['error_description'] = "Description is Required";
}
if (empty($currentStatus)) {
    $errors['error_currentStatus'] = "Status is Required";
}
if (empty($cost)) {
    $errors['error_cost'] = "Total Cost is Required";
}

// Advanced Validation 
else if (empty($errors)) {
    // Check Validation is Completed
    if (empty($_SESSION['status'])) {
        // Retrieving values for fields that are not in the form
        $addUser = $_SESSION['userid'];
        $addDate = date('y-m-d');
    }
}

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling to DB Connection
    $sql = "INSERT INTO tbl_project
            (`task_id`,`project_id`,`start_date`,`end_date`,`decription`,`current_status`,`add_user`,`add_date`) 
            VALUES('$taskId','projectId','$startDate','$endDate','$description','$cost','$addUser','$addDate')";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form submitted successfully"));
    } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
