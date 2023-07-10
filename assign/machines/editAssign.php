<?php include '../../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Edit Assign</h4>
        <div>
            <button type="button" class="btn btn-sm px-5-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>machines/assign/assign.php'">
                View Assigns
            </button>
            <button type="button" class="btn btn-sm px-5 border-bottom border-end border-2">
                Filters
            </button>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        extract($_GET);

        $sql = "SELECT * FROM tbl_machine_assign WHERE assign_id='$assign_id'";
        $db = dbConn();
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $assignId = $row['assign_id'];
        $proId = $row['project_id'];
        $machineId = $row['machine_id'];
        $assignDate = $row['assign_date'];
        $returnDate = $row['return_date'];
        $description = $row['special_note'];
    }
    ?>

    <div class="card shadow" method="POST" id="form-card" action="saveEditAssign.php">
        <div class="card-body">

            <form method="post" class="form" id="assign-form">
                <div class="container field p-0">
                    <div class="row justify-content-center gx-5">
                        <div class="col-sm-6">
                            <h6 class="pt-3 pb-2 mb-0">Enter Your Machine Assgining Details Here</h6>
                        </div>
                    </div>
                    <input type="hidden" name="assignId" value="<?php echo $assign_id ?>">
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
                                             // Check if the option value matches the selected value from the database
                                             $selected = ($row['project_id'] == $proId) ? 'selected' : '';
                                             echo "<option value='" . $row['project_id'] . "' " . $selected . ">" . $row['project_id'] . "</option>";
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
                                <label for="machine_id">Machine ID</label>
                                <select class="bg-body " id="machineId" name="machineId">
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
                                <label for="assignment_date">Assignment Date</label>
                                <input class="p-3 bg-body" id="assignDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="assignDate" value="<?php echo $assignDate ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-6">
                            <div class="input-field">
                                <label for="return_date">Return Date</label>
                                <input class="p-3 bg-body" id="returnDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="returnDate" value="<?php echo $returnDate ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-6">
                            <div class="input-field">
                                <label for="description">Special Note (Not mandatory)</label>
                                <textarea class="p-3 bg-body" id="description" type="text" placeholder="Enter Brief Description" name="description"><?php echo $description ?></textarea>
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

<script src="<?= SYSTEM_PATH; ?>assets/js/machines/assign/editAssign.js"></script>

<?php include '../../footer.php'; ?>