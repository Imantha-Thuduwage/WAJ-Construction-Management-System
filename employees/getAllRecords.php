<?php
session_start();

include '../function.php';
include '../config.php';

$sql = "SELECT * FROM tbl_employee WHERE employee_status = 1";
$db = dbConn();
$result = $db->query($sql);

?>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

    ?>
            <tr class="shadow-sm">
                <td class="align-middle"><?= $row['employee_id']; ?></td>
                <td class="align-middle"><?= $row['first_name']; ?></td>
                <td class="align-middle"><?= $row['last_name']; ?></td>
                <td class="align-middle"><?= $row['nic_number']; ?></td>
                <td class="align-middle"><?= $row['date_of_birth']; ?></td>
                <td class="align-middle"><?= $row['city']; ?></td>
                <td class="align-middle"><?= $row['contact_number']; ?></td>
                <td class="align-middle"><?= $row['date_of_joining']; ?></td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='editEmployee.php?employee_id=<?= $row['employee_id']; ?>'">
                        View More
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-sm inactive-circle">
                        <a href='inactiveEmployee.php?employee_id=<?= $row['employee_id']; ?>' onclick='return confirmDelete()'>
                            <img src="<?= SYSTEM_PATH; ?>assets/icons/inactive.png">
                        </a>
                    </button>
                </td>
            </tr>
    <?php
        }
    }
    ?>
