<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addSchedule.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Add New Task</h4>
        <div>
            <!-- Link to add project form -->
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>schedules/schedule.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">
                View Schedule
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 730px !important;
        }
    </style>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        extract($_GET);

        $sql = "SELECT * FROM tbl_schedule WHERE schedule_id = '$schedule_id'";
        $db = dbConn();
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        $schId = $row['schedule_id'];
        $proId = $row['project_id'];
        $proName = $row['project_name'];
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

                                        <!-- Get count of existing task related to relevant schedule -->
                                        <?php
                                        $sql = "SELECT COUNT(`schedule_id`) FROM tbl_schedule_task WHERE `schedule_id` = $schId";
                                        $db = dbConn();
                                        $result = $db->query($sql);

                                        if ($result) {
                                            $row = $row = $result->fetch_assoc();
                                            $count = $row['COUNT(`schedule_id`)'];

                                            if ($count == 0) { ?>
                                                <h6 class="pt-3 pb-2 mb-0">Task 01</h6>
                                            <?php } else { ?>
                                                <h6 class="pt-3 pb-2 mb-0">Task <?php echo ($count + 1); ?></h6>
                                        <?php }
                                        }  ?>


                                    </div>
                                </div>

                                <form method="post" class="form" id="task-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                                    <!-- Store Value of Schedule ID and Project ID to Further Use -->
                                    <input class="p-3 bg-body" id="scheduleId" type="hidden" name="scheduleId" value="<?php echo $schId ?>">
                                    <input class="p-3 bg-body" id="proId" type="hidden" name="proId" value="<?php echo $proId ?>">

                                    <div class="row justify-content-start gx-5">
                                        <div class="col-sm">
                                            <div class="row row-cols-2 row-cols-lg-1">
                                                <div class="col-4">
                                                    <div class="input-field">
                                                        <label for="startDate">Task Name</label>
                                                        <input class="p-3 bg-body" id="taskName" type="text" placeholder="Enter Task Name" name="taskName" value="">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-field">
                                                        <label for="startDate">Starting Date</label>
                                                        <input class="p-3 bg-body" id="startDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="startDate" value="">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-field">
                                                        <label for="endDate">Ending Date</label>
                                                        <input class="p-3 bg-body" id="endDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="endDate" value="">
                                                    </div>
                                                </div>
                                                <div class="col ">
                                                    <div class="input-field">
                                                        <label for="description">Description</label>
                                                        <textarea class="p-3 bg-body" id="description" type="text" placeholder="Enter Brief Description" name="description" value=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-field">
                                                        <label for="currentStatus">Current Status</label>
                                                        <select class="bg-body " id="currentStatus" name="currentStatus">
                                                            <option value="" selected disabled hidden>Pick an Option</option>
                                                            <option value="1">Not Started</option>
                                                            <option value="2">On Going</option>
                                                            <option value="3">Holding</option>
                                                            <option value="4">Completed</option>
                                                            <option value="5">Closed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-field">
                                                        <label for="cost">Actual Cost</label>
                                                        <input class="p-3 bg-body" id="cost" type="Number" placeholder="Total Cost" name="cost" value="">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-field">
                                                        <label for="cost">Labour Count</label>
                                                        <input class="p-3 bg-body" id="labourCount" type="Number" placeholder="Labour Count" name="labourCount" value="">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-field">
                                                        <label for="cost">Add Resoucers</label>
                                                        <button type="button" class="resource-btn" id="add">
                                                            <i class="fa-sharp fa-regular fa-plus fa-2xl"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-cols-2 row-cols-lg-1 d-none" id="resource-table">
                                                <div class="table-responsive col-6" id="equipment-table">
                                                    <?php
                                                    // Create SQL Query
                                                    $sql = "SELECT `tool_id`,`tool_name` FROM tbl_tool";

                                                    // Calling to the Connection
                                                    $db = dbConn();

                                                    // Get Result
                                                    $result = $db->query($sql);
                                                    ?>
                                                    <table class="table">
                                                        <thead class="shadow">
                                                            <tr>
                                                                <th scope="col">Tool Name</th>
                                                                <th scope="col">Select</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {

                                                            ?>
                                                                    <tr class="shadow-sm">
                                                                        <td class="align-middle"><?= $row['tool_name']; ?></td>
                                                                        <td class="align-middle">
                                                                            <button type="button" class="resource-btn-add" id="add-equipment" data-tool-id="<?= $row['tool_id']; ?>" data-tool-name="<?= $row['tool_name']; ?>">
                                                                                <i class="fa-sharp fa-regular fa-plus fa-2xl"></i>
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
                                                    $sql = "SELECT `machine_id`, `machine_name` FROM tbl_machine";

                                                    // Calling to the Connection
                                                    $db = dbConn();

                                                    // Get Result
                                                    $result = $db->query($sql);
                                                    ?>
                                                    <table class="table">
                                                        <thead class="shadow">
                                                            <tr>
                                                                <th scope="col">Machine Name</th>
                                                                <th scope="col">Select</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {

                                                            ?>
                                                                    <tr class="shadow-sm">
                                                                        <td class="align-middle"><?= $row['machine_name']; ?></td>
                                                                        <td class="align-middle">
                                                                            <button type="button" class="resource-btn-add" id="add-machine" data-machine-id="<?= $row['machine_id']; ?>" data-machine-name="<?= $row['machine_name']; ?>">
                                                                                <i class="fa-sharp fa-regular fa-plus fa-2xl"></i>
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
                                                    <button type="submit" class="nextBtn" id="add-task">Next</button>
                                                </div>
                                                <div class="col-2">
                                                    <button class="nextBtn" type="submit" id="complete">
                                                        <span class="btnText">Complete</span>
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
                                                        <button type="button" class="task-btn" onclick="document.location='addTask.php?schedule_id=<?= $row['schedule_id']; ?>'">
                                                            <?= $row['task_name'] ?> Is Added. Click to More
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

<script src="<?= SYSTEM_PATH; ?>assets/js/schedules/saveTask.js"></script>
<Script>
    // AJAX Function to add Equipments to Project
    $(document).on('click', '#add-equipment', function() {
        var toolId = $(this).data('tool-id');
        var toolName = $(this).data('tool-name');
        var proId = <?php echo $proId; ?>;
        var schId = <?php echo $schId; ?>;

        // Send AJAX request to the PHP script
        $.ajax({
            url: 'saveResource.php',
            method: 'POST',
            data: {
                tool_id: toolId,
                tool_name: toolName,
                project_id: proId,
                schedule_id: schId
            },
            success: function(response) {
                alert(response); // Display a success message or perform any other action

                // Remove "+" icon from button
                $(this).find('i').remove();

                // Add Correct sign to Button
                $(this).append('<img src="<?= SYSTEM_PATH; ?>assets/icons/verified.png" alt="Flaticon Icon">');

                // Disable the button
                $(this).prop('disabled', true);

            }.bind(this),

            error: function() {
                alert('Error occurred while saving the resource.'); // Display an error message
            }
        });
    });

    // AJAX Function to add Machines to Project
    $(document).on('click', '#add-machine', function() {
        var machineId = $(this).data('machine-id');
        var machineName = $(this).data('machine-name');
        var proId = <?php echo $proId; ?>;
        var schId = <?php echo $schId; ?>;

        // Send AJAX request to the PHP script
        $.ajax({
            url: 'saveMachine.php',
            method: 'POST',
            data: {
                machine_id: machineId,
                machine_name: machineName,
                project_id: proId,
                schedule_id: schId
            },
            success: function(response) {
                alert(response); // Display a success message or perform any other action

                // Remove "+" icon from button
                $(this).find('i').remove();

                // Add Correct sign to Button
                $(this).append('<img src="<?= SYSTEM_PATH; ?>assets/icons/verified.png" alt="Flaticon Icon">');

                // Disable the button
                $(this).prop('disabled', true);

            }.bind(this),

            error: function() {
                alert('Error occurred while saving the resource.'); // Display an error message
            }
        });
    });
</Script>

<?php include '../footer.php'; ?>