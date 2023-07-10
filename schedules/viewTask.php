<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/project.css">
<?php include '../menu.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    extract($_GET);
} ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Schedule <?php echo $schedule_id ?></h4>
        <div>
            <button type="button" class="btn btn-sm px-5 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>schedules/schedule.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">
                View Schedule
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 630px !important;
        }
    </style>

    <div class="card shadow" id="form-card">
        <div class="card-body">
            <h4>Table of Tasks List</h4>
            <div class="table-responsive">
                <?php
                // Create SQL Query
                $sql = "SELECT * FROM tbl_schedule_task WHERE `schedule_id` = '$schedule_id'";

                // Calling to the Connection
                $db = dbConn();

                // Get Result
                $result = $db->query($sql);
                ?>
                <table class="table table-sm">
                    <thead class="shadow">
                        <tr>
                            <th scope="col">Task ID</th>
                            <th scope="col">Task Name</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Labour Count</th>
                            <th scope="col">Update</th>
                            <th scope="col">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                        ?>
                                <tr class="shadow-sm">
                                    <td class="align-middle"><?= $row['task_id']; ?></td>
                                    <td class="align-middle"><?= $row['task_name']; ?></td>
                                    <td class="align-middle"><?= $row['starting_date']; ?></td>
                                    <td class="align-middle"><?= $row['ending_date']; ?></td>
                                    <td class="align-middle">
                                        <span class="status-circle" style="background-color: <?= getStatusInfo($row['current_status'])[1]; ?>"></span>
                                        <?= getStatusInfo($row['current_status'])[0]; ?>
                                    </td>
                                    <td class="align-middle"><?= $row['cost']; ?></td>
                                    <td class="align-middle"><?= $row['labour_count']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='updateTask.php?task_id=<?= $row['task_id']; ?>'">
                                            Edit
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='updateTask.php?task_id=<?= $row['task_id']; ?>'">
                                            Delete
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
        <div>
</main>

<?php

// Fuction to Set Text Value to Current Status On Task Table
function getStatusInfo($statusValue)
{
    switch ($statusValue) {
        case '1':
            return ['Not Started', 'black'];
        case '2':
            return ['On Going', 'lightgreen'];
        case '3':
            return ['Holding', 'orange'];
        case '4':
            return ['Completed', 'darkgreen'];
        case '5':
            return ['Closed', 'red'];
        default:
            return ['', ''];
    }
}
?>


<?php include '../footer.php'; ?>