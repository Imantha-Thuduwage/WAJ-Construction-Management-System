<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/form.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Add New Project</h4>
        <div>
            <button type="button" class="btn btn-sm px-4 bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>projects/project.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">
                View Projects
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 820px !important;
        }
    </style>

    <div class="card shadow" id="form-card">
        <div class="card-body">

            <form method="post" class="form" id="project-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="container field p-0">
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <h6 class="pt-3 pb-2 mb-0">Basic Details</h6>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-4 ">
                                    <div class="input-field">
                                        <label for="project_name">Project Name</label>
                                        <input class="p-3 bg-body" id="pName" type="text" placeholder="Enter Project Name" name="pName" value="">
                                        <div class="error-message text-danger" id="error_already"></div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="project_location">Location</label>
                                        <input class="p-3 bg-body" id="pLocation" type="text" placeholder="Enter Project Location" name="pLocation" value="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="start_date">Start Date</label>
                                        <input class="p-3 bg-body" id="startDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="startDate" value="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="end_date">End Date</label>
                                        <input class="p-3 bg-body" id="endDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="endDate" value="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="project_manager">Project Manager</label>
                                        <select class="bg-body" id="proManager" name="proManager">
                                            <option value="" selected disabled hidden>Select Project Manager</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT u.`user_id`,u.`last_name`,r.`role_id`,r.`user_role` 
                                            FROM tbl_user AS u INNER JOIN tbl_user_role AS r ON u.`role_id` = r.`role_id` WHERE `user_role` = 'Project_Manager'";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['user_id'] . "'>" . $row['last_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="total_cost">Total Cost</label>
                                        <input class="p-3 bg-body" id="pCost" type="Number" placeholder="Total Cost" name="pCost" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <h6 class="py-2 mb-0">ABC Details</h6>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-4">
                                    <div class="input-field">
                                        <label>Is ABC include in this?</label>
                                        <select class="bg-body " id="abcStatus" name="abcStatus" onchange="enableAbcDetails(this)">
                                            <option value="">Pick an Option</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="abc-details-1" class="input-field d-none">
                                        <label>ABC Unit</label>
                                        <select class="bg-body" id="abcUnit" name="abcUnit">
                                            <option value="">Pick an Unit</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT unit_id,unit_short_name FROM tbl_measurement_unit";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {

                                                    // Step 4: Check if the option value matches the selected value from the database
                                                    $selected = ($row['unit_id'] == $selectedValue) ? 'selected' : '';

                                                    echo "<option value='" . $row['unit_id'] . "'" . $selected . ">" . $row['unit_short_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 ">
                                    <div id="abc-details-2" class="input-field d-none">
                                        <label>ABC Quantity</label>
                                        <input class="p-3 bg-body" id="abcQuantity" type="number" placeholder="Enter Quantity" name="abcQuantity" value="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="abc-details-3" class="input-field d-none">
                                        <label>ABC Rate (Rs.)</label>
                                        <input class="p-3 bg-body" id="abcRate" type="Number" placeholder="Rate for One Unit" name="abcRate" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <h6 class="py-2 mb-0">Prime Coat Details</h6>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-4">
                                    <div class="input-field">
                                        <label>Is Prime Coat include in Project?</label>
                                        <select class="bg-body" id="primeStatus" name="primeStatus" onchange="enablePrimeDetails(this)">
                                            <option value="">Pick an Option</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="prime-coat-details-1" class="input-field d-none">
                                        <label>Prime Coat Unit</label>
                                        <select class="bg-body" id="primeUnit" name="primeUnit">
                                            <option value="">Pick an Unit</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT unit_id,unit_short_name FROM tbl_measurement_unit";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['unit_id'] . "'>" . $row['unit_short_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 ">
                                    <div id="prime-coat-details-2" class="input-field d-none">
                                        <label>Prime Coat Quantity</label>
                                        <input class="p-3 bg-body" id="primeQuantity" type="number" placeholder="Enter Quantity" name="primeQuantity" value="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="prime-coat-details-3" class="input-field d-none">
                                        <label>Prime Coat Rate (Rs.)</label>
                                        <input class="p-3 bg-body" id="primeRate" type="Number" placeholder="Rate for One Unit" name="primeRate" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <h6 class="py-2 mb-0">Tack Coat Details</h6>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="tackStatus">Is Tack Coat include in Project?</label>
                                        <select class="bg-body" id="tackStatus" name="tackStatus" onchange="enableTackDetails(this)">
                                            <option value="">Pick an Option</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="tack-coat-details-1" class="input-field d-none">
                                        <label>Tack Coat Unit</label>
                                        <select class="bg-body" id="tackUnit" name="tackUnit">
                                            <option value="">Pick an Unit</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT unit_id,unit_short_name FROM tbl_measurement_unit";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['unit_id'] . "'>" . $row['unit_short_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 ">
                                    <div id="tack-coat-details-2" class="input-field d-none">
                                        <label>Tack Coat Quantity</label>
                                        <input class="p-3 bg-body " id="tackQuantity" type="number" placeholder="Enter Quantity" name="tackQuantity" value="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="tack-coat-details-3" class="input-field d-none">
                                        <label>Tack Coat Rate (Rs.)</label>
                                        <input class="p-3 bg-body " id="tackRate" type="Number" placeholder="Rate for One Unit" name="tackRate" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <h6 class="py-2 mb-0">Asphalt Details</h6>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-4">
                                    <div class="input-field">
                                        <label>Is Asphalt Laying include in Project?</label>
                                        <select class="bg-body " id="asphaltStatus" name="asphaltStatus" onchange="enableAsphaltDetails(this)">
                                            <option value="">Pick an Option</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="asphalt-details-1" class="input-field d-none">
                                        <label>Asphalt Thickness (mm)</label>
                                        <input class="p-3 bg-body " id="asphaltThicknes" type="number" placeholder="Enter Thickness" name="asphaltThicknes" value="">
                                    </div>
                                </div>
                                <div class="col-4 ">
                                    <div id="asphalt-details-2" class="input-field d-none">
                                        <label>Asphalt Unit</label>
                                        <select class="bg-body" id="asphaltUnit" name="asphaltUnit">
                                            <option value="">Pick an Unit</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT unit_id,unit_short_name FROM tbl_measurement_unit";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['unit_id'] . "'>" . $row['unit_short_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="asphalt-details-3" class="input-field d-none">
                                        <label>Asphalt Quantity (Rs.)</label>
                                        <input class="p-3 bg-body " id="asphaltQuantity" type="Number" placeholder="Enter Quantity" name="asphaltQuantity" value="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="asphalt-details-4" class="input-field d-none">
                                        <label>Asphalt Rate (Rs.)</label>
                                        <input class="p-3 bg-body " id="asphaltRate" type="Number" placeholder="Rate for One Unit" name="asphaltRate" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <h6 class="py-2 mb-0">Other Details</h6>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-4">
                                    <div class="input-field">
                                        <label>Marking the roads?</label>
                                        <select class="bg-body " id="markingStatus" name="markingStatus">
                                            <option value="">Pick an Option</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label>How Many Bridges in Road?</label>
                                        <input class="p-3 bg-body" id="bridges" type="Number" placeholder="Enter Total Bridges" name="bridges" value="">
                                    </div>
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

<script src="<?= SYSTEM_PATH; ?>assets/js/projects/project.js"></script>

<?php include '../footer.php'; ?>