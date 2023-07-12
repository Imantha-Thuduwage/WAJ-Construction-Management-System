<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Add New Petty Cash</h4>
        <div>
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>pettyCash/pettyCash.php'">
            <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">    
            View PettyCash
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 650px !important;
        }
    </style>

    <div class="card shadow" method="POST" id="form-card" action="savePettyCash.php">
        <div class="card-body">

            <form method="post" class="form" id="pettyCash-form">
                <div class="container field p-0">
                    <div class="row justify-content-center gx-5">
                        <div class="col-sm-6">
                            <h6 class="pt-3 pb-2 mb-0">Enter Your Payment Details Here</h6>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-sm-6">
                            <div class="input-field">
                                <label for="pro_id" class="mb-1">Project ID</label>
                                <select class="bg-body" id="proId" name="proId">
                                    <option value="" selected disabled hidden>Pick Project ID</option>

                                    <?php
                                    // Retrieve data from MySQL database
                                    $sql = "SELECT project_id FROM tbl_project";
                                    $db = dbConn();
                                    $result = $db->query($sql);

                                    // Display options in dropdown list
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['project_id'] . "'>" . $row['project_id'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">

                        <div class="col-6">
                            <div class="input-field">
                                <label for="payed_amount">Payed Amount</label>
                                <input class="p-3 bg-body" id="payedAmount" type="number" placeholder="Payed Amount" name="payedAmount" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-6">
                            <div class="input-field">
                                <label for="payed_date">Payed Date</label>
                                <input class="p-3 bg-body" id="payedDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="payedDate" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-6">
                            <div class="input-field">
                                <label for="description">Special Note (Not mandatory)</label>
                                <textarea class="p-3 bg-body" id="description" type="text" placeholder="Enter Brief Description" name="description" value=""></textarea>
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

<script src="<?= SYSTEM_PATH; ?>assets/js/pettyCash/addPettyCash.js"></script>

<?php include '../footer.php'; ?>