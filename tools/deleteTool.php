<?php
session_start();

include '../function.php';

if (isset($_GET['tool_id'])) {
    $toolId = $_GET['tool_id'];

    // Perform the deletion operation based on the record ID
    deleteRecord($toolId);
}
// Function to delete the record from the database
function deleteRecord($recordId)
{
    // Delete the record from the database
    $sql = "DELETE FROM tbl_tool WHERE tool_id = $recordId";
    $db = dbConn();
    if ($db->query($sql)) {
        echo "Form submitted successfully";
    } else {
        echo "Form submission failed";
    }

    // Redirect back to the previous page
    header("Location: tool.php");
    exit();
}
