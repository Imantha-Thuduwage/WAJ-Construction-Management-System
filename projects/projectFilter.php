<?php
session_start();

include '../function.php';
include '../config.php';

extract($_POST);

$where = "";

if (!empty($proId)) {
    $where .= "project_id = '$proId' AND ";
}
if (!empty($proName)) {
    $where .= "project_name = '$proName' AND ";
}
if (!empty($proManager)) {
    $where .= "project_manager = '$proManager' AND ";
}
if (!empty($startDate) && !empty($endDate)) {
    $where .= "start_date >= '$startDate' AND end_date <= '$endDate' AND ";
}
if (!empty($minCost) && !empty($maxCost)) {
    $where .= "total_cost BETWEEN '$minCost' AND '$maxCost' AND ";
}
if (!empty($where)) {
    $where = substr($where, 0, -5); // Remove the extra "AND" and whitespace
    $where = "WHERE $where";
}

$sql = "SELECT * FROM tbl_project $where";
$db = dbConn();
$result = $db->query($sql);


?>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

    ?>
            <tr class="shadow-sm">
                <td class="align-middle"><?= $row['project_id']; ?></td>
                <td class="align-middle"><?= $row['project_name']; ?></td>
                <td class="align-middle"><?= $row['p_location']; ?></td>
                <td class="align-middle"><?= $row['start_date']; ?></td>
                <td class="align-middle"><?= $row['end_date']; ?></td>
                <td class="align-middle"><?= $row['project_manager']; ?></td>
                <td class="align-middle"><?= number_format($row['total_cost'], 2); ?></td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='viewProject.php?project_id=<?= $row['project_id']; ?>'">
                        View More
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-info btn-sm">
                        <a href='deleteProject.php?project_id=<?= $row['project_id']; ?>' onclick='return confirmDelete()'>
                            <img src="<?= SYSTEM_PATH; ?>assets/icons/delete.png">
                        </a>
                    </button>
                </td>
            </tr>
    <?php
        }
    }
    ?>
