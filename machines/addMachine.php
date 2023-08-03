<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Add New Machine</h4>
        <div>
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>machines/machine.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">
                View Machine
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 700px !important;
        }
    </style>

    <div class="card shadow" method="POST" id="form-card" action="saveMachine.php" enctype="multipart/form-data">
        <div class="card-body">

            <form method="post" class="form" id="machine-form">
                <div class="container field p-0">
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm-10">
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="machine_name">Machine Name</label>
                                        <input class="p-3 bg-body" id="machineName" type="text" placeholder="Tool Name" name="machineName" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="serial_name">Serial Number</label>
                                        <input class="p-3 bg-body" id="serialNumber" type="text" placeholder="Tool Name" name="serialNumber" value="">
                                        <div class="error-message text-danger" id="error_already"></div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="purchase_date">Purchase Date</label>
                                        <input class="p-3 bg-body" id="purchaseDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="purchaseDate" value="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="status">Condition</label>
                                        <select class="bg-body" id="condition" name="condition">
                                            <option value="" selected disabled hidden>Pick Condition</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT condition_id, condition_name FROM tbl_resource_condition";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['condition_name'] . "'>" . $row['condition_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="fuel_type">Fuel Type</label>
                                        <select class="bg-body" id="fuelType" name="fuelType">
                                            <option value="" selected disabled hidden>Pick Condition</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT fuel_id, fuel_name FROM tbl_fuel_type";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['fuel_name'] . "'>" . $row['fuel_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="brand">Brand</label>
                                        <select class="bg-body" id="brand" name="brand">
                                            <option value="" selected disabled hidden>Pick Your Brand</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT brand_id, brand_name FROM tbl_machine_brand";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['brand_name'] . "'>" . $row['brand_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-field">
                                        <label for="description">Description</label>
                                        <textarea class="p-3 bg-body" id="description" type="text" placeholder="Enter Brief Description" name="description" value=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-6">
                                    <div class="input-field">
                                        <label>Upload Machine Image (Not Mandatory)</label>
                                        <input class="p-3 bg-body" type="file" id="machineImg" name="machineImg">
                                        <div class="error-message text-danger" id="error_machineImg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="nextBtn" type="submit" id="submit">
                        <span class="btnText">Save</span>
                        <i class="uil uil-navigator"></i>
                    </button>
            </form>
        </div>
    </div>
</main>

<script src="<?= SYSTEM_PATH; ?>assets/js/machines/addMachine.js"></script>

<?php include '../footer.php'; ?>