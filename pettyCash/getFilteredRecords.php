<?php
session_start();

include '../function.php';
include '../config.php';

extract($_POST);

$where = "";

if (!empty($pettyId)) {
    $where .= "petty_id = '$pettyId' AND ";
}
if (!empty($proId)) {
    $where .= "project_id = '$proId' AND ";
}
if (!empty($startDate) && !empty($endDate)) {
    $where .= "payed_date BETWEEN '$startDate' AND '$endDate' AND ";
}
if (!empty($minCost) && !empty($maxCost)) {
    $where .= "payed_amount BETWEEN '$minCost' AND '$maxCost' AND ";
}
if (!empty($where)) {
    $where = substr($where, 0, -5); // Remove the extra "AND" and whitespace
    $where = "WHERE $where";
}

$sql = "SELECT * FROM tbl_petty_cash $where";
$db = dbConn();
$result = $db->query($sql);


?>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

?>
        <tr class="shadow-sm">
            <td class="align-middle"><?= $row['petty_id']; ?></td>
            <td class="align-middle"><?= $row['project_id']; ?></td>
            <td class="align-middle"><?= $row['payed_amount']; ?></td>
            <td class="align-middle"><?= $row['payed_date']; ?></td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='editPettyCash.php?petty_id=<?= $row['petty_id']; ?>'">
                    View More
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm">
                    <a href='#' onclick="confirmDelete('<?= $row['petty_id']; ?>')">
                        <img src="<?= SYSTEM_PATH; ?>assets/icons/delete.png">
                    </a>
                </button>
            </td>
        </tr>
<?php
    }
}
?>