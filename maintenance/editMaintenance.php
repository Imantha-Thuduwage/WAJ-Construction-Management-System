<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Add New Maintenance</h4>
        <div>
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>maintenance/maintenance.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">
                View Maintenances
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 710px !important;
        }
    </style>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        extract($_GET);

        $sql = "SELECT * FROM tbl_maintenance WHERE maintenance_id='$maintenance_id'";
        $db = dbConn();
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $maintenanceId = $row['maintenance_id'];
        $toolId = $row['tool_id'];
        $machineId = $row['machine_id'];
        $maintainedDate = $row['maintenance_date'];
        $description = $row['special_note'];
    }
    ?>

    <div class="card shadow" method="POST" id="form-card" action="saveEditMaintenance.php">
        <div class="card-body">

            <form method="post" class="form" id="maintenance-form">
                <div class="container field p-0">
                    <div class="row justify-content-center gx-5">
                        <div class="col-sm-6">
                            <h6 class="pt-3 pb-2 mb-0">Enter Your Maintenance Details Here</h6>
                        </div>
                    </div>
                    <input type="hidden" name="paymentId" value="<?php echo $maintenanceId ?>">
                    <div class="row justify-content-center gx-5">
                        <div class="col-sm-6">
                            <div class="input-field">
                                <label for="tool_id" class="mb-1">Tool ID</label>
                                <select class="bg-body" id="toolId" name="toolId">
                                    <option value="" selected disabled hidden>Pick Tool ID</option>

                                    <?php
                                    // Retrieve data from MySQL database
                                    $sql = "SELECT tool_id FROM tbl_tool";
                                    $db = dbConn();
                                    $result = $db->query($sql);

                                    // Display options in dropdown list
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                          // Check if the option value matches the selected value from the database
                                          $selected = ($row['tool_id'] == $toolId) ? 'selected' : '';
                                          echo "<option value='" . $row['tool_id'] . "' " . $selected . ">" . $row['tool_id'] . "</option>";
                                      }
                                  }
                                  ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-sm-6">
                            <div class="input-field">
                                <label for="machine_id" class="mb-1">Machine ID</label>
                                <select class="bg-body" id="machineId" name="machineId">
                                    <option value="" selected disabled hidden>Pick Machine ID</option>

                                    <?php
                                    // Retrieve data from MySQL database
                                    $sql = "SELECT machine_id FROM tbl_machine";
                                    $db = dbConn();
                                    $result = $db->query($sql);

                                    // Display options in dropdown list
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            // Check if the option value matches the selected value from the database
                                          $selected = ($row['machine_id'] == $machineId) ? 'selected' : '';
                                          echo "<option value='" . $row['machine_id'] . "' " . $selected . ">" . $row['machine_id'] . "</option>";
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
                                <label for="maintained_date">Maintained Date</label>
                                <input class="p-3 bg-body" id="maintainedDate" type="text" onfocus="(this.type='date')" 
                                placeholder="Pickup Date" name="maintainedDate" value="<?php echo $maintainedDate ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-6">
                            <div class="input-field">
                                <label for="description">Special Note (Not mandatory)</label>
                                <textarea class="p-3 bg-body" id="description" type="text" 
                                placeholder="Enter Any Special Notes" name="description"><?php echo $description ?></textarea>
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

<script src="<?= SYSTEM_PATH; ?>assets/js/maintenance/addMaintenance.js"></script>

<?php include '../footer.php'; ?>