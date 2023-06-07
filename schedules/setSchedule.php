<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/setSchedule.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Set New Schedule</h4>
        <div>
            <button type="button" class="btn btn-sm px-5-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>projects/project.php'">
                View Schedules
            </button>
            <button type="button" class="btn btn-sm px-5 border-bottom border-end border-2">
                Filters
            </button>
        </div>
    </div>

    <?php
    // Cheking Submit button is clicked
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // This function uses array keys as variable names and values as variable values
        extract($_POST);

        // create array
        $message = array();

        // Reuired Fields Validation
        if (empty($pId)) {
            $message['error_pId'] = "Project ID is Required";
        }
        if (empty($pName)) {
            $message['error_pName'] = "Project Name is Required";
        }

        // Adavanced Validation
        // Checking if any Project Stored in DB Related to User Inputs
        else if (!empty($pId && $pName)) {
            $sql = "SELECT `project_id`, `project_name` FROM tbl_project WHERE `project_id` = '$pId' AND `project_name` = '$pName'";
            $db = dbConn();
            $result = $db->query($sql);

            if ($result->num_rows > 0) {

                // Retrieving values for fields that are not in the form
                $addUser = $_SESSION['userid'];
                $addDate = date('y-m-d');

                //Checking if any Schedule Stored in DB Related to User Inputs
                $sql2 = "SELECT `project_id`, `project_name` FROM tbl_schedule WHERE `project_id` = '$pId' AND `project_name` = '$pName'";
                $db2 = dbConn();
                $result2 = $db2->query($sql2);

                if ($result2->num_rows > 0) {
                    $message['error_checking'] = "Aleady Exists Schedule";
                } else {
                    $sql3 = "INSERT INTO tbl_schedule (`project_id`, `project_name`, `add_user`, `add_date`)
                    VALUES('$pId', '$pName', '$addUser', '$addDate')";
                    $db3 = dbConn();
                    if ($db3->query($sql3)) {

                        // Construct the URL for the desired page
                        $anotherPageUrl = SYSTEM_PATH . 'schedules/addSchedule.php?project_id=' . $pId;

                        // Redirect the user to the desired page
                        echo '<meta http-equiv="refresh" content="0;url=' . $anotherPageUrl . '">';
                    }
                }
            } else {
                $message['error_checking'] = "Values are Doesn't Match";
            }
        }
    }
    ?>

    <div class="card shadow" id="form-card">
        <div class="card-body d-flex align-items-center justify-content-center" style=" height:450px">
            <form method="post" class="form" id="project-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="col-3 card w-100 align-items-center justify-content-center border-4 shadow-sm" id="form-div">
                    <div class="card-body">
                        <div class="container field p-0">

                            <div class="row justify-content-start gx-5">
                                <div class="col-sm">
                                    <div class="row row-cols-2 row-cols-lg-1">
                                        <div class="col-12 ">
                                            <div class="alert alert-danger" <?php echo @$message['error_checking'] ? 'show' : 'hidden' ?>>
                                                <?php echo @$message['error_checking']; ?></div>
                                            <div class="input-field">
                                                <label for="project_name">Project ID</label>
                                                <input class="p-3 bg-body <?php echo @$message['error_pId'] ? 'error placeholder-set' : ''; ?>" id="pId" type="text" placeholder="Enter Your Project ID" name="pId" value="<?php echo @$pId; ?>">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-field">
                                                <label for="project_location">Project Name</label>
                                                <input class="p-3 bg-body <?php echo @$message['error_pName'] ? 'error placeholder-set' : '' ?>" id="pName" type="text" placeholder="Enter Your Project Name" name="pName" value="<?php echo @$pName; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="nextBtn" type="submit" id="submit">
                            <span class="btnText">Next</span>
                            <i class="uil uil-navigator"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include '../footer.php'; ?>