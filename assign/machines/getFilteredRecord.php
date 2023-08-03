<?php
session_start();

include '../../function.php';
include '../../config.php';

extract($_POST);

$where = "";

if (!empty($assignId)) {
    $where .= "assign_id = '$assignId' AND ";
}
if (!empty($proId)) {
    $where .= "project_id = '$proId' AND ";
}
if (!empty($machineId)) {
    $where .= "machine_id = '$machineId' AND ";
}
if (!empty($assignDate) && !empty($returnDate)) {
    $where .= "assign_date >= '$assignDate' AND return_date <= '$returnDate' AND ";
}
if (!empty($where)) {
    $where = substr($where, 0, -5); // Remove the extra "AND" and whitespace
    $where = "WHERE $where";
}

$sql = "SELECT * FROM tbl_machine_assign $where";
$db = dbConn();
$result = $db->query($sql);


?>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

?>
        <tr class="shadow-sm">
            <td class="align-middle"><?= $row['assign_id']; ?></td>
            <td class="align-middle"><?= $row['project_id']; ?></td>
            <td class="align-middle"><?= $row['machine_id']; ?></td>
            <td class="align-middle"><?= $row['assign_date']; ?></td>
            <td class="align-middle"><?= $row['return_date']; ?></td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='editAssign.php?assign_id=<?= $row['assign_id']; ?>'">
                    View More
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm">
                    <a href='#' onclick="confirmDelete('<?= $row['assign_id']; ?>')">
                        <img src="<?= SYSTEM_PATH; ?>assets/icons/delete.png">
                    </a>
                </button>
            </td>
        </tr>
<?php
    }
}
?>