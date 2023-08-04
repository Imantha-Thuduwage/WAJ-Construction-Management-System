<?php
session_start();

include '../function.php';

if (isset($_GET['petty_id'])) {
    $pettyId = $_GET['petty_id'];

    // Perform the deletion operation based on the record ID
    deleteRecord($pettyId);
}
// Function to delete the record from the database
function deleteRecord($recordId)
{
    // Delete the record from the database
    $sql = "DELETE FROM tbl_petty_cash WHERE petty_id = $recordId";
    $db = dbConn();
    if ($db->query($sql)) {
        echo "Form submitted successfully";
    } else {
        echo "Form submission failed";
    }

    // Redirect back to the previous page
    header("Location: pettyCash.php");
    exit();
}
