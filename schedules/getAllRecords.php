<?php
session_start();

include '../function.php';
include '../config.php';

$sql = "SELECT * FROM tbl_schedule";
$db = dbConn();
$result = $db->query($sql);

?>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

?>
        <tr class="shadow-sm">
            <td class="align-middle"><?= $row['schedule_id']; ?></td>
            <td class="align-middle"><?= $row['project_id']; ?></td>
            <td class="align-middle"><?= $row['project_name']; ?></td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='addTask.php?schedule_id=<?= $row['schedule_id']; ?>'">
                    Create Tasks
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='viewTask.php?schedule_id=<?= $row['schedule_id']; ?>'">
                    View Tasks
                </button>
            </td>
        </tr>
<?php
    }
}
?>