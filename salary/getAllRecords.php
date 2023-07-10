<?php
session_start();

include '../function.php';
include '../config.php';

$sql = "SELECT * FROM tbl_salary";
$db = dbConn();
$result = $db->query($sql);

?>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

    ?>
            <tr class="shadow-sm">
                <td class="align-middle"><?= $row['salary_id']; ?></td>
                <td class="align-middle"><?= $row['employee_id']; ?></td>
                <td class="align-middle"><?= $row['basic_salary']; ?></td>
                <td class="align-middle"><?= $row['company_allowance']; ?></td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='editSalary.php?salary_id=<?= $row['salary_id']; ?>'">
                        View More
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-sm">
                        <a href='deleteSalary.php?salary_id=<?= $row['salary_id']; ?>' onclick='return confirmDelete()'>
                            <img src="<?= SYSTEM_PATH; ?>assets/icons/delete.png">
                        </a>
                    </button>
                </td>
            </tr>
    <?php
        }
    }
    ?>
