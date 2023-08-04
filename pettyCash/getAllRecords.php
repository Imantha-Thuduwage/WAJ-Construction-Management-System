<?php
session_start();

include '../function.php';
include '../config.php';

$sql = "SELECT * FROM tbl_petty_cash";
$db = dbConn();
$result = $db->query($sql);

?>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

?>
        <tr class="shadow-sm">
            <td class="align-middle"><?= $row['petty_id']; ?></td>
            <td class="align-middle"><?= $row['project_id']; ?></td>
            <td class="align-middle"><?= $row['payed_amount']; ?></td>
            <td class="align-middle"><?= $row['payed_date']; ?></td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='editPettyCash.php?petty_id=<?= $row['petty_id']; ?>'">
                    View More
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm">
                    <a href='#' onclick="confirmDelete('<?= $row['petty_id']; ?>')">
                        <img src="<?= SYSTEM_PATH; ?>assets/icons/delete.png">
                    </a>
                </button>
            </td>
        </tr>
<?php
    }
}
?>