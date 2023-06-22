<?php
session_start();

include '../function.php';

$db = dbConn();

// Retrieve the values from the POST request
$resourceId = $_POST['resource_id'];
$proId = $_POST['project_id'];
$schId = $_POST['schedule_id'];

// Perform appropriate data sanitization and validation

// Execute the SQL query
$sql = "INSERT INTO tbl_project_resource (`resource_id`, `project_id`, `schedule_id`) 
        VALUES ('$resourceId', '$proId', '$schId')";
if ($db->query($sql)) {
    echo "Form submitted successfully";
} else {
    echo "Form submission failed";
}
?>
