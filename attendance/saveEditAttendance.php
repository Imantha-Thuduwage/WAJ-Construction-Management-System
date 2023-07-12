<?php
session_start();

include '../function.php';

// Create array to store error messages
$errors = array();

// This function uses array keys as variable names and values as variable values
extract($_POST);

// Required Fields Validation
if (empty($empId)) {
    $errors['error_empId'] = "Employee ID is Required";
}
if (empty($attendDate)) {
    $errors['error_attendDate'] = "Attend Date is Required";
}
if (empty($attendanceType)) {
    $errors['error_attendanceType'] = "Attendance Type is Required";
}

// Check Validation is Completed
else if (empty($errors)) {
    $sql = "SELECT * FROM tbl_attendance WHERE employee_id = '$empId' 
    AND attendance_date = '$attendDate' AND attendance_id <> '$attendanceId'";
    $db = dbConn();
    $result = $db->query($sql);

    // Checks if another project name already exists with the same name
    if ($result->num_rows > 0) {
        $errors['error_attendDate'] = "Already Marked This Day Attendance";
    }
}

if (empty($_SESSION['status'])) {
    // Retrieving values for fields that are not in the form
    $updateUser = $_SESSION['userid'];
    $updateDate = date('y-m-d');
}

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling DB Connection
    $sql = "UPDATE tbl_attendance
    SET `employee_id` = '$empId', `attendance_date` = '$attendDate', `attend_type` = '$attendanceType',
    `update_user` = '$updateUser', `update_date` = '$updateDate'
    WHERE `attendance_id` = '$attendanceId'";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form Updated successfully"));
    } else {
        echo json_encode(array('error' => "Form Updating failed"));
    }
}
