<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/form.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Add New Project</h4>
        <div>
            <button type="button" class="btn btn-sm px-5 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>projects/project.php'">
                View Projects
            </button>
            <button type="button" class="btn btn-sm px-5 border-bottom border-end border-2">
                Filters
            </button>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        extract($_GET);

        echo $sql = "SELECT * FROM tbl_project WHERE project_id='$project_id'";
        $db = dbConn();
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $pId = $row['project_id'];
        $pName = $row['project_name'];
        $pLocation = $row['p_location'];
        $startDate = $row['start_date'];
        $endDate = $row['end_date'];
        $proManager = $row['project_manager'];
        $abcStatus = $row['abc_status'];
        $abcUnit = $row['abc_unit'];
        $abcQuantity = $row['abc_quantity'];
        $abcRate = $row['abc_rate'];
        $primeStatus = $row['prime_status'];
        $primeUnit = $row['prime_unit'];
        $primeQuantity = $row['prime_quantity'];
        $primeRate = $row['prime_rate'];
        $tackUnit = $row['tack_unit'];
        $tackQuantity = $row['tack_quantity'];
        $tackStatus = $row['tack_status'];
        $tackRate = $row['tack_rate'];
        $asphaltStatus = $row['asphalt_status'];
        $asphaltThicknes = $row['asphalt_thickness'];
        $asphaltUnit = $row['asphalt_unit'];
        $asphaltQuantity = $row['asphalt_quantity'];
        $asphaltRate = $row['asphalt_rate'];
        $markingStatus = $row['marking_status'];
        $bridges = $row['bridges_count'];
        $pCost = $row['total_cost'];
    }

    // Cheking Submit button is clicked
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //     // This function uses array keys as variable names and values as variable values
    //     extract($_POST);

    //     // create array
    //     $message = array();

    //     // Reuired Fields Validation
    //     if (empty($pName)) {
    //         $message['error_pName'] = "Please Enter Project Name";
    //     }
    //     if (empty($pLocation)) {
    //         $message['error_pLocation'] = "Please Enter Location";
    //     }
    //     if ($abcStatus == "Pick an Option") {
    //         $message['error_abc'] = "Please Select Value";
    //     }
    //     if ($primeStatus == "Pick an Option") {
    //         $message['error_primeCoat'] = "Please Select Value";
    //     }
    //     if ($tackStatus == "Pick an Option") {
    //         $message['error_tackCoat'] = "Please Select Value";
    //     }
    //     if ($asphaltStatus == "Pick an Option") {
    //         $message['error_asphalt'] = "Please Select Value";
    //     }
    //     if ($markingStatus == "Pick an Option") {
    //         $message['error_marking'] = "Please Select Value";
    //     }
    //     if (empty($bridges)) {
    //         $message['error_bridges'] = "Please Enter Bridge Count";
    //     }
    //     if (empty($pCost)) {
    //         $message['error_pCost'] = "Please Enter Total Cost";
    //     }

    //     // Adavanced Validation
    //     if (!empty($pName)) {
    //         $sql = "SELECT * FROM tbl_project WHERE project_name = '$pName'";
    //         $db = dbConn();
    //         $result = $db->query($sql);

    //         if ($result->num_rows > 0) {
    //             $message['error_pName'] = "The Project Name is Already Exist!";
    //         }
    //     }
    //     // Check Validation is Completed
    //     if (empty($message)) {
    //         // Retrieving values for fields that are not in the form
    //         $addUser = $_SESSION['userid'];
    //         $addDate = date('y-m-d');


    //         $sql = "UPDATE tbl_products SET ProductName='$pName', ProductQty='$pQty', ProductPrice='$pPrice', ProductDescription='$pDescription',ProductImage='$file_name_new', ProductStatus='$pStatus', UpdateDate='$UpdateDate', UpdateUser='$UpdateUser' WHERE ProductId='$ProductId'";
    //         $db = dbConn();
    //         $db->query($sql);

    //         $sql = "DELETE FROM tbl_product_sizes WHERE ProductId='$ProductId'";
    //         $db->query($sql);
    //         // Calling to DB Connection
    //         $sql = "UPDATE tbl_project SET 
    //         project_name = '$pName',p_location = '$pLocation',abc_status = '$abcStatus',abc_unit = '$abcUnit',abc_quantity = '$abcQuantity',
    //         abc_rate = '$abcRate',prime_status = '$primeStatus',prime_unit = '$primeUnit',prime_quantity = '$primeQuantity',prime_rate = '$primeRate',
    //         tack_status = '$tackStatus',tack_unit = '$tackUnit',tack_quantity = '$tackQuantity',
    //         tack_rate = '$tackRate',asphalt_status = '$asphaltStatus',asphalt_thickness  = '$asphaltThicknes',
    //         asphalt_unit = '$asphaltUnit',asphalt_quantity ='$asphaltQuantity',asphalt_rate ='$asphaltRate',
    //         concrete_status = '$concreteStatus',concrete_unit = '$concreteUnit',concrete_quantity = '$concreteQuantity',
    //         concrete_rate ='$concreteRate',
    //         marking_status= '$markingStatus',bridges ='$bridges',total_cost = '$pCost',
    //         update_user = '$addUser',update_date = '$addDate' WHERE project_id = '$pId'";
    //         $db = dbConn();
    //         $db->query($sql);
    //         showMessage();
    //     }
    // }

    ?>
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
                                        <label for="project_name">Project ID</label>
                                        <input class="p-3 bg-body" type="num" name="pId" value="<?php echo @$pId; ?>">
                                        <label class="text-danger hh"><?php echo @$message['error_pId']; ?></label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="project_name">Project Name</label>
                                        <input class="p-3 bg-body" type="text" placeholder="Enter Project Name" name="pName" value="<?php echo @$pName; ?>">
                                        <label class="text-danger hh"><?php echo @$message['error_pName']; ?></label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="project_location">Location</label>
                                        <input class="p-3 bg-body" type="text" placeholder="Enter Project Location" name="pLocation" value="<?php echo @$pLocation; ?>">
                                        <label class="text-danger"><?php echo @$message['error_pLocation']; ?></label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="start_date">Start Date</label>
                                        <input class="p-3 bg-body" id="startDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="startDate" value="<?php echo @$startDate; ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="end_date">End Date</label>
                                        <input class="p-3 bg-body" id="endDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="endDate" value="<?php echo @$endDate; ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="project_manager">Project Manager</label>
                                        <select class="bg-body" id="proManager" name="proManager">
                                            <option value="" disabled hidden>Select Project Manager</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT u.`user_id`,u.`full_name`,r.`role_id`,r.`user_role` 
                                            FROM tbl_user AS u INNER JOIN tbl_user_role AS r ON u.`role_id` = r.`role_id` WHERE `user_role` = 'Project_Manager'";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $selected = ($row['user_id'] == $proManager) ? 'selected' : '';
                                                    echo "<option value='" . $row['user_id'] . "' " . $selected . ">" . $row['full_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="total_cost">Total Cost</label>
                                        <input class="p-3 bg-body" id="pCost" type="Number" placeholder="Total Cost" name="pCost" value="<?php echo @$pCost; ?>">
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
                                        <select class="bg-body " id="abcStatus" name="abcStatus">
                                            <option value="" disabled>Pick an Option</option>
                                            <option value="1" <?php if ($abcStatus == '1') echo "selected"; ?>>Yes</option>
                                            <option value="2" <?php if ($abcStatus == '2') echo "selected"; ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="abc-details-1" class="input-field">
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
                                                    // Check if the option value matches the selected value from the database
                                                    $selected = ($row['unit_id'] == $abcUnit) ? 'selected' : '';
                                                    echo "<option value='" . $row['unit_id'] . "' " . $selected . ">" . $row['unit_short_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 ">
                                    <div id="abc-details-2" class="input-field">
                                        <label>ABC Quantity</label>
                                        <input class="p-3 bg-body" id="abcQuantity" type="number" placeholder="Enter Quantity" name="abcQuantity" value="<?php echo $abcQuantity; ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="abc-details-3" class="input-field">
                                        <label>ABC Rate (Rs.)</label>
                                        <input class="p-3 bg-body" id="abcRate" type="Number" placeholder="Rate for One Unit" name="abcRate" value="<?php echo $abcRate; ?>">
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
                                        <select class="bg-body" id="primeStatus" name="primeStatus">
                                            <option value="" disabled>Pick an Option</option>
                                            <option value="1" <?php if ($primeStatus == '1') echo "selected"; ?>>Yes</option>
                                            <option value="2" <?php if ($primeStatus == '2') echo "selected"; ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="prime-coat-details-1" class="input-field">
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
                                                    // Check if the option value matches the selected value from the database
                                                    $selected = ($row['unit_id'] == $primeUnit) ? 'selected' : '';
                                                    echo "<option value='" . $row['unit_id'] . "' " . $selected . ">" . $row['unit_short_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 ">
                                    <div id="prime-coat-details-2" class="input-field">
                                        <label>Prime Coat Quantity</label>
                                        <input class="p-3 bg-body" id="primeQuantity" type="number" placeholder="Enter Quantity" name="primeQuantity" value="<?php echo $primeQuantity ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="prime-coat-details-3" class="input-field">
                                        <label>Prime Coat Rate (Rs.)</label>
                                        <input class="p-3 bg-body" id="primeRate" type="Number" placeholder="Rate for One Unit" name="primeRate" value="<?php echo $primeRate ?>">
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
                                        <select class="bg-body" id="tackStatus" name="tackStatus">
                                            <option value="">Pick an Option</option>
                                            <option value="1" <?php if ($tackStatus == '1') echo "selected"; ?>>Yes</option>
                                            <option value="2" <?php if ($tackStatus == '2') echo "selected"; ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="tack-coat-details-1" class="input-field">
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
                                                    // Check if the option value matches the selected value from the database
                                                    $selected = ($row['unit_id'] == $tackUnit) ? 'selected' : '';
                                                    echo "<option value='" . $row['unit_id'] . "' " . $selected . ">" . $row['unit_short_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 ">
                                    <div id="tack-coat-details-2" class="input-field">
                                        <label>Tack Coat Quantity</label>
                                        <input class="p-3 bg-body " id="tackQuantity" type="number" placeholder="Enter Quantity" name="tackQuantity" value="<?php echo $tackQuantity ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="tack-coat-details-3" class="input-field">
                                        <label>Tack Coat Rate (Rs.)</label>
                                        <input class="p-3 bg-body " id="tackRate" type="Number" placeholder="Rate for One Unit" name="tackRate" value="<?php echo $tackRate ?>">
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
                                        <select class="bg-body " id="asphaltStatus" name="asphaltStatus">
                                            <option value="">Pick an Option</option>
                                            <option value="1" <?php if ($asphaltStatus == '1') echo "selected"; ?>>Yes</option>
                                            <option value="2" <?php if ($asphaltStatus == '2') echo "selected"; ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="asphalt-details-1" class="input-field">
                                        <label>Asphalt Thickness (mm)</label>
                                        <input class="p-3 bg-body " id="asphaltThicknes" type="number" placeholder="Enter Thickness" name="asphaltThicknes" value="<?php echo $asphaltThicknes ?>">
                                    </div>
                                </div>
                                <div class="col-4 ">
                                    <div id="asphalt-details-2" class="input-field">
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
                                                    // Check if the option value matches the selected value from the database
                                                    $selected = ($row['unit_id'] == $asphaltUnit) ? 'selected' : '';
                                                    echo "<option value='" . $row['unit_id'] . "' " . $selected . ">" . $row['unit_short_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="asphalt-details-3" class="input-field">
                                        <label>Asphalt Quantity (Rs.)</label>
                                        <input class="p-3 bg-body " id="asphaltQuantity" type="Number" placeholder="Enter Quantity" 
                                        name="asphaltQuantity" value="<?php echo $asphaltQuantity ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div id="asphalt-details-4" class="input-field">
                                        <label>Asphalt Rate (Rs.)</label>
                                        <input class="p-3 bg-body " id="asphaltRate" type="Number" placeholder="Rate for One Unit" 
                                        name="asphaltRate" value="<?php echo $asphaltRate ?>">
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
                                            <option value="1" <?php if ($markingStatus == '1') echo "selected"; ?>>Yes</option>
                                            <option value="2" <?php if ($markingStatus == '2') echo "selected"; ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label>How Many Bridges in Road?</label>
                                        <input class="p-3 bg-body" id="bridges" type="Number" placeholder="Enter Total Bridges" 
                                        name="bridges" value="<?php echo $bridges ?>">
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

<script>
    // Function for Showing and Hiding Input Fields Based on ABC Status
    $(document).ready(function() {
        $('#abcStatus').val('<?php echo $abcStatus; ?>');
        // Call the function to show or hide the field initially
        showHideFieldAbc();

        // Function to show or hide the field in ABC section based on the drop-down value
        function showHideFieldAbc() {
            var selectedValue = $('#abcStatus').val();
            for (var i = 0; i <= 3; i++) {
                if (selectedValue == '1') {
                    $('#abc-details-' + i.toString()).show();
                } else {
                    $('#abc-details-' + i.toString()).hide();
                }
            }
        }
        // Event listener for drop-down change
        $('#abcStatus').on('change', function() {
            showHideFieldAbc();
        });

        // Function for Showing and Hiding Input Fields in Prime Section Based on Prime Status
        $('#primeStatus').val('<?php echo $primeStatus; ?>');
        // Call the function to show or hide the field initially
        showHideFieldPrime();

        // Function to show or hide the field based on the drop-down value
        function showHideFieldPrime() {
            var selectedValue = $('#primeStatus').val();
            for (var i = 0; i <= 3; i++) {
                if (selectedValue == '1') {
                    $('#prime-coat-details-' + i.toString()).show();
                } else {
                    $('#prime-coat-details-' + i.toString()).hide();
                }
            }
        }
        // Event listener for drop-down change
        $('#primeStatus').on('change', function() {
            showHideFieldPrime();
        });

        // Function for Showing and Hiding Input Fields in TAck Coat Section Based on Tack Status
        $('#tackStatus').val('<?php echo $tackStatus; ?>');
        // Call the function to show or hide the field initially
        showHideFieldTack();

        // Function to show or hide the field based on the drop-down value
        function showHideFieldTack() {
            var selectedValue = $('#tackStatus').val();
            for (var i = 0; i <= 3; i++) {
                if (selectedValue == '1') {
                    $('#tack-coat-details-' + i.toString()).show();
                } else {
                    $('#tack-coat-details-' + i.toString()).hide();
                }
            }
        }

        // Event listener for drop-down change
        $('#tackStatus').on('change', function() {
            showHideFieldTack();
        });

        // Function for Showing and Hiding Input Fields in Prime Section Based on Prime Status
        $('#asphaltStatus').val('<?php echo $asphaltStatus; ?>');
        // Call the function to show or hide the field initially
        showHideFieldAsphalt();

        // Function to show or hide the field based on the drop-down value
        function showHideFieldAsphalt() {
            var selectedValue = $('#asphaltStatus').val();
            for (var i = 0; i <= 4; i++) {
                if (selectedValue == '1') {
                    $('#asphalt-details-' + i.toString()).show();
                } else {
                    $('#asphalt-details-' + i.toString()).hide();
                }
            }
        }
        // Event listener for drop-down change
        $('#asphaltStatus').on('change', function() {
            showHideFieldAsphalt();
        });
    });
</script>

<?php include '../footer.php'; ?>