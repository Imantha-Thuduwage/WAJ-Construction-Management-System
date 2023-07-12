<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Update With New Details</h4>
        <div>
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>advance/advance.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">
                View Advance
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 600px !important;
        }
    </style>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        extract($_GET);

        $sql = "SELECT * FROM tbl_advance WHERE advance_id='$advance_id'";
        $db = dbConn();
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $advanceId = $row['advance_id'];
        $empId = $row['employee_id'];
        $payedDate = $row['given_date'];
        $payedAmount = $row['advance_amount'];
        $description = $row['special_note'];
    }
    ?>

    <div class="card shadow" method="POST" id="form-card" action="saveEditAdvance.php">
        <div class="card-body">
            <form method="post" class="form" id="advance-form">
                <div class="container field p-0">
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm-6">
                            <h6 class="pt-3 pb-2 mb-0">Enter Your Advance Details Here</h6>
                        </div>
                    </div>
                    <input type="hidden" name="advanceId" value="<?php echo $advance_id ?>">
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <div class="row row-cols-2 row-cols-lg-1 g-2 g-lg-3">
                                <div class="col-sm">
                                    <div class="input-field">
                                        <label for="pro_id" class="mb-1">Employee ID</label>
                                        <select class="bg-body" id="empId" name="empId">
                                            <option value="">Pick Employee ID</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT employee_id FROM tbl_employee";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    // Check if the option value matches the selected value from the database
                                                    $selected = ($row['employee_id'] == $empId) ? 'selected' : '';
                                                    echo "<option value='" . $row['employee_id'] . "' " . $selected . ">" . $row['employee_id'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-field">
                                        <label for="payed_amount">Payed Amount</label>
                                        <input class="p-3 bg-body" id="payedAmount" type="number" placeholder="Payed Amount" name="payedAmount" value="<?php echo $payedAmount ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="payed_date">Payed Date</label>
                                        <input class="p-3 bg-body" id="payedDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="payedDate" value="<?php echo $payedDate ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-6">
                            <div class="input-field">
                                <label for="description">Special Note (Not mandatory)</label>
                                <textarea class="p-3 bg-body" id="description" type="text" placeholder="Enter Brief Description" name="description"><?php echo $description ?></textarea>
                            </div>
                        </div>
                    </div>
                    <button class="nextBtn" type="submit" id="submit">
                        <span class="btnText">Save</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
</main>

<script src="<?= SYSTEM_PATH; ?>assets/js/advance/editAdvance.js"></script>

<?php include '../footer.php'; ?>