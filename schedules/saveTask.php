<?php
session_start();

include '../function.php';

// Create array for store Error Meassages
$errors = array();

// This function uses array keys as variable names and values as variable values
extract($_POST);

// Required Fields Validation
if (empty($taskName)) {
    $errors['error_taskName'] = "Task Name is Required";
}
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
    $errors['error_currentStatus'] = "Please Select Status";
}
if (empty($cost)) {
    $errors['error_cost'] = "Actual Cost is Required";
}
if (empty($labourCount)) {
    $errors['error_labourCount'] = "Labour Count is Required";
}

// Check Validation is Completed
else if (empty($_SESSION['status'])) {
    // Retrieving values for fields that are not in the form
    $addUser = $_SESSION['userid'];
    $addDate = date('y-m-d');
}

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling to DB Connection
    $sql = "INSERT INTO tbl_schedule_task
            (`schedule_id`,`task_name`,`starting_date`,`ending_date`,`description`,`current_status`,`cost`,`labour_count`,`add_user`,`add_date`) 
            VALUES('$scheduleId','$taskName','$startDate','$endDate','$description','$currentStatus','$cost','$labourCount','$addUser','$addDate')";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form submitted successfully"));
    } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
