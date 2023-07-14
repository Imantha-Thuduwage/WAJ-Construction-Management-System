<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Attendance Reports</h4>
    </div>

    <div class="card shadow" id="form-card">
        <div class="card-body">

            <form method="post" class="form" id="payroll-form">
                <div class="container field p-0">
                    <div class="row justify-content-start gx-5">
                        <div class="col-4">
                            <div class="input-field">
                                <label for="emp_id" class="mb-1">Employee ID</label>
                                <select class="bg-body" id="empId" name="empId">
                                    <option value="" selected disabled hidden>Pick Employee ID</option>

                                    <?php
                                    // Retrieve data from MySQL database
                                    $sql = "SELECT project_id FROM tbl_project";
                                    $db = dbConn();
                                    $result = $db->query($sql);

                                    // Display options in dropdown list
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['project_id'] . "'>" . $row['project_id'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
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
                        <div class="col-4">
                            <div class="input-field">
                                <label for="startDate" class="mb-1">Start Date</label>
                                <input class="bg-body" id="startDate" type="date" name="startDate" value="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-field">
                                <label for="endDate" class="mb-1">End Date</label>
                                <input class="bg-body" id="endDate" type="date" name="endDate" value="">
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-start gx-5">
                        <div class="col-4">
                            <button class="nextBtn" type="button" id="genarate">
                                <span class="btnText">Genarate</span>
                                <i class="uil uil-navigator"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-strips">
                    <thead class="shadow">
                        <tr>
                            <th scope="col">Employee ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">NIC Number</th>
                            <th scope="col">Date</th>
                            <th scope="col">Attendance Type</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="output"></div>
    <button class="nextBtn" type="button" onclick="printSlip('output')">
        <span class="btnText">Print</span>
        <i class="uil uil-navigator"></i>
    </button>
</main>

<script>
    // AJAX request to filter records
    $('#genarate').click(function() {
        $.ajax({
            type: 'POST',
            url: 'genarateAttendanceRep.php',
            method: 'POST',
            data: $('#filter-form').serialize(),
            success: function(response) {
                // Close the modal
                $('#filterModal').modal('hide');

                // Showing data inside HTML Table
                $('#table-body').html(response);

                // Clear Modal FormData
                $("#filter-form")[0].reset();
            }
        });
    });
</script>

<?php include '../footer.php'; ?>