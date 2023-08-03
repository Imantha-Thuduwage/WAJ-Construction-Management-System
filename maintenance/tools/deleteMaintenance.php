<?php
session_start();

include '../../function.php';

if (isset($_GET['maintenance_id'])) {
    $maintenanceId = $_GET['maintenance_id'];

    // Perform the deletion operation based on the record ID
    deleteRecord($maintenanceId);
}
// Function to delete the record from the database
function deleteRecord($recordId)
{
    // Delete the record from the database
    $sql = "DELETE FROM tbl_tool_maintenance WHERE maintenance_id = $recordId";
    $db = dbConn();
    if ($db->query($sql)) {
        echo "Form submitted successfully";
    } else {
        echo "Form submission failed";
    }

    // Redirect back to the previous page
    header("Location: maintenance.php");
    exit();
}
