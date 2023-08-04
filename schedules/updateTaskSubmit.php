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

// Advanced Validation 
else if (!empty($taskName)) {
    $sql = "SELECT * FROM tbl_schedule_task WHERE task_name = '$taskName' AND schedule_id <> '$scheduleId' AND task_id <> $taskId ";
    $db = dbConn();
    $result = $db->query($sql);

    // Checks if another project name already exists with the same name
    if ($result->num_rows > 0) {
        $errors['error_taskName'] = "Task Name is Already Exists";
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
    $sql = "UPDATE tbl_schedule_task
    SET `task_name` = '$taskName', `starting_date` = '$startDate', `ending_date` = '$endDate', `description` = '$description',
    `current_status` = '$currentStatus', `cost` = '$cost', `labour_count` = '$labourCount',`update_user` = '$updateUser', `update_date` = '$updateDate'
    WHERE `task_id` = '$taskId'";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form submitted successfully"));
    } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
