<?php
session_start();

include '../function.php';
include '../config.php';

extract($_POST);

$where = "";

if (!empty($proId)) {
    $where .= "project_id = '$proId' AND ";
}
if (!empty($attendanceType)) {
    $where .= "attend_type = '$attendanceType' AND ";
}
if (!empty($startDate) && !empty($endDate)) {
    $where .= "attendance_date BETWEEN '$startDate' AND '$endDate' AND ";
}
if (!empty($where)) {
    $where = substr($where, 0, -5); // Remove the extra "AND" and whitespace
    $where = "WHERE $where";
}

$sql = "SELECT e.employee_id, first_name, nic_number, attendance_date, attend_type
FROM tbl_employee e
LEFT JOIN tbl_attendance a ON e.employee_id = a.employee_id $where 
GROUP BY e.employee_id";
$db = dbConn();
$result = $db->query($sql);


// Execute the SQL query
$result = $db->query($sql);

?>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <tr class="shadow-sm">
            <td class="align-middle"><?= $row['employee_id']; ?></td>
            <td class="align-middle"><?= $row['first_name']; ?></td>
            <td class="align-middle"><?= $row['nic_number']; ?></td>
            <td class="align-middle"><?= $row['attendance_date']; ?></td>
            <td class="align-middle"><?= $row['attend_type']; ?></td>
        </tr>
        <?php
    }
}
?>
