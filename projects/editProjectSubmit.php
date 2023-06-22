<?php
session_start();

include '../function.php';

// Create array for store Error Meassages
$errors = array();

// This function uses array keys as variable names and values as variable values
extract($_POST);

// Required Fields Validation
if (empty($pName)) {
    $errors['error_pName'] = "Project Name is Required";
}
if (empty($pLocation)) {
    $errors['error_location'] = "Location is Required";
}
if (empty($startDate)) {
    $errors['error_startDate'] = "Starting Date is Required";
}
if (empty($endDate)) {
    $errors['error_endDate'] = "Ending Date is Required";
}
if (empty($proManager)) {
    $errors['error_proManager'] = "Project Manager is Required";
}
if (empty($abcStatus)) {
    $errors['error_abcStatus'] = "Please Select Value";
}
if ($abcStatus == "1" && empty($abcUnit)) {
    $errors['error_abcUnit'] = "Unit is Required";
}
if ($abcStatus == "1" && empty($abcQuantity)) {
    $errors['error_abcQuantity'] = "Quantity is Required";
}
if ($abcStatus == "1" && empty($abcRate)) {
    $errors['error_abcRate'] = "Rate is Required";
}
if (empty($primeStatus)) {
    $errors['error_primeStatus'] = "Please Select Value";
}
if ($primeStatus == "1" && empty($primeUnit)) {
    $errors['error_primeUnit'] = "Unit is Required";
}
if ($primeStatus == "1" && empty($primeQuantity)) {
    $errors['error_primeQuantity'] = "Quantity is Required";
}
if ($primeStatus == "1" && empty($primeRate)) {
    $errors['error_primeRate'] = "Rate is Required";
}
if (empty($tackStatus)) {
    $errors['error_tackStatus'] = "Please Select Value";
}
if ($tackStatus == "1" && empty($tackUnit)) {
    $errors['error_tackUnit'] = "Unit is Required";
}
if ($tackStatus == "1" && empty($tackQuantity)) {
    $errors['error_tackQuantity'] = "Quantity is Required";
}
if ($tackStatus == "1" && empty($tackRate)) {
    $errors['error_tackRate'] = "Rate is Required";
}
if (empty($asphaltStatus)) {
    $errors['error_asphaltStatus'] = "Please Select Value";
}
if ($asphaltStatus == "1" && empty($asphaltThicknes)) {
    $errors['error_asphaltThicknes'] = "Unit is Required";
}
if ($asphaltStatus == "1" && empty($asphaltUnit)) {
    $errors['error_asphaltUnit'] = "Unit is Required";
}
if ($asphaltStatus == "1" && empty($asphaltQuantity)) {
    $errors['error_asphaltQuantity'] = "Quantity is Required";
}
if ($asphaltStatus == "1" && empty($asphaltRate)) {
    $errors['error_asphaltRate'] = "Rate is Required";
}
if (empty($markingStatus)) {
    $errors['error_markingStatus'] = "Please Select Value";
}
if (empty($bridges)) {
    $errors['error_bridges'] = "Bridge Count is Required";
}
if (empty($pCost)) {
    $errors['error_pCost'] = "Total Cost s Required";
}



// Advanced Validation 
else if (!empty($pName)) {
    $sql = "SELECT * FROM tbl_project WHERE project_name = '$pName' AND project_id <> '$pId'";
    $db = dbConn();
    $result = $db->query($sql);

    // Checks if another project name already exists with the same name
    if ($result->num_rows > 0) {
        $errors['error_pName'] = "Project Name is Already Exists";
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
    // Calling to DB Connection
    $sql = "UPDATE tbl_project
    SET `project_name` = '$pName', `p_location` = '$pLocation', `start_date` = '$startDate', `end_date` = '$endDate', `project_manager` = '$proManager',
    `abc_status` = '$abcStatus', `abc_unit` = '$abcUnit', `abc_quantity` = '$abcQuantity', `abc_rate` = '$abcRate',
    `prime_status` = '$primeStatus', `prime_unit` = '$primeUnit', `prime_quantity` = '$primeQuantity', `prime_rate` = '$primeRate',
    `tack_status` = '$tackStatus', `tack_unit` = '$tackUnit', `tack_quantity` = '$tackQuantity', `tack_rate` = '$tackRate',
    `asphalt_status` = '$asphaltStatus', `asphalt_thickness` = '$asphaltThicknes', `asphalt_unit` = '$asphaltUnit', `asphalt_quantity` = '$asphaltQuantity', `asphalt_rate` = '$asphaltRate',
    `marking_status` = '$markingStatus', `bridges_count` = '$bridges', `total_cost` = '$pCost', `update_user` = '$addUser', `update_date` = '$addDate'
    WHERE `project_id` = '$pId'";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form submitted successfully"));
    } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
