<?php
session_start();

include '../function.php';
include '../config.php';

extract($_POST);

$where = "";

if (!empty($salaryId)) {
    $where .= "salary_id = '$salaryId' AND ";
}
if (!empty($employeeId)) {
    $where .= "employee_id = '$employeeId' AND ";
}
if (!empty($minCost) && !empty($maxCost)) {
    $where .= "basic_salary BETWEEN '$minCost' AND '$maxCost' AND ";
}
if (!empty($where)) {
    $where = substr($where, 0, -5); // Remove the extra "AND" and whitespace
    $where = "WHERE $where";
}

$sql = "SELECT * FROM tbl_salary $where";
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
