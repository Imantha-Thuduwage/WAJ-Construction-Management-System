<?php
session_start();

include '../function.php';
include '../config.php';

extract($_POST);

$where = "";

if (!empty($userId)) {
    $where .= "user_id = '$userId' AND ";
}
if (!empty($userName)) {
    $where .= "user_name = '$userName' AND ";
}
if (!empty($firstName)) {
    $where .= "first_name = '$firstName' AND ";
}
if (!empty($lastName)) {
    $where .= "last_name = '$lastName' AND ";
}
if (!empty($userRole)) {
    $where .= "role_id = '$userRole' AND ";
}
if (!empty($where)) {
    $where = substr($where, 0, -5); // Remove the extra "AND" and whitespace
    $where = "WHERE $where";
}

$sql = "SELECT user_id, user_name, first_name, last_name, role_id
FROM tbl_user $where";
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
            <td class="align-middle"><?= $row['user_id']; ?></td>
            <td class="align-middle"><?= $row['user_name']; ?></td>
            <td class="align-middle"><?= $row['first_name']; ?></td>
            <td class="align-middle"><?= $row['last_name']; ?></td>
            <td class="align-middle"><?= $row['role_id']; ?></td>
        </tr>
<?php
    }
}
?>