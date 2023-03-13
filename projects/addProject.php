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

            // Calling to DB Connection
            $sql = "INSERT INTO tbl_project
            (project_name,p_location,abc_status,abc_unit,abc_quantity,abc_rate,prime_status,prime_unit,prime_quantity,prime_rate,tack_status,tack_unit,tack_quantity,
            tack_rate,asphalt_status,asphalt_thickness,asphalt_unit,asphalt_quantity,asphalt_rate,concrete_status,concrete_unit,concrete_quantity,concrete_rate,marking_status,bridges,total_cost,add_user,add_date) 
            VALUES('$pName','$pLocation','$abcStatus','$abcUnit','$abcQuantity','$abcRate','$primeStatus','$primeUnit','$primeQuantity','$primeRate','$tackStatus','$tackUnit','$tackQuantity',
            '$tackRate','$asphaltStatus','$asphaltThicknes','$asphaltUnit','$asphaltQuantity','$asphaltRate','$concreteStatus','$concreteUnit','$concreteQuantity','$concreteRate','$markingStatus','$bridges','$pCost','$addUser','$addDate')";
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
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        <label class="text-danger"><?php echo @$message['error_abc']; ?></label>
                    </div>
                    <div id="abc-details-1" class="input-field field-3 d-none">
                        <label>ABC Unit</label>
                        <select class="bg-body" name="abcUnit">
                            <option>Pick an Unit</option>
                            <option value="0">Square Meter(Sq. M.)</option>
                            <option value="1">No</option>
                        </select>
                    </div>
                    <div id="abc-details-2" class="input-field field-3 d-none">
                        <label>ABC Quantity</label>
                        <input class="p-3 bg-body " type="number" placeholder="Enter Quantity" name="abcQuantity" value="<?php echo @$pManager; ?>">
                    </div>
                    <div id="abc-details-3" class="input-field field-3 d-none">
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
                    <div id="prime-coat-details-1" class="input-field field-3 d-none">
                        <label>Prime Coat Unit</label>
                        <select class="bg-body" name="primeUnit">
                            <option>Pick an Unit</option>
                            <option value="0">Square Meter(Sq. M.)</option>
                            <option value="1">No</option>
                        </select>
                    </div>
                    <div id="prime-coat-details-2" class="input-field field-3 d-none">
                        <label>Prime Coat Quantity</label>
                        <input class="p-3 bg-body " type="number" placeholder="Enter Quantity" name="primeQuantity" value="<?php echo @$pManager; ?>">
                    </div>
                    <div id="prime-coat-details-3" class="input-field field-3 d-none">
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
                    <div id="tack-coat-details-1" class="input-field field-3 d-none">
                        <label>Tack Coat Unit</label>
                        <select class="bg-body" name="tackUnit">
                            <option>Pick an Unit</option>
                            <option value="0">Square Meter(Sq. M.)</option>
                            <option value="1">No</option>
                        </select>
                    </div>
                    <div id="tack-coat-details-2" class="input-field field-3 d-none">
                        <label>Tack Coat Quantity</label>
                        <input class="p-3 bg-body " type="number" placeholder="Enter Quantity" name="tackQuantity" value="<?php echo @$pManager; ?>">
                    </div>
                    <div id="tack-coat-details-3" class="input-field field-3 d-none">
                        <label>Tack Coat Rate (Rs.)</label>
                        <input class="p-3 bg-body " type="Number" placeholder="Rate for One Unit" name="tackRate" value="<?php echo @$pManager; ?>">
                    </div>
                    <div class="input-field field-3">
                        <label >Is Tack Asphalt Laying include in Project?</label>
                        <select class="bg-body" name="asphaltStatus" onchange="enableAsphaltDetails(this)">
                            <option>Pick an Option</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        <label class="text-danger"><?php echo @$message['error_asphalt']; ?></label>
                    </div>
                    <div id="asphalt-details-2" class="input-field field-3 d-none">
                        <label>Asphalt Thickness (mm)</label>
                        <input class="p-3 bg-body " type="number" placeholder="Enter Thickness" name="asphaltThicknes" value="<?php echo @$pManager; ?>">
                    </div>
                    <div id="asphalt-details-1" class="input-field field-3 d-none">
                        <label>Asphalt Unit</label>
                        <select class="bg-body" name="asphaltUnit">
                            <option>Pick an Unit</option>
                            <option value="0">Square Meter(Sq. M.)</option>
                            <option value="1">No</option>
                        </select>
                    </div>
                    <div id="asphalt-details-3" class="input-field field-3 d-none">
                        <label>Asphalt Quantity (Rs.)</label>
                        <input class="p-3 bg-body " type="Number" placeholder="Enter Quantity" name="asphaltQuantity" value="<?php echo @$pManager; ?>">
                    </div>
                    <div id="asphalt-details-4" class="input-field field-3 d-none">
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
                    <div id="concrete-details-1" class="input-field field-3 d-none">
                        <label>Concrete Unit</label>
                        <select class="bg-body" name="concreteUnit">
                            <option>Pick an Unit</option>
                            <option value="0">Square Meter(Sq. M.)</option>
                            <option value="1">No</option>
                        </select>
                    </div>
                    <div id="concrete-details-2" class="input-field field-3 d-none">
                        <label>Concrete Quantity</label>
                        <input class="p-3 bg-body " type="number" placeholder="Enter Quantity" name="concreteQuantity" value="<?php echo @$pManager; ?>">
                    </div>
                    <div id="concrete-details-3" class="input-field field-3 d-none">
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
                    <span class="btnText">Next</span>
                    <i class="uil uil-navigator"></i>
                </button>
            </form>
        </div>
    </div>
</main>

<script src="<?= SYSTEM_PATH; ?>assets/js/project.js"></script>
<?php include '../footer.php'; ?>