<?php
session_start();

include '../function.php';

if (isset($_GET['salary_id'])) {
    $salaryId = $_GET['salary_id'];

    // Perform the deletion operation based on the record ID
    deleteRecord($salaryId);
}
// Function to delete the record from the database
function deleteRecord($recordId)
{
    // Delete the record from the database
    $sql = "DELETE FROM tbl_salary WHERE salary_id = $recordId";
    $db = dbConn();
    if ($db->query($sql)) {
        echo "Form submitted successfully";
    } else {
        echo "Form submission failed";
    }

    // Redirect back to the previous page
    header("Location: salary.php");
    exit();
}
