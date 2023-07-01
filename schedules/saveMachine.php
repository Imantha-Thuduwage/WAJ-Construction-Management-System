<?php
session_start();

include '../function.php';

$db = dbConn();

// Retrieve the values from the POST request
$machineId = $_POST['machine_id'];
$machineName = $_POST['machine_name'];
$proId = $_POST['project_id'];
$schId = $_POST['schedule_id'];

// Perform appropriate data sanitization and validation

// Execute the SQL query
$sql = "INSERT INTO tbl_project_machine (`machine_id`, `machine_name`, `project_id`, `schedule_id`) 
        VALUES ('$machineId', '$machineName', '$proId', '$schId')";
if ($db->query($sql)) {
    echo "Form submitted successfully";
} else {
    echo "Form submission failed";
}
?>
