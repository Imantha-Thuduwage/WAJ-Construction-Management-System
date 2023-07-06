<?php
session_start();

include '../function.php';

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Perform the deletion operation based on the record ID
    deleteRecord($userId);
}
// Function to delete the record from the database
function deleteRecord($recordId)
{
    // Delete the record from the database
    $sql = "UPDATE tbl_user SET `status` = 0 WHERE user_id = $recordId";
    $db = dbConn();
    if ($db->query($sql)) {
        echo "User deactivated successfully";
    } else {
        echo "Form submission failed";
    }

    // Redirect back to the previous page
    header("Location: user.php");
    exit();
}
