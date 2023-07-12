<?php
session_start();

include '../function.php';

// Create array to store error messages
$errors = array();

// This function uses array keys as variable names and values as variable values
extract($_POST);

// Required Fields Validation
if (empty($proId)) {
    $errors['error_proId'] = "Project ID is Required";
}
if (empty($payedAmount)) {
    $errors['error_payedAmount'] = "Payed Amount is Required";
}
if (empty($payedDate)) {
    $errors['error_payedDate'] = "Payed Date is Required";
}

// Check Validation is Completed
if (empty($_SESSION['status'])) {
    // Retrieving values for fields that are not in the form
    $updateUser = $_SESSION['userid'];
    $updateDate = date('y-m-d');
}

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling DB Connection
    $sql = "UPDATE tbl_petty_cash
    SET `project_id` = '$proId', `payed_amount` = '$payedAmount', `payed_date` = '$payedDate', `special_note` = '$description',
    `update_user` = '$updateUser', `update_date` = '$updateDate'
    WHERE `petty_id` = '$pettyId'";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form Updated successfully"));
    } else {
        echo json_encode(array('error' => "Form Updating failed"));
    }
}
