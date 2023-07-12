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
    $sql = "SELECT * FROM tbl_attendance WHERE employee_id = '$empId' AND attendance_date = '$attendDate'";
    $db = dbConn();
    $result = $db->query($sql);

    // Checks if another project name already exists with the same name
    if ($result->num_rows > 0) {
        $errors['error_attendDate'] = "Already Marked This Day Attendance";
    }
}

if (empty($_SESSION['status'])) {
    // Retrieving values for fields that are not in the form
    $addUser = $_SESSION['userid'];
    $addDate = date('y-m-d');
}

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling DB Connection
    $sql = "INSERT INTO tbl_attendance
            (`employee_id`, `attendance_date`, `attend_type`, `add_user`, `add_date`) 
            VALUES ('$empId', '$attendDate', '$attendanceType', '$addUser', '$addDate')";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form submitted successfully"));
    } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
