<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Edit Payment</h4>
        <div>
            <button type="button" class="btn btn-sm px-5-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>payments/payment.php'">
                View Payments
            </button>
            <button type="button" class="btn btn-sm px-5 border-bottom border-end border-2">
                Filters
            </button>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        extract($_GET);

        $sql = "SELECT * FROM tbl_payment WHERE payment_id='$payment_id'";
        $db = dbConn();
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $paymentId = $row['payment_id'];
        $proId = $row['project_id'];
        $payedAmount = $row['payed_amount'];
        $payedDate = $row['payed_date'];
        $payedMethod = $row['payed_method'];
        $description = $row['special_note'];
        $payedSlip = $row['payed_slip'];
    }
    echo $payedSlip;
    ?>

    <div class="card shadow" method="POST" id="form-card" action="saveEditPayment.php" enctype="multipart/form-data">
        <div class="card-body">

            <form method="post" class="form" id="payment-form">
                <div class="container field p-0">
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm-6">
                            <h6 class="pt-3 pb-2 mb-0">Enter Your Payment Details Here</h6>
                        </div>
                    </div>
                    <input type="hidden" name="paymentId" value="<?php echo $payment_id ?>">
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
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="payed_method">Payed Method</label>
                                        <select class="bg-body " id="payedMethod" name="payedMethod">
                                            <option value="" selected disabled hidden>Pick an Option</option>
                                            <option value="Bank Transfer" <?php if ($payedMethod == 'Bank Transfer') echo "selected"; ?>>Bank Transfer</option>
                                            <option value="Online Transfer" <?php if ($payedMethod == 'Online Transfer') echo "selected"; ?>>Online Transfer</option>
                                            <option value="By Check" <?php if ($payedMethod == 'By Check') echo "selected"; ?>>By Check</option>
                                            <option value="By Cash" <?php if ($payedMethod == 'By Cash') echo "selected"; ?>>By Cash</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card id-section d-flex align-items-start border-0 mb-3">
                                <div class="card-body mb-2 p-2" style="display: flex; justify-content: center; align-items: center;">
                                    <img class="img-fluid" src="<?= SYSTEM_PATH; ?>assets/images/payedSlips/<?= !empty($payedSlip) ? $payedSlip : 'no-image.png' ?>" style="height: 250px;">
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
                        <div class="col-6">
                            <div class="input-field">
                                <label for="formFile">Upload Payed Slip (Not mandatory for only Cash Payment)</label>
                                <input class="p-3 bg-body" type="file" id="payedSlip" name="payedSlip">
                                <!-- Set prvious image value to save DB when user is not update new image -->
                                <input type="hidden" name="sameSlipImg" value="<?php echo @$payedSlip; ?>">
                            </div>
                        </div>
                    </div>
                    <button class="nextBtn" type="submit" id="submit">
                        <span class="btnText">Save</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div>
        </div>
        </form>
    </div>
    </div>
</main>

<script src="<?= SYSTEM_PATH; ?>assets/js/payments/editPayment.js"></script>

<?php include '../footer.php'; ?>