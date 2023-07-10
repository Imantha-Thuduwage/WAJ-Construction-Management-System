<?php
session_start();

include '../function.php';
include '../config.php';

$sql = "SELECT * FROM tbl_payment";
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
                        <a href='deletePayment.php?payment_id=<?= $row['payment_id']; ?>' onclick='return confirmDelete()'>
                            <img src="<?= SYSTEM_PATH; ?>assets/icons/delete.png">
                        </a>
                    </button>
                </td>
            </tr>
    <?php
        }
    }
    ?>
