<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Update With New Details</h4>
        <div>
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>pettyCash/pettyCash.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">
                View PettyCash
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 700px !important;
        }
    </style>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        extract($_GET);

        $sql = "SELECT * FROM tbl_petty_cash WHERE petty_id='$petty_id'";
        $db = dbConn();
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $pettyId = $row['petty_id'];
        $proId = $row['project_id'];
        $payedAmount = $row['payed_amount'];
        $payedDate = $row['payed_date'];
        $description = $row['special_note'];
    }
    ?>

    <div class="card shadow" method="POST" id="form-card" action="saveEditPettyCash.php">
        <div class="card-body">
            <form method="post" class="form" id="pettyCash-form">
                <div class="container field p-0">
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm-6">
                            <h6 class="pt-3 pb-2 mb-0">Enter Your Payment Details Here</h6>
                        </div>
                    </div>
                    <input type="hidden" name="pettyId" value="<?php echo $petty_id ?>">
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <div class="row row-cols-2 row-cols-lg-1 g-2 g-lg-3">
                                <div class="col-sm">
                                    <div class="input-field">
                                        <label for="pro_id" class="mb-1">Project ID</label>
                                        <select class="bg-body" id="proId" name="proId">
                                            <option value="">Pick Project ID</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT project_id FROM tbl_project";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    // Check if the option value matches the selected value from the database
                                                    $selected = ($row['project_id'] == $proId) ? 'selected' : '';
                                                    echo "<option value='" . $row['project_id'] . "' " . $selected . ">" . $row['project_id'] . "</option>";
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

<script src="<?= SYSTEM_PATH; ?>assets/js/pettyCash/editPettyCash.js"></script>

<?php include '../footer.php'; ?>