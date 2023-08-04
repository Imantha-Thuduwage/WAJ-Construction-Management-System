<?php
session_start();

include '../function.php';

// Create array to store error messages
$errors = array();

// This function uses array keys as variable names and values as variable values
extract($_POST);

// Required Fields Validation
if (empty($proId)) {
    $errors['error_proId'] = "Project ID is Required";
}

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling DB Connection
    $sql = "SELECT p.project_id, p.project_name, p.p_location, p.project_manager, p.total_cost, s.schedule_id,
    t.task_id, t.task_name, t.starting_date, t.ending_date, t.current_status
    FROM tbl_project p
    LEFT JOIN tbl_schedule s ON p.project_id = s.project_id
    LEFT JOIN tbl_schedule_task t ON p.project_id = t.project_id
    WHERE p.project_id = '$proId'";

    $db = dbConn();

    // Execute the SQL query
    $result = $db->query($sql);

?>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

    ?>
            <tr class="shadow-sm">
                <td class="align-middle"><?= $row['project_id']; ?></td>
                <td class="align-middle"><?= $row['project_name']; ?></td>
                <td class="align-middle"><?= $row['p_location']; ?></td>
                <td class="align-middle"><?= $row['project_manager']; ?></td>
                <td class="align-middle"><?= $row['total_cost']; ?></td>
                <td class="align-middle"><?= $row['schedule_id']; ?></td>
                <td class="align-middle"><?= $row['task_id']; ?></td>
                <td class="align-middle"><?= $row['task_name']; ?></td>
                <td class="align-middle"><?= $row['starting_date']; ?></td>
                <td class="align-middle"><?= $row['ending_date']; ?></td>
                <td class="align-middle"><?= $row['current_status']; ?></td>
            </tr>
<?php
        }
    }
}
?>