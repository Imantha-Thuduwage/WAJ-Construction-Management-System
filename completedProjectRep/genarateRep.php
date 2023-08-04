<?php
session_start();

include '../function.php';
include '../config.php';

// SQL Query for Get Count of All Completed Projects
$sql = "SELECT p.project_id, project_name, p_location, `start_date`, end_date, 
project_manager, total_cost, current_status
FROM tbl_project p
LEFT JOIN tbl_schedule_task st
ON st.project_id = p.project_id
-- Why we getting current_status like this because if we get status = 4, this will give if one task is done all project is done
WHERE current_status <> 1 AND current_status <> 2 AND current_status <> 3 AND current_status <> 5
GROUP BY p.project_id";
$db = dbConn();
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
            <td class="align-middle"><?= $row['start_date']; ?></td>
            <td class="align-middle"><?= $row['end_date']; ?></td>
            <td class="align-middle"><?= $row['project_manager']; ?></td>
            <td class="align-middle"><?= number_format($row['total_cost'], 2); ?></td>
        </tr>
<?php
    }
}
?>

?>