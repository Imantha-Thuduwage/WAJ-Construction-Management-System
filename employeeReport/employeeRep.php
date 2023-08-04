<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Employee Report</h4>
    </div>

    <div class="card shadow" id="form-card">
        <div class="card-body">

            <form method="post" class="form" id="filter-form">
                <div class="container field p-0">
                    <div class="row justify-content-end gx-5">
                        <div class="col-12">
                            <h6 class="pt-3 pb-2 mb-0">Enter Your Details Here</h6>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-4">
                            <div class="input-field">
                                <label>Employee ID</label>
                                <select class="bg-body" id="empId" name="empId">
                                    <option value="" selected disabled hidden>Select Employee ID</option>

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
                        <div class="col-4">
                            <div class="input-field">
                                <label>First Name</label>
                                <select class="bg-body" id="empName" name="empName">
                                    <option value="" selected disabled hidden>Select First Name</option>

                                    <?php
                                    // Retrieve data from MySQL database
                                    $sql = "SELECT `employee_id`, `first_name` FROM tbl_employee";
                                    $result = $db->query($sql);

                                    // Display options in dropdown list
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['first_name'] . "'>" . $row['first_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-field">
                                <label>NIC Number</label>
                                <select class="bg-body" id="nicNum" name="nicNum">
                                    <option value="" selected disabled hidden>Select NIC Number</option>

                                    <?php
                                    // Retrieve data from MySQL database
                                    $sql = "SELECT `employee_id`, `nic_number` FROM tbl_employee";
                                    $result = $db->query($sql);

                                    // Display options in dropdown list
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['nic_number'] . "'>" . $row['nic_number'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-field">
                                <label for="joinedDate">Date of Joined</label>
                                <input class="bg-body" id="joinedDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="joinedDate" value="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-field">
                                <label for="phone_number">Phone Number</label>
                                <input class="bg-body" id="contactNum" type="text" placeholder="Contact Number" name="contactNum" value="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-field">
                                <label for="dob">Date of Birth</label>
                                <input class="bg-body" id="dob" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="dob" value="">
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
                            <th scope="col">Last Name</th>
                            <th scope="col">NIC Number</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">City</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Joined Date</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script>
    // AJAX request to filter records
    $('#genarate').click(function() {
        $.ajax({
            type: 'POST',
            url: 'genarateRep.php',
            method: 'POST',
            data: $('#filter-form').serialize(),
            success: function(response) {

                // Showing data inside HTML Table
                $('#table-body').html(response);

                // Clear Modal FormData
                $("#filter-form")[0].reset();
            }
        });
    });
</script>

<?php include '../footer.php'; ?>