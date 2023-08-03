<?php
session_start();

include '../../function.php';
include '../../config.php';

$sql = "SELECT * FROM tbl_machine_maintenance";
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