<?php
session_start();

include '../function.php';
include '../config.php';

extract($_POST);

$where = "";

if (!empty($attendanceId)) {
    $where .= "attendance_id = '$attendanceId' AND ";
}
if (!empty($empId)) {
    $where .= "employee_id = '$empId' AND ";
}
if (!empty($attendDate)) {
    $where .= "attendance_date = '$attendDate' AND ";
}
if (!empty($attendType)) {
    $where .= "attend_type = '$attendType' AND ";
}
if (!empty($where)) {
    $where = substr($where, 0, -5); // Remove the extra "AND" and whitespace
    $where = "WHERE $where";
}

$sql = "SELECT * FROM tbl_attendance $where";
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