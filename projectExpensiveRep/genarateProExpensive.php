<?php
session_start();

include '../function.php';
include '../config.php';

extract($_POST);

$where = "";

if (!empty($proId)) {
    $where .= "project_id = '$proId' AND ";
}
if (!empty($startDate)) {
    $where .= "start_date = '$startDate' AND ";
}
if (!empty($endDate)) {
    $where .= "end_date = '$endDate' AND ";
}
if (!empty($where)) {
    $where = substr($where, 0, -5); // Remove the extra "AND" and whitespace
    $where = "WHERE $where";
}

$sql = "SELECT p.project_id, project_name, start_date, end_date, total_cost, payed_date,
SUM(payed_amount) AS total_expensive
FROM tbl_project p
LEFT JOIN tbl_petty_cash pc ON p.project_id = pc.project_id $where 
GROUP BY p.project_id";
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
            <td class="align-middle"><?= $row['project_id']; ?></td>
            <td class="align-middle"><?= $row['project_name']; ?></td>
            <td class="align-middle"><?= $row['start_date']; ?></td>
            <td class="align-middle"><?= $row['end_date']; ?></td>
            <td class="align-middle"><?= $row['total_cost']; ?></td>
            <td class="align-middle"><?= $row['payed_date']; ?></td>
            <td class="align-middle"><?= $row['total_expensive']; ?></td>
        </tr>
        <?php
        $totalExpensive += $row['total_expensive']; // Accumulate the total income
    }
}
?>

<!-- Display the total income row -->
<tr class="shadow-sm">
    <td colspan="6"></td>
    <td class="align-middle">Sum of Expensive <br> <?= number_format($totalExpensive, 2); ?></td>
</tr>
