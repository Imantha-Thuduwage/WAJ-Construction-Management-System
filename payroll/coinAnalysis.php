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
        $netSal = $row['net_salary'];
    }

    $sql2 = "SELECT
    employee_id, employee_name, `month`, net_salary
    FROM tbl_payroll
    WHERE payroll_id = '$payroll_id';";
    $db = dbConn();
    $db->query($sql2);

    //  Coin analysis calculation logic here
    $notes_5000 = floor($netSal / 5000);
    $notes_1000 = floor(($netSal % 5000) / 1000);
    $notes_500 = floor((($netSal % 5000) % 1000) / 500);
    $notes_100 = floor(((($netSal % 5000) % 1000) % 500) / 100);
    $notes_50 = floor((((($netSal % 5000) % 1000) % 500) % 100) / 50);
    $notes_20 = floor(((((($netSal % 5000) % 1000) % 500) % 100) % 50) / 20);
    $coins_10 = floor((((((($netSal % 5000) % 1000) % 500) % 100) % 50) % 20) / 10);
    $coins_5 = floor(((((((($netSal % 5000) % 1000) % 500) % 100) % 50) % 20) % 10) / 5);
    $coins_2 = floor((((((((($netSal % 5000) % 1000) % 500) % 100) % 50) % 20) % 10) % 5) / 2);
    $coins_1 = (((((((($netSal % 5000) % 1000) % 500) % 100) % 50) % 20) % 10) % 5) % 2;
    ?>

    ?>

    <div class="card shadow" id="form-card">
        <div class="card-body">
            <div class="container">
                <div class="pay-sheet">
                    <h2>Pay Sheet</h2>
                    <table class="table table-strips">
                        <tr>
                            <th>Employee ID</th>
                            <td><?php echo $empId; ?></td>
                        </tr>
                        <tr>
                            <th>Net Salary</th>
                            <td><?php echo $netSal; ?></td>
                        </tr>
                        <tr>
                            <th>5000 Notes</th>
                            <td><?php echo $notes_5000; ?></td>
                        </tr>
                        <tr>
                            <th>1000 Notes</th>
                            <td><?php echo $notes_1000; ?></td>
                        </tr>
                        <tr>
                            <th>500 Notes</th>
                            <td><?php echo $notes_500; ?></td>
                        </tr>
                        <tr>
                            <th>100 Notes</th>
                            <td><?php echo $notes_100; ?></td>
                        </tr>
                        <tr>
                            <th>50 Notes</th>
                            <td><?php echo $notes_50; ?></td>
                        </tr>
                        <tr>
                            <th>20 Notes</th>
                            <td><?php echo $notes_20; ?></td>
                        </tr>
                        <tr>
                            <th>10 Coins</th>
                            <td><?php echo $coins_10; ?></td>
                        </tr>
                        <tr>
                            <th>5 Coins</th>
                            <td><?php echo $coins_5; ?></td>
                        </tr>
                        <tr>
                            <th>2 Coins</th>
                            <td><?php echo $coins_2; ?></td>
                        </tr>
                        <tr>
                            <th>1 Coins</th>
                            <td><?php echo $coins_1; ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Add the output div before the button -->
            <div id="output" style="display: none;"></div>

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