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

$sql = "SELECT p.project_id, project_name, start_date, end_date, total_cost, 
SUM(payed_amount) AS total_income 
FROM tbl_project p
LEFT JOIN tbl_payment py ON p.project_id = py.project_id $where 
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
            <td class="align-middle"><?= $row['total_income']; ?></td>
        </tr>
        <?php
        $totalIncome += $row['total_income']; // Accumulate the total income
    }
}
?>

<!-- Display the total income row -->
<tr class="shadow-sm">
    <td colspan="5"></td>
    <td class="align-middle">Sum of Income <br> <?= number_format($totalIncome, 2); ?></td>
</tr>
