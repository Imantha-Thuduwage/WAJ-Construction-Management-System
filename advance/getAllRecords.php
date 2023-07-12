<?php
session_start();

include '../function.php';
include '../config.php';

$sql = "SELECT * FROM tbl_advance";
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
                        <a href='deleteAdvance.php?payment_id=<?= $row['payment_id']; ?>' onclick='return confirmDelete()'>
                            <img src="<?= SYSTEM_PATH; ?>assets/icons/delete.png">
                        </a>
                    </button>
                </td>
            </tr>
    <?php
        }
    }
    ?>
