<?php
session_start();

include '../../function.php';
include '../../config.php';

$sql = "SELECT * FROM tbl_tool_assign";
$db = dbConn();
$result = $db->query($sql);

?>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

?>
        <tr class="shadow-sm">
            <td class="align-middle"><?= $row['assign_id']; ?></td>
            <td class="align-middle"><?= $row['project_id']; ?></td>
            <td class="align-middle"><?= $row['tool_id']; ?></td>
            <td class="align-middle"><?= $row['assign_date']; ?></td>
            <td class="align-middle"><?= $row['return_date']; ?></td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='editAssign.php?assign_id=<?= $row['assign_id']; ?>'">
                    View More
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm">
                    <a href='#' onclick="confirmDelete('<?= $row['assign_id']; ?>')">
                        <img src="<?= SYSTEM_PATH; ?>assets/icons/delete.png">
                    </a>
                </button>
            </td>
        </tr>
<?php
    }
}
?>