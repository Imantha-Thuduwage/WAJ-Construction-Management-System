<?php
session_start();

include '../function.php';

// Calling DB Connection
$sql = "SELECT p.project_id, p.project_name, p.start_date, p.end_date, p.total_cost, 
SUM(py.payed_amount) AS total_income
    FROM tbl_project p
    LEFT JOIN tbl_payment py ON p.project_id = p.project_id
    GROUP BY p.project_id";

$db = dbConn();

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
            <td class="align-middle"><?= $row['total_cost']; ?></td>
            <td class="align-middle"><?= $row['start_date']; ?></td>
            <td class="align-middle"><?= $row['end_date']; ?></td>
            <td class="align-middle"><?= $row['total_income']; ?></td>
        </tr>
<?php
    }
}
?>
