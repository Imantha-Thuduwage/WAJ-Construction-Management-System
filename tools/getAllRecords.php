<?php
session_start();

include '../function.php';
include '../config.php';

$sql = "SELECT * FROM tbl_tool";
$db = dbConn();
$result = $db->query($sql);

?>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

?>
        <tr class="shadow-sm">
            <td class="align-middle"><?= $row['tool_id']; ?></td>
            <td class="align-middle"><?= $row['tool_name']; ?></td>
            <td class="align-middle"><?= $row['purchase_date']; ?></td>
            <td class="align-middle"><?= $row['current_condition']; ?></td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='editTool.php?tool_id=<?= $row['tool_id']; ?>'">
                    View More
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm">
                    <a href='#' onclick="confirmDelete('<?= $row['tool_id']; ?>')">
                        <img src="<?= SYSTEM_PATH; ?>assets/icons/delete.png">
                    </a>
                </button>
            </td>
        </tr>
<?php
    }
}
?>