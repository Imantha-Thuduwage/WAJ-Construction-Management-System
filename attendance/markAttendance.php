<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>View Attendance</h4>
        <div>
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>attendance/attendance.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">
                View Attendance
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 710px !important;
        }
    </style>

    <!-- Get user ID for filter data to supervisor dropdown -->
    <?php
    $userId = $_SESSION['userid'];
    ?>

    <div class="card shadow" method="POST" id="form-card" action="saveAttendance.php">
        <div class="card-body">

            <form method="post" class="form" id="attendance-form">
                <div class="container field p-0">
                    <div class="row justify-content-center gx-5">
                        <div class="col-sm-6">
                            <h6 class="pt-3 pb-2 mb-0">Select And Mark Employee Attendance</h6>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-sm-6">
                            <div class="input-field">
                                <label class="mb-1">Employee ID</label>
                                <select class="bg-body" id="empId" name="empId">
                                    <option value="" selected disabled hidden>Pick Employee ID</option>

                                    <?php
                                    // Retrieve data from MySQL database
                                    $sql = "SELECT employee_id FROM tbl_employee WHERE supervisor = '$userId'";
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
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-6">
                            <div class="input-field">
                                <label for="attend_date">Attend Date</label>
                                <input class="p-3 bg-body" id="attendDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="attendDate" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-6">
                            <div class="input-field">
                                <label class="mb-1">Attendance Type</label>
                                <select class="bg-body" id="attendanceType" name="attendanceType">
                                    <option value="" selected disabled hidden>Pick Attendance Type</option>

                                    <?php
                                    // Retrieve data from MySQL database
                                    $sql = "SELECT attendance_type FROM tbl_attendance_type";
                                    $db = dbConn();
                                    $result = $db->query($sql);

                                    // Display options in dropdown list
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['attendance_type'] . "'>" . $row['attendance_type'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
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

<script src="<?= SYSTEM_PATH; ?>assets/js/attendance/markAttendance.js"></script>

<?php include '../footer.php'; ?>