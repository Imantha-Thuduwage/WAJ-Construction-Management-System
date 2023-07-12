<?php
session_start();

include '../function.php';
include '../config.php';

extract($_POST);

$where = "";

if (empty($empId)) {
    $errors['error_empId'] = "Employee ID is Required";
}
if (empty($startDate)) {
    $errors['error_startDate'] = "Start Date is Required";
}
if (empty($endDate)) {
    $errors['error_endDate'] = "End Date is Required";
}


if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling DB Connection
    $sql = "SELECT e.employee_id, CONCAT(e.first_name, ' ', e.last_name) AS employee_name, COUNT(a.employee_id) AS attendance_count, s.basic_salary AS basic_salary,
    s.company_allowance AS company_allowance, SUM(adv.advance_amount) AS total_advance
    FROM tbl_employee e
    LEFT JOIN tbl_attendance a ON e.employee_id = a.employee_id
    LEFT JOIN tbl_salary s ON e.employee_id = s.employee_id
    LEFT JOIN tbl_advance adv ON e.employee_id = adv.employee_id
    WHERE a.attendance_date BETWEEN $startDate AND $endDate AND e.employee_id = '$empId' AND a.attend_type = 'full day' 
    AND adv.given_date BETWEEN $startDate AND $endDate";

    // to get all employess monthly salary remove e.employee_id = '$empId' and use GROUP BY
    // GROUP BY e.employee_id";

    $db = dbConn();
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $employeeId = $row['employee_id'];
            $employeeName = $row['employee_name'];
            $attendanceCount = $row['attendance_count'];
            $basicSalary = $row['basic_salary'];
            $companyAllowance = $row['company_allowance'];
            $totalAdvance = $row['total_advance'];

            // Perform the necessary calculations to determine the monthly salary and net salary
            // Replace the placeholder calculation with your actual payroll calculation logic
            if ($attendanceCount > 20) {
                $monthlySalary = ($basicSalary + $companyAllowance);
                $netSalary = $monthlySalary - $totalAdvance;
            }else{
                $noPayDays = 20 - $attendanceCount;
                $monthlySalary = $basicSalary - (($basicSalary/30)*$noPayDays);
                $netSalary = $monthlySalary - $totalAdvance;
            }

?>
            <tr class="shadow-sm">
                <td class="align-middle"><?php echo $employeeId; ?></td>
                <td class="align-middle"><?php echo $employeeName; ?></td>
                <td class="align-middle"><?php echo $attendanceCount; ?></td>
                <td class="align-middle"><?php echo $basicSalary; ?></td>
                <td class="align-middle"><?php echo $companyAllowance; ?></td>
                <td class="align-middle"><?php echo $totalAdvance; ?></td>
                <td class="align-middle"><?php echo $monthlySalary; ?></td>
                <td class="align-middle"><?php echo $netSalary; ?></td>
            </tr>
<?php
        }
    } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
