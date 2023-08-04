<?php
session_start();

include '../function.php';
include '../config.php';

extract($_POST);

$where = "";

if (!empty($paymentId)) {
    $where .= "payment_id = '$paymentId' AND ";
}
if (!empty($proId)) {
    $where .= "project_id = '$proId' AND ";
}
if (!empty($payedMethod)) {
    $where .= "payed_method = '$payedMethod' AND ";
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

$sql = "SELECT * FROM tbl_payment $where";
$db = dbConn();
$result = $db->query($sql);


?>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

    ?>
            <tr class="shadow-sm">
                <td class="align-middle"><?= $row['payment_id']; ?></td>
                <td class="align-middle"><?= $row['project_id']; ?></td>
                <td class="align-middle"><?= $row['payed_amount']; ?></td>
                <td class="align-middle"><?= $row['payed_date']; ?></td>
                <td class="align-middle"><?= $row['payed_method']; ?></td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='editPayment.php?payment_id=<?= $row['payment_id']; ?>'">
                        View More
                    </button>
                </td>
                <td>
                <button type="button" class="btn btn-outline-info btn-sm">
                    <a href='#' onclick="confirmDelete('<?= $row['machine_id']; ?>')">
                        <img src="<?= SYSTEM_PATH; ?>assets/icons/delete.png">
                    </a>
                </button>
                </td>
            </tr>
    <?php
        }
    }
    ?>
