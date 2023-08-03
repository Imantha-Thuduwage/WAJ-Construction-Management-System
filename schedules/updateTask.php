<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addSchedule.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Update Task Details</h4>
        <div>
            <button type="button" class="btn btn-sm px-5-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>schedules/schedule.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">
                View Schedules
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 820px !important;
        }
    </style>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        extract($_GET);

        $sql = "SELECT * FROM tbl_schedule_task WHERE `task_id` = '$task_id'";
        $db = dbConn();
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        $taskId = $row['task_id'];
        $schId = $row['schedule_id'];
        $taskName = $row['task_name'];
        $startDate = $row['starting_date'];
        $endDate = $row['ending_date'];
        $description = $row['description'];
        $currentStatus = $row['current_status'];
        $cost = $row['cost'];
        $labourCount = $row['labour_count'];
    }

    ?>

    <div class="container field p-0" id="container">
        <div class="row justify-content-start gx-5">
            <div class="col-sm">
                <div class="row row-cols-2 row-cols-lg-1">
                    <div class="col-8">

                        <div class="card shadow" id="form-card">
                            <div class="card-body">

                                <div class="row justify-content-start gx-5">
                                    <div class="col-sm">
                                        <h6 class="pt-3 pb-2 mb-0">Task <?php echo $taskId; ?></h6>
                                    </div>
                                </div>

                                <form method="post" class="form" id="task-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                                    <!-- Store Value of Schedule ID And Task ID to Further Use -->
                                    <input class="p-3 bg-body" id="taskId" type="hidden" name="taskId" value="<?php echo $taskId ?>">
                                    <input class="p-3 bg-body" id="scheduleId" type="hidden" name="scheduleId" value="<?php echo $schId ?>">

                                    <div class="row justify-content-start gx-5">
                                        <div class="col-sm">
                                            <div class="row row-cols-2 row-cols-lg-1">
                                                <div class="col-4">
                                                    <div class="input-field">
                                                        <label for="startDate">Task Name</label>
                                                        <input class="p-3 bg-body" id="taskName" type="text" placeholder="Enter Task Name" name="taskName" value="<?php echo $taskName ?>">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-field">
                                                        <label for="startDate">Starting Date</label>
                                                        <input class="p-3 bg-body" id="startDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="startDate" value="<?php echo $startDate ?>">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-field">
                                                        <label for="endDate">Ending Date</label>
                                                        <input class="p-3 bg-body" id="endDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="endDate" value="<?php echo $endDate ?>">
                                                    </div>
                                                </div>
                                                <div class="col ">
                                                    <div class="input-field">
                                                        <label for="description">Description</label>
                                                        <textarea class="p-3 bg-body" id="description" type="text" placeholder="Enter Brief Description" name="description"><?php echo $description ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-field">
                                                        <label for="currentStatus">Current Status</label>
                                                        <select class="bg-body " id="currentStatus" name="currentStatus">
                                                            <option value="" selected disabled hidden>Pick an Option</option>
                                                            <option value="1" <?php if ($currentStatus == '1') echo "selected"; ?>>Not Started</option>
                                                            <option value="2" <?php if ($currentStatus == '2') echo "selected"; ?>>On Going</option>
                                                            <option value="3" <?php if ($currentStatus == '3') echo "selected"; ?>>Holding</option>
                                                            <option value="4" <?php if ($currentStatus == '4') echo "selected"; ?>>Completed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-field">
                                                        <label for="cost">Actual Cost</label>
                                                        <input class="p-3 bg-body" id="cost" type="Number" placeholder="Total Cost" name="cost" value="<?php echo $cost ?>">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-field">
                                                        <label for="cost">Labour Count</label>
                                                        <input class="p-3 bg-body" id="labourCount" type="Number" placeholder="Labour Count" name="labourCount" value="<?php echo $labourCount ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-cols-2 row-cols-lg-1" id="resource-table">
                                                <div class="table-responsive col-6">
                                                    <?php
                                                    // Create SQL Query
                                                    $sql = "SELECT * FROM tbl_project_tool WHERE `schedule_id` = '$schId'";

                                                    // Calling to the Connection
                                                    $db = dbConn();

                                                    // Get Result
                                                    $result = $db->query($sql);
                                                    ?>
                                                    <table class="table table-sm">
                                                        <thead class="shadow">
                                                            <tr>
                                                                <th scope="col">Allocate ID</th>
                                                                <th scope="col">Tool Name</th>
                                                                <th scope="col">Remove</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {

                                                            ?>
                                                                    <tr class="shadow-sm">
                                                                        <td class="align-middle"><?= $row['allocate_id']; ?></td>
                                                                        <td class="align-middle"><?= $row['tool_name']; ?></td>
                                                                        <td>
                                                                            <button type="button" class="resource-btn-add">
                                                                                <a href='deleteResource.php?allocate_id=<?= $row['allocate_id']; ?>' onclick='return confirmDelete()'>
                                                                                    <img src="<?= SYSTEM_PATH; ?>assets/icons/minus-button.png">
                                                                                </a>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="table-responsive col-6">
                                                    <?php
                                                    // Create SQL Query
                                                    $sql = "SELECT * FROM tbl_project_machine WHERE `schedule_id` = '$schId'";

                                                    // Calling to the Connection
                                                    $db = dbConn();

                                                    // Get Result
                                                    $result = $db->query($sql);
                                                    ?>
                                                    <table class="table table-sm">
                                                        <thead class="shadow">
                                                            <tr>
                                                                <th scope="col">Allocate ID</th>
                                                                <th scope="col">Machine Name</th>
                                                                <th scope="col">Remove</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {

                                                            ?>
                                                                    <tr class="shadow-sm">
                                                                        <td class="align-middle"><?= $row['allocate_id']; ?></td>
                                                                        <td class="align-middle"><?= $row['machine_name']; ?></td>
                                                                        <td>
                                                                            <button type="button" class="resource-btn-add">
                                                                                <a href='deleteMachine.php?allocate_id=<?= $row['allocate_id']; ?>' onclick='return confirmDelete()'>
                                                                                    <img src="<?= SYSTEM_PATH; ?>assets/icons/minus-button.png">
                                                                                </a>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row justify-content-start gx-5">
                                        <div class="col-sm">
                                            <div class="row row-cols-2 row-cols-lg-1">
                                                <div class="col-2">
                                                    <button class="nextBtn" type="submit" id="complete">
                                                        <span class="btnText">Update</span>
                                                        <i class="uil uil-navigator"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">

                        <div class="card shadow" id="form-card">
                            <div class="card-body p-0">
                                <?php
                                // Create SQL Query
                                $sql = "SELECT `task_id`,`schedule_id`,`task_name` FROM tbl_schedule_task WHERE schedule_id = '$schId'";

                                // Calling to the Connection
                                $db = dbConn();

                                // Get Result
                                $result = $db->query($sql);
                                ?>
                                <table class="table table-sm m-0">
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td>
                                                        <button type="button" class="task-btn" onclick="document.location='updateTask.php?task_id=<?= $row['task_id']; ?>'">
                                                            Task <b><?= $row['task_name'] ?> </b> Task
                                                        </button>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>

<script src="<?= SYSTEM_PATH; ?>assets/js/schedules/updateTask.js"></script>


<?php include '../footer.php'; ?>