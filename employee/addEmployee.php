<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add New Project</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH; ?>projects/project.php" type="button" class="btn btn-sm btn-outline-secondary">View Project</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Update Project
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
            $message['error_pName'] = "Please Enter Your Project Name";
        }
        if (empty($pCost)) {
            $message['error_pCost'] = "Please Enter Your Project Cost";
        }
        if (empty($pLocation)) {
            $message['error_pLocation'] = "Please Enter Your Project Location";
        }
        if (empty($pManager)) {
            $message['error_pManager'] = "Please Enter Your Project Manager";
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
            $add_date = date('y-m-d');

            // Calling to DB Connection
            $sql = "INSERT INTO tbl_project(project_name,cost,p_location,project_manager,add_user,add_date) VALUES('$pName','$pCost','$pLocation','$pManager','$addUser','$add_date')";
            $db = dbConn();
            $db->query($sql);
        }
    }

    ?>
    <form method="post" class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="mb-3">
            <label for="project_name" class="form-label">Project Name</label>
            <input type="text" class="form-control" id="project_name" name="pName" value="<?php echo @$pName; ?>">
            <div class="text-danger"><?php echo @$message['error_pName']; ?></div>
        </div>
        <div class="mb-3">
            <label for="project_cost" class="form-label">Cost </label>
            <input type="number" class="form-control" id="project_cost" name="pCost" value="<?php echo @$pCost; ?>">
            <div class="text-danger"><?php echo @$message['error_pCost']; ?></div>
        </div>
        <div class="mb-3">
            <label for="project_manager" class="form-label">Location</label>
            <input type="text" class="form-control" id="project_manager" name="pLocation" value="<?php echo @$pManager; ?>">
            <div class="text-danger"><?php echo @$message['error_pLocation']; ?></div>
        </div>
        <div class="mb-3">
            <label for="project_manager" class="form-label">Project Manger</label>
            <input type="text" class="form-control" id="project_manager" name="pManager" value="<?php echo @$pManager; ?>">
            <div class="text-danger"><?php echo @$message['error_pManager']; ?></div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>

<?php include '../footer.php'; ?>