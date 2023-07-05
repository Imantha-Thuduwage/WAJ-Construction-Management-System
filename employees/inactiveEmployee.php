<?php
session_start();

include '../function.php';

if (isset($_GET['employee_id'])) {
    $empId = $_GET['employee_id'];

    // Perform the deletion operation based on the record ID
    inactiveEmployee($empId);
}
// Function to delete the record from the database
function inactiveEmployee($recordId)
{
    // Delete the record from the database
    $sql = "UPDATE tbl_employee SET `employee_status` = 0 WHERE employee_id = $recordId";
    $db = dbConn();
    if ($db->query($sql)) {
        echo "Form submitted successfully";
    } else {
        echo "Form submission failed";
    }

    // Redirect back to the previous page
    header("Location: employee.php");
    exit();
}
