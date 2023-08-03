<?php
session_start();

include '../function.php';
include '../config.php';

extract($_POST);

$where = "";

if (!empty($payrollId)) {
    $where .= "payroll_id = '$payrollId' AND ";
}
if (!empty($empId)) {
    $where .= "employee_id = '$empId' AND ";
}
if (!empty($month)) {
    $where .= "month = '$month-01' AND ";
}
if (!empty($where)) {
    $where = substr($where, 0, -5); // Remove the extra "AND" and whitespace
    $where = "WHERE $where";
}

$sql = "SELECT * FROM tbl_payroll $where";
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
                <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='viewPaySheet.php?payroll_id=<?= $row['payroll_id']; ?>'">
                    Coin Analysis
                </button>
            </td>
        </tr>
<?php
    }
}
?>