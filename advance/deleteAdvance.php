<?php
session_start();

include '../function.php';

if (isset($_GET['advance_id'])) {
    $advanceId = $_GET['advance_id'];

    // Perform the deletion operation based on the record ID
    deleteRecord($advanceId);
}
// Function to delete the record from the database
function deleteRecord($recordId)
{
    // Delete the record from the database
    $sql = "DELETE FROM tbl_advance WHERE advance_id = $recordId";
    $db = dbConn();
    if ($db->query($sql)) {
        echo "Form submitted successfully";
    } else {
        echo "Form submission failed";
    }

    // Redirect back to the previous page
    header("Location: advance.php");
    exit();
}
