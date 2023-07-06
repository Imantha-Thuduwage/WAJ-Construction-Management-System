<?php
session_start();

include '../function.php';
include '../config.php';

$sql = "SELECT * FROM tbl_user WHERE `status` = 1";
$db = dbConn();
$result = $db->query($sql);

?>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

?>
        <tr class="shadow-sm">
            <td class="align-middle"><?= $row['role_id']; ?></td>
            <td class="align-middle"><?= $row['user_name']; ?></td>
            <td class="align-middle"><?= $row['first_name']; ?></td>
            <td class="align-middle"><?= $row['last_name']; ?></td>
            <td class="align-middle"><?= $row['role_id']; ?></td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='editUser.php?user_id=<?= $row['user_id']; ?>'">
                    View More
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm">
                    <a href='deactivateUser.php?user_id=<?= $row['user_id']; ?>' onclick='return confirmDelete()'>
                        <img src="<?= SYSTEM_PATH; ?>assets/icons/delete.png">
                    </a>
                </button>
            </td>
        </tr>
<?php
    }
}
?>