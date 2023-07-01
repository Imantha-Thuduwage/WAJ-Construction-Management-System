<?php
session_start();

include '../function.php';

if (isset($_GET['allocate_id'])) {
    $allocateId = $_GET['allocate_id'];

    // Perform the deletion operation based on the record ID
    deleteRecord($allocateId);

    // Redirect back to the previous file
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}

// Function to delete the record from the database
function deleteRecord($recordId)
{
    // Delete the record from the database
    $sql = "DELETE FROM tbl_project_machine WHERE allocate_id = $recordId";
    $db = dbConn();
    if ($db->query($sql)) {
        echo "Resource Deleted successfully";
    } else {
        echo "Form submission failed";
    }
}
