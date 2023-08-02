<?php
session_start();

include '../function.php';

// Create array to store error messages
$errors = array();

// This function uses array keys as variable names and values as variable values
$month = $_POST['month'];

// Required Fields Validation
if (empty($month)) {
    $errors['error_month'] = "Month is Required";
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
    $employeeName = '';
    $attendanceCount = 0;
    $basicSalary = 0;
    $companyAllowance = 0;
    $totalAdvance = 0;

    // Query to retrieve employee details
    $sql = "SELECT employee_id, first_name, last_name FROM tbl_employee";
    $employeeResult = $db->query($sql);

    $epfsql1 = "DELETE FROM tbl_epf WHERE `month` = '$month-01'";
    $db = dbConn();
    $db->query($epfsql1);

    $payrollsql = "DELETE FROM tbl_payroll WHERE `month` = '$month-01'";
    $db = dbConn();
    $db->query($payrollsql);

    if ($employeeResult->num_rows > 0) {
        while ($row = $employeeResult->fetch_assoc()) {
            $employeeName = $row['first_name'] . ' ' . $row['last_name'];
            $employeeId = $row['employee_id'];

            // Query to retrieve attendance count
            $attendanceSql = "SELECT COUNT(attendance_id) AS attendance_count FROM tbl_attendance WHERE employee_id = '$employeeId' 
            AND MONTH(attendance_date) = '$month' AND attend_type = 'full day'";
            $attendanceResult = $db->query($attendanceSql);
            if ($attendanceResult->num_rows > 0) {
                while ($row = $attendanceResult->fetch_assoc()) {
                    $attendanceCount = $row['attendance_count'];
                }
            }
            // Query to retrieve salary details
            $salarySql = "SELECT basic_salary, company_allowance FROM tbl_salary WHERE employee_id = '$employeeId'";
            $salaryResult = $db->query($salarySql);
            if ($salaryResult->num_rows > 0) {
                while ($row = $salaryResult->fetch_assoc()) {
                    $basicSalary = $row['basic_salary'];
                    $companyAllowance = $row['company_allowance'];
                }
            }
            // Query to retrieve total advance
            $advanceSql = "SELECT COALESCE(SUM(advance_amount), 0) AS total_advance FROM tbl_advance WHERE employee_id = '$employeeId' 
            AND MONTH(given_date) = $month";
            $advanceResult = $db->query($advanceSql);
            if ($advanceResult->num_rows > 0) {
                while ($row = $advanceResult->fetch_assoc()) {
                    $totalAdvance = $row['total_advance'];
                }
            }

            // Calculate EPF Contribution Employee and Employer
            $employeeEpfContri = ($basicSalary / 100) * 8;
            $employerEpfContri = ($basicSalary / 100) * 12;
            $employerEtfContri = ($basicSalary / 100) * 3;
            $totalContribution = ($employerEpfContri + $employerEtfContri);

            // Perform the necessary calculations to determine the monthly salary and net salary
            if ($attendanceCount > 20) {
                $monthlySalary = ($basicSalary + $companyAllowance);
                $totalDeduction = ($totalAdvance + $employeeEpfContri);
                $netSalary = $monthlySalary - $totalDeduction;
            } else {
                $noPayDays = 20 - $attendanceCount;
                $monthlySalary = $basicSalary - (($basicSalary / 30) * $noPayDays);
                $totalDeduction = ($totalAdvance + $employeeEpfContri);
                $netSalary = $monthlySalary - $totalDeduction;
            }
            $epfsql2 = "INSERT INTO tbl_epf
                (`employee_id`, `employee_contribution`, `employer_contribution`, `total_contribution`, `month`, `add_user`, `add_date`) 
                VALUES ('$employeeId', '$employeeEpfContri', '$employerEpfContri', '$totalContribution', '$month-01', '$addUser', '$addDate')";
            $db = dbConn();
            $db->query($epfsql2);

            // in month attribute we use -01 to get full date
            $payrollsq2 = "INSERT INTO tbl_payroll
                (`employee_id`, `employee_name`, `month`, `attendance_count`, `basic_salary`, `company_allowance`, `monthly_salary`
                , `total_advance`, `emp_epf_contribution`, `total_deduction`, `net_salary`, `employer_epf_contri`
                , `employer_etf_contri`, `total_comp_contri`, `add_user`, `add_date`) 
                VALUES ('$employeeId', '$employeeName', '$month-01', '$attendanceCount', '$basicSalary', '$companyAllowance', '$monthlySalary'
                , '$totalAdvance', '$employeeEpfContri', '$totalDeduction', '$netSalary', '$employerEpfContri', '$employerEtfContri'
                , '$totalContribution', '$addUser', '$addDate')";

            $db = dbConn();
            $db->query($payrollsq2);
        }
    }

    echo json_encode(array('success' => "Form submission Success"));
}
