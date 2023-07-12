<?php
session_start();

include '../function.php';
include '../config.php';

extract($_POST);

$where = "";

if (!empty($advanceId)) {
    $where .= "advance_id = '$advanceId' AND ";
}
if (!empty($empId)) {
    $where .= "employee_id = '$empId' AND ";
}
if (!empty($startDate) && !empty($endDate)) {
    $where .= "given_date BETWEEN '$startDate' AND '$endDate' AND ";
}
if (!empty($minCost) && !empty($maxCost)) {
    $where .= "advance_amount BETWEEN '$minCost' AND '$maxCost' AND ";
}
if (!empty($where)) {
    $where = substr($where, 0, -5); // Remove the extra "AND" and whitespace
    $where = "WHERE $where";
}

$sql = "SELECT * FROM tbl_advance $where";
$db = dbConn();
$result = $db->query($sql);


?>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

?>
        <tr class="shadow-sm">
            <td class="align-middle"><?= $row['advance_id']; ?></td>
            <td class="align-middle"><?= $row['employee_id']; ?></td>
            <td class="align-middle"><?= $row['given_date']; ?></td>
            <td class="align-middle"><?= $row['advance_amount']; ?></td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='editAdvance.php?advance_id=<?= $row['advance_id']; ?>'">
                    View More
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm">
                    <a href='#' onclick="confirmDelete('<?= $row['advance_id']; ?>')">
                        <img src="<?= SYSTEM_PATH; ?>assets/icons/delete.png">
                    </a>
                </button>
            </td>
        </tr>
<?php
    }
}
?>