<?php
session_start();

include '../function.php';

// Create array to store error messages
$errors = array();

// This function uses array keys as variable names and values as variable values
extract($_POST);

// Required Fields Validation
if (empty($employeeId)) {
    $errors['error_employeeId'] = "Employee ID is Required";
}
if (empty($basicSal)) {
    $errors['error_basicSal'] = "Basic Salary is Required";
}
if (empty($companyAllowance)) {
    $errors['error_companyAllowance'] = "Company Allowance is Required";
}

// Advanced Validation 
else if (!empty($employeeId)) {
    $sql = "SELECT * FROM tbl_salary WHERE employee_id = '$employeeId'";
    $db = dbConn();
    $result = $db->query($sql);

    // Checks if another project name already exists with the same name
    if ($result->num_rows > 0) {
        $errors['error_employeeId'] = "Employee ID is Already Exists";
    }
    // Check Validation is Completed
    else if (empty($_SESSION['status'])) {
        // Retrieving values for fields that are not in the form
        $addUser = $_SESSION['userid'];
        $addDate = date('y-m-d');
    }
}

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling DB Connection
    $sql = "INSERT INTO tbl_salary
            (`employee_id`, `basic_salary`, `company_allowance`, `add_user`, `add_date`) 
            VALUES ('$employeeId', '$basicSal', '$companyAllowance', '$addUser', '$addDate')";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form submitted successfully"));
    } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
