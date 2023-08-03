<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/project.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Here! Your Payroll Portal</h4>
        <div>
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>payroll/genaratePayrollRep.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/plus.png" class="me-2">
                Genarate Payroll
            </button>
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" data-bs-toggle="modal" data-bs-target="#filterModal">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/filter.png" class="me-2">
                Filter
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 630px !important;
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
                                    <label>Payroll ID</label>
                                    <select class="bg-body" id="payrollId" name="payrollId">
                                        <option value="" selected disabled hidden>Select Payroll ID</option>

                                        <?php
                                        // Retrieve data from MySQL database
                                        $sql = "SELECT `payroll_id` FROM tbl_payroll";
                                        $db = dbConn();
                                        $result = $db->query($sql);

                                        // Display options in dropdown list
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['payroll_id'] . "'>" . $row['payroll_id'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-field">
                                    <label>Employee ID</label>
                                    <select class="bg-body" id="empId" name="empId">
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
                                        <label for="month">Month</label>
                                        <input class="p-3 bg-body" id="month" type="text" onfocus="(this.type='month')" placeholder="Pickup Month" name="month" value="">
                                    </div>
                                </div>
                                <!-- <div class="col-6">
                                    <div class="input-field">
                                        <label for="startDate">To</label>
                                        <input class="bg-body" id="endDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="endDate" value="">
                                    </div>
                                </div> -->
                            </div>

                            <!-- <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="payed_cost1">Min Payed Cost</label>
                                        <input class="bg-body" id="minCost" type="Number" placeholder="Total Cost" name="minCost" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="payed_cost2">Max Payed Cost</label>
                                        <input class="bg-body" id="maxCost" type="Number" placeholder="Total Cost" name="maxCost" value="">
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <button type="button" id="btn-filter" class="btn btn-primary">Apply Filter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow" id="form-card">
        <div class="card-body">
            <h4>List of Pay Sheets</h4>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead class="shadow">
                        <tr>
                            <th scope="col">Payroll ID</th>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Month</th>
                            <th scope="col">Net Salary</th>
                            <th scope="col">View</th>
                            <th scope="col">Coin Analysis</th>
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
    // Function to delete selected Record From the Project Table
    function confirmDelete() {
        return confirm("Are you sure you want to delete this record?");
    }

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
                url: 'getFilteredRecords.php',
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

    // Change date picker to select only month 

    document.addEventListener("DOMContentLoaded", function() {
        const monthPickerInput = document.getElementById("month");

        monthPickerInput.addEventListener("change", function() {
            const selectedMonth = monthPickerInput.value;
        });
    });
</script>