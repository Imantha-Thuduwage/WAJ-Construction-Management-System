<?php
session_start();

include '../function.php';
include '../config.php';

$sql = "SELECT * FROM tbl_machine";
$db = dbConn();
$result = $db->query($sql);

?>

<?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

    ?>
            <tr class="shadow-sm">
                <td class="align-middle"><?= $row['machine_id']; ?></td>
                <td class="align-middle"><?= $row['machine_name']; ?></td>
                <td class="align-middle"><?= $row['serial_number']; ?></td>
                <td class="align-middle"><?= $row['purchase_date']; ?></td>
                <td class="align-middle"><?= $row['condition']; ?></td>
                <td class="align-middle"><?= $row['fuel_type']; ?></td>
                <td class="align-middle"><?= $row['brand']; ?></td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='editMachine.php?machine_id=<?= $row['machine_id']; ?>'">
                        View More
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-sm inactive-circle">
                        <a href='deleteMachine.php?machine_id=<?= $row['machine_id']; ?>' onclick='return confirmDelete()'>
                            <img src="<?= SYSTEM_PATH; ?>assets/icons/delete.png">
                        </a>
                    </button>
                </td>
            </tr>
    <?php
        }
    }
    ?>