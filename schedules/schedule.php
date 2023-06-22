<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/project.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Manage Schedules</h4>
        <div>
            <button type="button" class="btn btn-sm px-5 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>schedules/setSchedule.php'">
                Add Schedule
            </button>
            <button type="button" class="btn btn-sm px-5 border-bottom border-end border-2">
                Filters
            </button>
        </div>
    </div>


    <div class="card shadow" id="form-card">
        <div class="card-body">
            <h4>List of Schedules</h4>
            <div class="table-responsive">
                <?php
                // Create SQL Query
                $sql = "SELECT `schedule_id`,`project_id`,`project_name` FROM tbl_schedule";

                // Calling to the Connection
                $db = dbConn();

                // Get Result
                $result = $db->query($sql);
                ?>
                <table class="table">
                    <thead class="shadow">
                        <tr>
                            <th scope="col">Schedule ID</th>
                            <th scope="col">Project ID</th>
                            <th scope="col">Project Name</th>
                            <th scope="col">More</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                        ?>
                                <tr class="shadow-sm">
                                    <td class="align-middle"><?= $row['schedule_id']; ?></td>
                                    <td class="align-middle"><?= $row['project_id']; ?></td>
                                    <td class="align-middle"><?= $row['project_name']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='addTask.php?schedule_id=<?= $row['schedule_id']; ?>'">
                                            Create Tasks
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

<?php include '../footer.php'; ?>