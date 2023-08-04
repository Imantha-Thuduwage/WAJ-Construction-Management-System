<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/view.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Let's See Details</h4>
        <div>
            <button type="button" class="btn btn-sm px-4 bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>payroll/payroll.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">
                View Payroll
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 820px !important;
        }
    </style>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        extract($_GET);

        $sql = "SELECT * FROM tbl_payroll WHERE payroll_id='$payroll_id'";
        $db = dbConn();
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $payrollId = $row['payroll_id'];
        $empId = $row['employee_id'];
        $empName = $row['employee_name'];
        $month = $row['month'];
        $attendanceCount = $row['attendance_count'];
        $basicSal = $row['basic_salary'];
        $comAllowance = $row['company_allowance'];
        $MonthlySal = $row['monthly_salary'];
        $totAdvance = $row['total_advance'];
        $empEpfContri = $row['emp_epf_contribution'];
        $totDeduction = $row['total_deduction'];
        $netSal = $row['net_salary'];
        $employerEpfContri = $row['employer_epf_contri'];
        $employerEtfContri = $row['employer_etf_contri'];
        $totComContribution = $row['total_comp_contri'];
    }

    ?>

    <div class="card shadow" id="form-card">
        <div class="card-body">
            <div class="container">
                <div class="pay-sheet">
                    <!-- Add the output div before the button -->
                    <div id="output">
                        <h2>Pay Sheet</h2>
                        <table class="table table-strips">
                            <tr>
                                <th>Employee ID</th>
                                <td>$employeeId </td>
                            </tr>
                            <tr>
                                <th>Employee Name</th>
                                <td> $empName </td>
                            </tr>
                            <tr>
                                <th>Month</th>
                                <td> $month </td>
                            </tr>
                            <tr>
                                <th>Attendance Count</th>
                                <td> $attendanceCount </td>
                            </tr>
                            <tr>
                                <th>Basic Salary</th>
                                <td> $basicSal </td>
                            </tr>
                            <tr>
                                <th>Company Allowance</th>
                                <td> $comAllowance </td>
                            </tr>
                            <tr>
                                <th>Monthly Salary</th>
                                <td> $monthlySalary </td>
                            </tr>
                            <tr>
                                <th rowspan="3">Deduction</th>
                            </tr>

                            <tr>
                                <th>Total Advance</th>
                                <td> $totAdvance </td>
                            </tr>
                            <tr>
                                <th>E.P.F (8%)</th>
                                <td> $empEpfContri </td>
                            </tr>
                            <tr>
                                <th>Total Deduction</th>
                                <td> $totDeduction </td>
                            </tr>
                            <tr>
                                <th>Net Salary</th>
                                <td> $netSal </td>
                            </tr>
                            <tr>
                                <th rowspan="3">Company Contributions</th>
                            </tr>
                            <tr>
                                <th>E.P.F (12%)</th>
                                <td> $employerEpfContri </td>
                            </tr>
                            <tr>
                                <th>E.T.F (3%)</th>
                                <td> $employerEtfContri </td>
                            </tr>
                            <tr>
                                <th>Total Company Contribution</th>
                                <td> $$totComContribution </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>

            <button type="button" class="nextBtn" onclick="printSlip('output')">
                <span class="btnText">Download</span>
            </button>
        </div>
    </div>
</main>

<?php include '../footer.php'; ?>

<!-- Function for print paysheet as PDF -->
<script>
    function printSlip(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>