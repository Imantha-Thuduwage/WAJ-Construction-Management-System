<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Update Employee</h4>
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

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        extract($_GET);

        $sql = "SELECT * FROM tbl_machine WHERE machine_id='$machine_id'";
        $db = dbConn();
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $machineId = $row['machine_id'];
        $machineName = $row['machine_name'];
        $serialNumber = $row['serial_number'];
        $purchaseDate = $row['purchase_date'];
        $condition = $row['condition'];
        $fuelType = $row['fuel_type'];
        $brand = $row['brand'];
        $description = $row['description'];
        $machineImg = $row['machine_image'];
    }
    ?>

    <div class="card shadow" method="POST" id="form-card" action="saveEditMachine.php" enctype="multipart/form-data">
        <div class="card-body">
            <form method="post" class="form" id="machine-form">
                <div class="container field p-0">
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm-6">
                            <h6 class="pt-3 pb-2 mb-0">Enter Your Tool Details Here</h6>
                        </div>
                    </div>
                    <input type="hidden" name="machineId" value="<?php echo $machineId ?>">
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <div class="row row-cols-2 row-cols-lg-1 g-2 g-lg-3">
                                <div class="col-sm">
                                    <div class="input-field">
                                        <label for="machine_name">Machine Name</label>
                                        <input class="p-3 bg-body" id="machineName" type="text" placeholder="Tool Name" name="machineName" value="<?php echo $machineName ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-field">
                                        <label for="serial_name">Serial Number</label>
                                        <input class="p-3 bg-body" id="serialNumber" type="text" placeholder="Tool Name" name="serialNumber" value="<?php echo $serialNumber ?>">
                                        <div class="error-message text-danger" id="error_already"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-field">
                                        <label for="purchase_date">Purchase Date</label>
                                        <input class="p-3 bg-body" id="purchaseDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="purchaseDate" value="<?php echo $purchaseDate ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="condition">Condition</label>
                                        <select class="bg-body" id="condition" name="condition">
                                            <option value="">Pick Status</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT condition_name FROM tbl_resource_condition";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    // Check if the option value matches the selected value from the database
                                                    $selected = ($row['condition_name'] == $condition) ? 'selected' : '';
                                                    echo "<option value='" . $row['condition_name'] . "' " . $selected . ">" . $row['condition_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
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
                                                    // Check if the option value matches the selected value from the database
                                                    $selected = ($row['fuel_name'] == $fuelType) ? 'selected' : '';
                                                    echo "<option value='" . $row['fuel_name'] . "' " . $selected . ">" . $row['fuel_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card id-section d-flex align-items-start border-0 mb-3">
                                <div class="card-body mb-2 p-2" style="display: flex; justify-content: center; align-items: center;">
                                    <img class="img-fluid" src="<?= SYSTEM_PATH; ?>assets/images/machineImages/<?= !empty($machineImg) ? $machineImg : 'no-image.png' ?>" style="height: 250px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
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
                                            // Check if the option value matches the selected value from the database
                                            $selected = ($row['brand_name'] == $brand) ? 'selected' : '';
                                            echo "<option value='" . $row['brand_name'] . "' " . $selected . ">" . $row['brand_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-field">
                                <label>Upload Machine Image (Not Mandatory)</label>
                                <input class="p-3 bg-body" type="file" id="machineImg" name="machineImg">
                                <div class="error-message text-danger" id="error_machineImg"></div>
                                <!-- Set prvious image value to save DB when user is not update new image -->
                                <input type="hidden" name="sameMachineImg" value="<?php echo @$machineImg; ?>">
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="col-sm">
                                <div class="input-field">
                                    <label for="description">Description</label>
                                    <textarea class="p-3 bg-body" id="description" type="text" placeholder="Enter Brief Description" name="description"><?php echo $description ?></textarea>
                                </div>
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
</main>

<script src="<?= SYSTEM_PATH; ?>assets/js/machines/editMachine.js"></script>

<?php include '../footer.php'; ?>