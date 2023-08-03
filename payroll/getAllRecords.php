<?php
session_start();

include '../function.php';
include '../config.php';

$sql = "SELECT * FROM tbl_payroll";
$db = dbConn();
$result = $db->query($sql);

?>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

    ?>
            <tr class="shadow-sm">
                <td class="align-middle"><?= $row['payroll_id']; ?></td>
                <td class="align-middle"><?= $row['employee_id']; ?></td>
                <td class="align-middle"><?= $row['employee_name']; ?></td>
                <td class="align-middle"><?= $row['month']; ?></td>
                <td class="align-middle"><?= $row['net_salary']; ?></td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='viewPaySheet.php?payroll_id=<?= $row['payroll_id']; ?>'">
                        View
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='coinAnalysis.php?payroll_id=<?= $row['payroll_id']; ?>'">
                        Coin Analysis
                    </button>
                </td>
            </tr>
    <?php
        }
    }
    ?>
