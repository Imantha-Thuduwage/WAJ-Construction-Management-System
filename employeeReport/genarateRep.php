<?php
session_start();

include '../function.php';
include '../config.php';

extract($_POST);

$where = "";

if (!empty($empId)) {
    $where .= "employee_id = '$empId' AND ";
}
if (!empty($empName)) {
    $where .= "first_name = '$empName' AND ";
}
if (!empty($nicNum)) {
    $where .= "nic_number = '$nicNum' AND ";
}
if (!empty($joinedDate)) {
    $where .= "date_of_joining = '$joinedDate' AND ";
}
if (!empty($contactNum)) {
    $where .= "contact_number = '$contactNum' AND ";
}
if (!empty($dob)) {
    $where .= "date_of_birth = '$dob' AND ";
}
if (!empty($where)) {
    $where = substr($where, 0, -5); // Remove the extra "AND" and whitespace
    $where = "WHERE $where";
}

$sql = "SELECT * FROM tbl_employee $where";
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
        </tr>
<?php
    }
}
?>