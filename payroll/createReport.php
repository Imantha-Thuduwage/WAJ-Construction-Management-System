<?php
session_start();

include '../function.php';

// Create array to store error messages
$errors = array();

// This function uses array keys as variable names and values as variable values
extract($_POST);

// Required Fields Validation
if (empty($empId)) {
    $errors['error_empId'] = "Employee ID is Required";
}
if (empty($startDate)) {
    $errors['error_startDate'] = "Start Date is Required";
}
if (empty($endDate)) {
    $errors['error_endDate'] = "End Date is Required";
}

// Check Validation is Completed
else if (empty($_SESSION['status'])) {
    // Retrieving values for fields that are not in the form
    $addUser = $_SESSION['userid'];
    $addDate = date('y-m-d');
}

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling DB Connection
    $db = dbConn();

    // Retrieve employee details
    $employeeId = $empId;
    $employeeName = '';
    $attendanceCount = 0;
    $basicSalary = 0;
    $companyAllowance = 0;
    $totalAdvance = 0;

    // Query to retrieve employee details
    $sql = "SELECT employee_id, first_name, last_name FROM tbl_employee WHERE employee_id = '$employeeId'";
    $employeeResult = $db->query($sql);

    if ($employeeResult->num_rows > 0) {
        while ($row = $employeeResult->fetch_assoc()) {
            $employeeName = $row['first_name'] . ' ' . $row['last_name'];
        }

        // Query to retrieve attendance count
        $attendanceSql = "SELECT COUNT(attendance_id) AS attendance_count FROM tbl_attendance WHERE employee_id = '$employeeId' 
                AND attendance_date BETWEEN '$startDate' AND '$endDate' AND attend_type = 'full day'";
        $attendanceResult = $db->query($attendanceSql);
        if ($attendanceResult->num_rows > 0) {
            while ($row = $attendanceResult->fetch_assoc()) {
                $attendanceCount = $row['attendance_count'];
            }

            // Query to retrieve salary details
            $salarySql = "SELECT basic_salary, company_allowance FROM tbl_salary WHERE employee_id = '$employeeId'";
            $salaryResult = $db->query($salarySql);
            if ($salaryResult->num_rows > 0) {
                while ($row = $salaryResult->fetch_assoc()) {
                    $basicSalary = $row['basic_salary'];
                    $companyAllowance = $row['company_allowance'];
                }

                // Query to retrieve total advance
                $advanceSql = "SELECT COALESCE(SUM(advance_amount), 0) AS total_advance FROM tbl_advance WHERE employee_id = '$employeeId' 
                        AND given_date BETWEEN '$startDate' AND '$endDate'";
                $advanceResult = $db->query($advanceSql);
                if ($advanceResult->num_rows > 0) {
                    while ($row = $advanceResult->fetch_assoc()) {
                        $totalAdvance = $row['total_advance'];
                    }
                }
            }
        }

        // Perform the necessary calculations to determine the monthly salary and net salary
        // Replace the placeholder calculation with your actual payroll calculation logic
        if ($attendanceCount > 20) {
            $monthlySalary = ($basicSalary + $companyAllowance);
            $netSalary = $monthlySalary - $totalAdvance;
        } else {
            $noPayDays = 20 - $attendanceCount;
            $monthlySalary = $basicSalary - (($basicSalary / 30) * $noPayDays);
            $netSalary = $monthlySalary - $totalAdvance;
        }

        // Output the calculated values
        $output = '<div class="pay-sheet">';
            $output .= '<h2>Pay Sheet</h2>';
            $output .= '<table>';
                $output .= '<tr>
                    <th>Employee ID</th>
                    <td>' . $employeeId . '</td>
                </tr>';
                $output .= '<tr>
                    <th>Employee Name</th>
                    <td>' . $employeeName . '</td>
                </tr>';
                $output .= '<tr>
                    <th>Attendance Count</th>
                    <td>' . $attendanceCount . '</td>
                </tr>';
                $output .= '<tr>
                    <th>Basic Salary</th>
                    <td>' . $basicSalary . '</td>
                </tr>';
                $output .= '<tr>
                    <th>Company Allowance</th>
                    <td>' . $companyAllowance . '</td>
                </tr>';
                $output .= '<tr>
                    <th>Total Advance</th>
                    <td>' . $totalAdvance . '</td>
                </tr>';
                $output .= '<tr>
                    <th>Monthly Salary</th>
                    <td>' . $monthlySalary . '</td>
                </tr>';
                $output .= '<tr>
                    <th>Net Salary</th>
                    <td>' . $netSalary . '</td>
                </tr>';
                $output .= '</table>';
            $output .= '</div>';

        echo $output;

  } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
?>