<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add New Resource Details</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH; ?>resources/resource.php" type="button" class="btn btn-sm btn-outline-secondary">View Resources</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Update Details
            </button>
        </div>
    </div>

    <?php
    // Cheking Submit button is clicked
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        // This function uses array keys as variable names and values as variable values
        extract($_POST);

        // create array
        $message = array();

        // Reuired Fields Validation
        if(empty($rName)){
            $message['error_rName'] = "Please Enter Resource Name";
        }
        if(empty($rCondition)){
            $message['error_rCondition'] = "Pleasse Enter Condition of Resource";
        }
        if(empty($rStatus)){
            $message['error_rStatus'] = "Pleasse Enter Status of Resource";
        }
        if(empty($rDescription)){
            $message['error_rDescription'] = "Pleasse Enter Description";
        }

        // Adavanced Validation
        if(!empty($rName)){
            $sql = "SELECT * FROM tbl_resource WHERE r_name = '$rName'";
            $db = dbConn();
            $result = $db->query($sql);

            if($result->num_rows > 0){
                $message['error_rName'] = "The Resource Name Already Exists";
            }
        }
        
        // Check Validation is Completed
        
    }
    ?>
    <form method="post" class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="mb-3">
            <label for="project_name" class="form-label">Resource Name</label>
            <input type="text" class="form-control" id="project_name" name="rName" value="<?php echo @$rName; ?>">
            <div class="text-danger"><?php echo @$message['error_rName']; ?></div>
        </div>
        <div class="mb-3">
            <label for="project_cost" class="form-label">Condition</label>
            <input type="text" class="form-control" id="project_cost" name="rCondition" value="<?php echo @$rCondition; ?>">
            <div class="text-danger"><?php echo @$message['error_rCondition'] ?></div>
        </div>
        <div class="mb-3">
            <label for="project_manager" class="form-label">Status</label>
            <input type="text" class="form-control" id="project_manager" name="rStatus" value="<?php echo @$rStatus; ?>">
            <div class="text-danger"><?php echo @$message['error_rStatus']; ?></div>
        </div>
        <div class="mb-3">
            <label for="project_manager" class="form-label">Description </label>
            <input type="text" class="form-control" id="project_manager" name="rDescription" value="<?php echo @$rDescription; ?>">
            <div class="text-danger"><?php echo @$message['error_rDescription']; ?></div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>

<?php include '../footer.php'; ?>