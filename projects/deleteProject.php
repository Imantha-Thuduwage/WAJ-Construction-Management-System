<?php
session_start();

include '../function.php';

if (isset($_GET['project_id'])) {
    $pId = $_GET['project_id'];

    // Perform the deletion operation based on the record ID
    deleteRecord($pId);
}
// Function to delete the record from the database
function deleteRecord($recordId)
{
    // Delete the record from the database
    $sql = "DELETE FROM tbl_project WHERE project_id = $recordId";
    $db = dbConn();
    if ($db->query($sql)) {
        $_SESSION['success_message'] = "Record deleted successfully";
    } else {
        $_SESSION['error_message'] = "Failed to delete the record";
    }

    // Redirect back to the previous page
    header("Location: project.php");
    exit();
}

