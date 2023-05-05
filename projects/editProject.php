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
        $concreteStatus = $row['concrete_status'];
        $concreteUnit = $row['concrete_unit'];
        $concreteQuantity = $row['concrete_quantity'];
        $concreteRate = $row['concrete_rate'];
        $bridges = $row['bridges'];
        $pCost = $row['total_cost'];
    }

    // Cheking Submit button is clicked
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // This function uses array keys as variable names and values as variable values
        extract($_POST);

        // create array
        $message = array();

        // Reuired Fields Validation
        if (empty($pName)) {
            $message['error_pName'] = "Please Enter Project Name";
        }
        if (empty($pLocation)) {
            $message['error_pLocation'] = "Please Enter Location";
        }
        if ($abcStatus == "Pick an Option") {
            $message['error_abc'] = "Please Select Value";
        }
        if ($primeStatus == "Pick an Option") {
            $message['error_primeCoat'] = "Please Select Value";
        }
        if ($tackStatus == "Pick an Option") {
            $message['error_tackCoat'] = "Please Select Value";
        }
        if ($asphaltStatus == "Pick an Option") {
            $message['error_asphalt'] = "Please Select Value";
        }
        if ($concreteStatus == "Pick an Option") {
            $message['error_concrete'] = "Please Select Value";
        }
        if ($markingStatus == "Pick an Option") {
            $message['error_marking'] = "Please Select Value";
        }
        if (empty($bridges)) {
            $message['error_bridges'] = "Please Enter Bridge Count";
        }
        if (empty($pCost)) {
            $message['error_pCost'] = "Please Enter Total Cost";
        }

        // Adavanced Validation
        if (!empty($pName)) {
            $sql = "SELECT * FROM tbl_project WHERE project_name = '$pName'";
            $db = dbConn();
            $result = $db->query($sql);

            if ($result->num_rows > 0) {
                $message['error_pName'] = "The Project Name is Already Exist!";
            }
        }
        // Check Validation is Completed
        if (empty($message)) {
            // Retrieving values for fields that are not in the form
            $addUser = $_SESSION['userid'];
            $addDate = date('y-m-d');


            $sql = "UPDATE tbl_products SET ProductName='$pName', ProductQty='$pQty', ProductPrice='$pPrice', ProductDescription='$pDescription',ProductImage='$file_name_new', ProductStatus='$pStatus', UpdateDate='$UpdateDate', UpdateUser='$UpdateUser' WHERE ProductId='$ProductId'";
            $db = dbConn();
            $db->query($sql);

            $sql = "DELETE FROM tbl_product_sizes WHERE ProductId='$ProductId'";
            $db->query($sql);
            // Calling to DB Connection
            $sql = "UPDATE tbl_project SET 
            project_name = '$pName',p_location = '$pLocation',abc_status = '$abcStatus',abc_unit = '$abcUnit',abc_quantity = '$abcQuantity',
            abc_rate = '$abcRate',prime_status = '$primeStatus',prime_unit = '$primeUnit',prime_quantity = '$primeQuantity',prime_rate = '$primeRate',
            tack_status = '$tackStatus',tack_unit = '$tackUnit',tack_quantity = '$tackQuantity',
            tack_rate = '$tackRate',asphalt_status = '$asphaltStatus',asphalt_thickness  = '$asphaltThicknes',
            asphalt_unit = '$asphaltUnit',asphalt_quantity ='$asphaltQuantity',asphalt_rate ='$asphaltRate',
            concrete_status = '$concreteStatus',concrete_unit = '$concreteUnit',concrete_quantity = '$concreteQuantity',
            concrete_rate ='$concreteRate',
            marking_status= '$markingStatus',bridges ='$bridges',total_cost = '$pCost',
            update_user = '$addUser',update_date = '$addDate' WHERE project_id = '$pId'";
            $db = dbConn();
            $db->query($sql);
            showMessage();
        }
    }

    ?>
    <div class="card shadow" id="form-card">
        <div class="card-body">
            <form method="post" class="form mt-3" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="field">
                    <div class="input-field field-3">
                        <label for="project_name">Project ID</label>
                        <input class="p-3 bg-body" type="num" name="pId" value="<?php echo @$pId; ?>">
                        <label class="text-danger hh"><?php echo @$message['error_pId']; ?></label>
                    </div>
                    <div class="input-field field-3">
                        <label for="project_name">Project Name</label>
                        <input class="p-3 bg-body" type="text" placeholder="Enter Project Name" name="pName" value="<?php echo @$pName; ?>">
                        <label class="text-danger hh"><?php echo @$message['error_pName']; ?></label>
                    </div>
                    <div class="input-field field-3">
                        <label for="project_location">Location</label>
                        <input class="p-3 bg-body" type="text" placeholder="Enter Project Location" name="pLocation" value="<?php echo @$pLocation; ?>">
                        <label class="text-danger"><?php echo @$message['error_pLocation']; ?></label>
                    </div>
                    <div class="input-field field-3">
                        <label>Is ABC include in this?</label>
                        <select class="bg-body" name="abcStatus" onchange="enableAbcDetails(this)">
                            <option>Pick an Option</option>
                            <option value="1" <?php if ($abcStatus == '1') {
                                                    echo 'selected';
                                                } ?>>Yes</option>
                            <option value="0" <?php if ($abcStatus == '0') {
                                                    echo 'selected';
                                                } ?>>No</option>
                        </select>
                        <label class="text-danger"><?php echo @$message['error_abc']; ?></label>
                    </div>
                    <div class="input-field field-3">
                        <label>ABC Unit</label>
                        <select class="bg-body" name="abcUnit">
                            <option>Pick an Unit</option>

                            <?php
                            // Retrieve data from MySQL database
                            $sql = "SELECT unit_id,unit_short_name FROM tbl_measurement_unit";
                            $db = dbConn();
                            $result = $db->query($sql);

                            // Display options in dropdown list
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['unit_short_name'] . "</option>";
                                }
                            }
                            ?>

                        </select>
                    </div>
                    <div class="input-field field-3">
                        <label>ABC Quantity</label>
                        <input class="p-3 bg-body " type="number" placeholder="Enter Quantity" name="abcQuantity" value="<?php echo @$pManager; ?>">
                    </div>
                    <div class="input-field field-3">
                        <label>ABC Rate (Rs.)</label>
                        <input class="p-3 bg-body " type="Number" placeholder="Rate for One Unit" name="abcRate" value="<?php echo @$pManager; ?>">
                    </div>
                    <div class="input-field field-3">
                        <label>Is Prime Coat include in Project?</label>
                        <select class="bg-body" name="primeStatus" onchange="enablePrimeDetails(this)">
                            <option>Pick an Option</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        <label class="text-danger"><?php echo @$message['error_primeCoat']; ?></label>
                    </div>
                    <div class="input-field field-3">
                        <label>Prime Coat Unit</label>
                        <select class="bg-body" name="primeUnit">
                            <option>Pick an Unit</option>

                            <?php
                            // Retrieve data from MySQL database
                            $sql = "SELECT unit_id,unit_short_name FROM tbl_measurement_unit";
                            $db = dbConn();
                            $result = $db->query($sql);

                            // Display options in dropdown list
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['unit_short_name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-field field-3">
                        <label>Prime Coat Quantity</label>
                        <input class="p-3 bg-body " type="number" placeholder="Enter Quantity" name="primeQuantity" value="<?php echo @$pManager; ?>">
                    </div>
                    <div class="input-field field-3">
                        <label>Prime Coat Rate (Rs.)</label>
                        <input class="p-3 bg-body " type="Number" placeholder="Rate for One Unit" name="primeRate" value="<?php echo @$pManager; ?>">
                    </div>
                    <div class="input-field field-3">
                        <label for="tackStatus">Is Tack Coat include in Project?</label>
                        <select class="bg-body" name="tackStatus" onchange="enableTackDetails(this)">
                            <option>Pick an Option</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        <label class="text-danger"><?php echo @$message['error_tackCoat']; ?></label>
                    </div>
                    <div class="input-field field-3">
                        <label>Tack Coat Unit</label>
                        <select class="bg-body" name="tackUnit">
                            <option>Pick an Unit</option>

                            <?php
                            // Retrieve data from MySQL database
                            $sql = "SELECT unit_id,unit_short_name FROM tbl_measurement_unit";
                            $db = dbConn();
                            $result = $db->query($sql);

                            // Display options in dropdown list
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['unit_short_name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-field field-3 ">
                        <label>Tack Coat Quantity</label>
                        <input class="p-3 bg-body " type="number" placeholder="Enter Quantity" name="tackQuantity" value="<?php echo @$pManager; ?>">
                    </div>
                    <div class="input-field field-3">
                        <label>Tack Coat Rate (Rs.)</label>
                        <input class="p-3 bg-body " type="Number" placeholder="Rate for One Unit" name="tackRate" value="<?php echo @$pManager; ?>">
                    </div>
                    <div class="input-field field-3">
                        <label>Is Tack Asphalt Laying include in Project?</label>
                        <select class="bg-body" name="asphaltStatus" onchange="enableAsphaltDetails(this)">
                            <option>Pick an Option</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        <label class="text-danger"><?php echo @$message['error_asphalt']; ?></label>
                    </div>
                    <div class="input-field field-3 ">
                        <label>Asphalt Thickness (mm)</label>
                        <input class="p-3 bg-body " type="number" placeholder="Enter Thickness" name="asphaltThicknes" value="<?php echo @$pManager; ?>">
                    </div>
                    <div class="input-field field-3">
                        <label>Asphalt Unit</label>
                        <select class="bg-body" name="asphaltUnit">
                            <option>Pick an Unit</option>

                            <?php
                            // Retrieve data from MySQL database
                            $sql = "SELECT unit_id,unit_short_name FROM tbl_measurement_unit";
                            $db = dbConn();
                            $result = $db->query($sql);

                            // Display options in dropdown list
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['unit_short_name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-field field-3">
                        <label>Asphalt Quantity (Rs.)</label>
                        <input class="p-3 bg-body " type="Number" placeholder="Enter Quantity" name="asphaltQuantity" value="<?php echo @$pManager; ?>">
                    </div>
                    <div class="input-field field-3">
                        <label>Asphalt Rate (Rs.)</label>
                        <input class="p-3 bg-body " type="Number" placeholder="Rate for One Unit" name="asphaltRate" value="<?php echo @$pManager; ?>">
                    </div>
                    <div class="input-field field-3">
                        <label for="concreteStatus">Is Concrete Wall include in Project?</label>
                        <select class="bg-body" name="concreteStatus" onchange="enableConcreteDetails(this)">
                            <option>Pick an Option</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        <label class="text-danger"><?php echo @$message['error_concrete']; ?></label>
                    </div>
                    <div class="input-field field-3">
                        <label>Concrete Unit</label>
                        <select class="bg-body" name="concreteUnit">
                            <option>Pick an Unit</option>

                            <?php
                            // Retrieve data from MySQL database
                            $sql = "SELECT unit_id,unit_short_name FROM tbl_measurement_unit";
                            $db = dbConn();
                            $result = $db->query($sql);

                            // Display options in dropdown list
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['unit_short_name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-field field-3">
                        <label>Concrete Quantity</label>
                        <input class="p-3 bg-body " type="number" placeholder="Enter Quantity" name="concreteQuantity" value="<?php echo @$pManager; ?>">
                    </div>
                    <div class="input-field field-3">
                        <label>Concrete Rate (Rs.)</label>
                        <input class="p-3 bg-body " type="Number" placeholder="Rate for One Unit" name="concreteRate" value="<?php echo @$pManager; ?>">
                    </div>
                    <div class="input-field field-3">
                        <label>Marking the roads?</label>
                        <select class="bg-body" name="markingStatus">
                            <option>Pick an Option</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        <label class="text-danger"><?php echo @$message['error_marking']; ?></label>
                    </div>
                    <div class="input-field field-3">
                        <label>How Many Bridges in Road?</label>
                        <input class="p-3 bg-body" type="Number" placeholder="Enter Total Bridges" name="bridges" value="<?php echo @$pManager; ?>">
                        <label class="text-danger hh"><?php echo @$message['error_bridges']; ?></label>
                    </div>
                    <div class="input-field field-3">
                        <label>Total Cost (Rs.)</label>
                        <input class="p-3 bg-body" type="Number" placeholder="Total Cost" name="pCost" value="<?php echo @$pManager; ?>">
                        <label class="text-danger hh"><?php echo @$message['error_pCost']; ?></label>
                    </div>
                </div>

                <button class="nextBtn" type="submit">
                    <span class="btnText">Update</span>
                    <i class="uil uil-navigator"></i>
                </button>
            </form>
        </div>
    </div>
</main>


<?php include '../footer.php'; ?>