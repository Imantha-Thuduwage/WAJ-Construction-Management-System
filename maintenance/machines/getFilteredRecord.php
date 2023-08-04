<?php
session_start();

include '../../function.php';
include '../../config.php';

extract($_POST);

$where = "";

if (!empty($maintenanceId)) {
    $where .= "maintenance_id = '$maintenanceId' AND ";
}
if (!empty($machineId)) {
    $where .= "machine_id = '$machineId' AND ";
}
if (!empty($startDate) && !empty($endDate)) {
    $where .= "maintenance_date BETWEEN '$startDate' AND '$endDate' AND ";
}
if (!empty($where)) {
    $where = substr($where, 0, -5); // Remove the extra "AND" and whitespace
    $where = "WHERE $where";
}

$sql = "SELECT * FROM tbl_machine_maintenance $where";
$db = dbConn();
$result = $db->query($sql);


?>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

?>
        <tr class="shadow-sm">
            <td class="align-middle"><?= $row['maintenance_id']; ?></td>
            <td class="align-middle"><?= $row['machine_id']; ?></td>
            <td class="align-middle"><?= $row['maintenance_date']; ?></td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='editMaintenance.php?maintenance_id=<?= $row['maintenance_id']; ?>'">
                    View More
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm">
                    <a href='#' onclick="confirmDelete('<?= $row['maintenance_id']; ?>')">
                        <img src="<?= SYSTEM_PATH; ?>assets/icons/delete.png">
                    </a>
                    </button>
            </td>
        </tr>
<?php
    }
}
?>