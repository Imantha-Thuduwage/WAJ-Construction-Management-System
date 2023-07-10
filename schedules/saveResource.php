<?php
session_start();

include '../function.php';

$db = dbConn();

// Retrieve the values from the POST request
$toolId = $_POST['tool_id'];
$toolName = $_POST['tool_name'];
$proId = $_POST['project_id'];
$schId = $_POST['schedule_id'];

// Perform appropriate data sanitization and validation

// Execute the SQL query
$sql = "INSERT INTO tbl_project_tool (`tool_id`, `tool_name`, `project_id`, `schedule_id`) 
        VALUES ('$toolId', '$toolName', '$proId', '$schId')";
if ($db->query($sql)) {
    echo "Form submitted successfully";
} else {
    echo "Form submission failed";
}
?>
