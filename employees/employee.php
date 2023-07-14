<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/project.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Here! Your Employees Portal</h4>
        <div>
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>employees/addEmployee.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/plus.png" class="me-2">
                Add Employee
            </button>
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" data-bs-toggle="modal" data-bs-target="#filterModal">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/filter.png" class="me-2">
                Filter
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 550px !important;
        }
    </style>

    <!-- Modal for Popup Filters -->
    <div class="modal fade blur-overlay" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
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
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="joinedDate">Date of Joined</label>
                                        <input class="bg-body" id="joinedDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="joinedDate" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="phone_number">Phone Number</label>
                                        <input class="bg-body" id="contactNum" type="text" placeholder="Contact Number" name="contactNum" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="dob">Date of Birth</label>
                                        <input class="bg-body" id="dob" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="dob" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="btn-filter" class="btn btn-primary">Apply Filter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow" id="form-card">
        <div class="card-body">
            <h4>List of Employees</h4>
            <div class="table-responsive">
                <?php
                // Create SQL Query
                $sql = "SELECT `employee_id`,`first_name`,`last_name`,`nic_number`,`date_of_birth`,`city`,`contact_number`,`date_of_joining` FROM tbl_employee";

                // Calling to the Connection
                $db = dbConn();

                // Get Result
                $result = $db->query($sql);
                ?>
                <table class="table table-sm">
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
                            <th scope="col">More Details</th>
                            <th scope="col">Inactive</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    </tbody>
                </table>
            </div>
        </div>
        <div>
</main>

<?php include '../footer.php'; ?>

<script>
    $(document).ready(function() {
        // AJAX request to get all records initially
        $.ajax({
            url: 'getAllRecords.php',
            method: 'POST',
            data: '',
            success: function(response) {
                $('#table-body').html(response);
            }
        });

        // AJAX request to filter records
        $('#btn-filter').click(function() {
            $.ajax({
                type: 'POST',
                url: 'getFilteredRecord.php',
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
    });

    // Function to delete selected Record From the employee Table
    function confirmDelete(employeeId) {

        // Use SweetAlert2 to show a confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: 'You Are Going to Delete Your Employee',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms and employeeId is defined, proceed with the deletion by navigating to the link
                if (employeeId) {
                    window.location.href = 'inactiveEmployee.php?employee_id=' + employeeId;
                }
            }
        });
    }
</script>