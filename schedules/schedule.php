<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/project.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Here! Your Schedule Portal</h4>
        <div>
            <!-- Link to add project form -->
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>schedules/setSchedule.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/plus.png" class="me-2">
                Set Schedule
            </button>

            <!-- Open filter modal when click on this button -->
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" data-bs-toggle="modal" data-bs-target="#filterModal">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/filter.png" class="me-2">
                Filter
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 510px !important;
        }
    </style>

    <!-- Modal for Popup Filters -->
    <!-- <div class="modal fade blur-overlay" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="filter-form">
                        <div class="row row-cols-2 row-cols-lg-1">
                            <div class="col-4">
                                <div class="input-field">
                                    <label>Salary ID</label>
                                    <select class="bg-body" id="salaryId" name="salaryId">
                                        <option value="" selected disabled hidden>Select Salary ID</option>

                                        <?php
                                        // Retrieve data from MySQL database
                                        $sql = "SELECT `salary_id` FROM tbl_salary";
                                        $db = dbConn();
                                        $result = $db->query($sql);

                                        // Display options in dropdown list
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['salary_id'] . "'>" . $row['salary_id'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-field">
                                    <label>Employee ID</label>
                                    <select class="bg-body" id="employeeId" name="employeeId">
                                        <option value="" selected disabled hidden>Select Employee Name</option>

                                        <?php
                                        // Retrieve data from MySQL database
                                        $sql = "SELECT `employee_id` FROM tbl_employee";
                                        $db = dbConn();
                                        $result = $db->query($sql);

                                        // Display options in dropdown list
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['employee_id'] . "'>" . $row['employee_id'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="basic_sal1">Min Basic Salary</label>
                                        <input class="bg-body" id="minCost" type="Number" placeholder="Min Basic Salary" name="minCost" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="basic_sal2">Max Basic Salary</label>
                                        <input class="bg-body" id="maxCost" type="Number" placeholder="Max Basic Salary" name="maxCost" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="btn-filter" class="btn btn-primary">Apply Filter</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->

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
                <table class="table table-sm">
                    <thead class="shadow">
                        <tr>
                            <th scope="col">Schedule ID</th>
                            <th scope="col">Project ID</th>
                            <th scope="col">Project Name</th>
                            <th scope="col">Tasks</th>
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
                                    <td>
                                        <button type="button" class="btn btn-outline-info btn-sm" onclick="document.location='viewTask.php?schedule_id=<?= $row['schedule_id']; ?>'">
                                            View Tasks
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