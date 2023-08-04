<?php
session_start();

include '../function.php';
include '../config.php';

$sql = "SELECT * FROM tbl_attendance";
$db = dbConn();
$result = $db->query($sql);

?>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

    ?>
            <tr class="shadow-sm">
                <td class="align-middle"><?= $row['attendance_id']; ?></td>
                <td class="align-middle"><?= $row['employee_id']; ?></td>
                <td class="align-middle"><?= $row['attendance_date']; ?></td>
                <td class="align-middle"><?= $row['attend_type']; ?></td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='editAttendance.php?attendance_id=<?= $row['attendance_id']; ?>'">
                        View More
                    </button>
                </td>
                <td>
                <button type="button" class="btn btn-outline-info btn-sm">
                    <a href='#' onclick="confirmDelete('<?= $row['attendance_id']; ?>')">
                        <img src="<?= SYSTEM_PATH; ?>assets/icons/delete.png">
                    </a>
                </button>
                </td>
            </tr>
    <?php
        }
    }
    ?>
