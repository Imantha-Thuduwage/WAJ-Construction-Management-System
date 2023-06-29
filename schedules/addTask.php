<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addSchedule.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Create New Task</h4>
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

                                    <!-- Store Value of Schedule ID to Further Use -->
                                    <input class="p-3 bg-body" id="scheduleId" type="hidden" name="scheduleId" value="<?php echo $schId ?>">

                                    <div class="row justify-content-start gx-5">
                                        <div class="col-sm">
                                            <div class="row row-cols-2 row-cols-lg-1">
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
                                                    $sql = "SELECT `resource_id`,`resource_name` FROM tbl_resource";

                                                    // Calling to the Connection
                                                    $db = dbConn();

                                                    // Get Result
                                                    $result = $db->query($sql);
                                                    ?>
                                                    <table class="table">
                                                        <thead class="shadow">
                                                            <tr>
                                                                <th scope="col">Resource Name</th>
                                                                <th scope="col">Select</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {

                                                            ?>
                                                                    <tr class="shadow-sm">
                                                                        <td class="align-middle"><?= $row['resource_name']; ?></td>
                                                                        <td class="align-middle">
                                                                            <button type="button" class="resource-btn-add" id="add-equipment" data-resource-id="<?= $row['resource_id']; ?>">
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
                                                    $sql = "SELECT `resource_name` FROM tbl_resource";

                                                    // Calling to the Connection
                                                    $db = dbConn();

                                                    // Get Result
                                                    $result = $db->query($sql);
                                                    ?>
                                                    <table class="table">
                                                        <thead class="shadow">
                                                            <tr>
                                                                <th scope="col">Resource Name</th>
                                                                <th scope="col">Select</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {

                                                            ?>
                                                                    <tr class="shadow-sm">
                                                                        <td class="align-middle"><?= $row['resource_name']; ?></td>
                                                                        <td class="align-middle">
                                                                            <button type="button" class="resource-btn-add" id="add-machinery">
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
                            <div class="card-body">
                                <div class="row justify-content-start gx-5">
                                    <div class="col-sm">
                                        <div class="row row-cols-2 row-cols-lg-1">

                                        </div>
                                    </div>
                                </div>
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
    $(document).ready(function() {
        $('#add-equipment').click(function() {
            var resourceId = $(this).data('resource-id');
            // var resourceName = $(this).data('resource-name');
            var proId = <?php echo $proId; ?>;
            var schId = <?php echo $schId; ?>;
            console.log(resourceId, proId, schId);

            // Send AJAX request to the PHP script
            $.ajax({
                url: 'saveResource.php',
                method: 'POST',
                data: {
                    resource_id: resourceId,
                    project_id: proId,
                    schedule_id: schId
                },
                success: function(response) {
                    alert(response); // Display a success message or perform any other action

                    // Remove "+" icon from button
                    $('#add-equipment[data-resource-id="' + resourceId + '"] i').remove();

                    // Add Correct sign to Button
                    $('#add-equipment[data-resource-id="' + resourceId + '"]').append('<img src="<?= SYSTEM_PATH; ?>assets/icons/verified.png" alt="Flaticon Icon">');

                    // Disable the button
                    $('#add-equipment[data-resource-id="' + resourceId + '"]').prop('disabled', true);

                },

                error: function() {
                    alert('Error occurred while saving the resource.'); // Display an error message
                }
            });
        });
    });
</Script>

<?php include '../footer.php'; ?>