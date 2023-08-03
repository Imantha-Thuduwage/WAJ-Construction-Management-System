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
    $sql = "SELECT * FROM tbl_project WHERE project_name = '$pName'";
    $db = dbConn();
    $result = $db->query($sql);

    // Checks if another project name already exists with the same name
    if ($result->num_rows > 0) {
        $errors['error_already'] = "Project Name is Already Exists";
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
    $sql = "INSERT INTO tbl_project
            (`project_name`,`p_location`,`start_date`,`end_date`,`project_manager`,`abc_status`,`abc_unit`,`abc_quantity`,`abc_rate`,`prime_status`,
            `prime_unit`,`prime_quantity`,`prime_rate`,`tack_status`,`tack_unit`,`tack_quantity`,`tack_rate`,`asphalt_status`,`asphalt_thickness`,
            `asphalt_unit`,`asphalt_quantity`,`asphalt_rate`,`marking_status`,`bridges_count`,`total_cost`,`add_user`,`add_date`) 
            VALUES('$pName','$pLocation','$startDate','$endDate','$proManager','$abcStatus','$abcUnit','$abcQuantity','$abcRate','$primeStatus','$primeUnit','$primeQuantity','$primeRate',
            '$tackStatus','$tackUnit','$tackQuantity','$tackRate','$asphaltStatus','$asphaltThicknes','$asphaltUnit','$asphaltQuantity','$asphaltRate',
            '$markingStatus','$bridges','$pCost','$addUser','$addDate')";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form submitted successfully"));
    } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
