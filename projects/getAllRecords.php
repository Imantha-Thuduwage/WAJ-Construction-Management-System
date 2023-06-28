<?php
session_start();

include '../function.php';
include '../config.php';

$sql = "SELECT * FROM tbl_project";
$db = dbConn();
$result = $db->query($sql);

?>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

    ?>
            <tr class="shadow-sm">
                <td class="align-middle"><?= $row['project_id']; ?></td>
                <td class="align-middle"><?= $row['project_name']; ?></td>
                <td class="align-middle"><?= $row['p_location']; ?></td>
                <td class="align-middle"><?= $row['start_date']; ?></td>
                <td class="align-middle"><?= $row['end_date']; ?></td>
                <td class="align-middle"><?= $row['project_manager']; ?></td>
                <td class="align-middle"><?= number_format($row['total_cost'], 2); ?></td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='viewProject.php?project_id=<?= $row['project_id']; ?>'">
                        View More
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-sm">
                        <a href='deleteProject.php?project_id=<?= $row['project_id']; ?>' onclick='return confirmDelete()'>
                            <img src="<?= SYSTEM_PATH; ?>assets/icons/delete.png">
                        </a>
                    </button>
                </td>
            </tr>
    <?php
        }
    }
    ?>
