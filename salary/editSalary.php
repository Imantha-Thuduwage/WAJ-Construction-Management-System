<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Update With New Details</h4>
        <div>
            <!-- Link to add project form -->
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>salary/salary.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">
                View Salary
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 630px !important;
        }
    </style>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        extract($_GET);

        $sql = "SELECT * FROM tbl_salary WHERE salary_id='$salary_id'";
        $db = dbConn();
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $salaryId = $row['salary_id'];
        $employeeId = $row['employee_id'];
        $basicSal = $row['basic_salary'];
        $companyAllowance = $row['company_allowance'];
    }
    ?>

    <div class="card shadow" method="POST" id="form-card" action="saveEditSalary.php">
        <div class="card-body">

            <form method="post" class="form" id="salary-form">
                <div class="container field p-0">
                    <div class="row justify-content-center gx-5">
                        <div class="col-sm-6">
                            <h6 class="pt-3 pb-2 mb-0">Enter Your Salary Details Here</h6>
                        </div>
                    </div>
                    <input type="hidden" name="salaryId" value="<?php echo $salary_id ?>">
                    <div class="row justify-content-center gx-5">
                        <div class="col-sm-6">
                            <div class="input-field">
                                <label for="employee_id" class="mb-1">Employee ID</label>
                                <select class="bg-body" id="employeeId" name="employeeId">
                                    <option value="" selected disabled hidden>Pick Employee ID</option>

                                    <?php
                                    // Retrieve data from MySQL database
                                    $sql = "SELECT employee_id FROM tbl_employee";
                                    $db = dbConn();
                                    $result = $db->query($sql);

                                    // Display options in dropdown list
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            // Check if the option value matches the selected value from the database
                                            $selected = ($row['employee_id'] == $employeeId) ? 'selected' : '';
                                            echo "<option value='" . $row['employee_id'] . "' " . $selected . ">" . $row['employee_id'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="error-message text-danger" id="error_already"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-6">
                            <div class="input-field">
                                <label for="basic_amount">Basic Salary</label>
                                <input class="p-3 bg-body" id="basicSal" type="number" placeholder="Basic Salary" name="basicSal" value="<?php echo $basicSal ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-6">
                            <div class="input-field">
                                <label for="company_allowance">Company Allowance</label>
                                <input class="p-3 bg-body" id="companyAllowance" type="number" placeholder="Company Allowance" name="companyAllowance" value="<?php echo $companyAllowance ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-6">
                            <button class="nextBtn" type="submit" id="submit">
                                <span class="btnText">Save</span>
                                <i class="uil uil-navigator"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="<?= SYSTEM_PATH; ?>assets/js/salary/editSalary.js"></script>

<?php include '../footer.php'; ?>