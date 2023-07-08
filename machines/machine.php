<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/project.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Manage Machines</h4>
        <div>
            <button type="button" class="btn btn-sm px-5 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>machines/addMachine.php'">
                Add Machine
            </button>
            <button type="button" class="btn btn-sm px-5 border-bottom border-end border-2" data-bs-toggle="modal" data-bs-target="#filterModal">
                Filter
            </button>
        </div>
    </div>

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
                                    <label>Machine ID</label>
                                    <select class="bg-body" id="machineId" name="machineId">
                                        <option value="" selected disabled hidden>Select Machine ID</option>

                                        <?php
                                        // Retrieve data from MySQL database
                                        $sql = "SELECT `machine_id` FROM tbl_machine";
                                        $db = dbConn();
                                        $result = $db->query($sql);

                                        // Display options in dropdown list
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['machine_id'] . "'>" . $row['machine_id'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-field">
                                    <label>Machine Name</label>
                                    <select class="bg-body" id="machineName" name="machineName">
                                        <option value="" selected disabled hidden>Select Machine Name</option>

                                        <?php
                                        // Retrieve data from MySQL database
                                        $sql = "SELECT `machine_id`, `machine_name` FROM tbl_machine";
                                        $db = dbConn();
                                        $result = $db->query($sql);

                                        // Display options in dropdown list
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['machine_name'] . "'>" . $row['machine_name'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-field">
                                    <label>Serial Number</label>
                                    <select class="bg-body" id="serialNumber" name="serialNumber">
                                        <option value="" selected disabled hidden>Select Serial Name</option>

                                        <?php
                                        // Retrieve data from MySQL database
                                        $sql = "SELECT `machine_id`, `serial_number` FROM tbl_machine";
                                        $db = dbConn();
                                        $result = $db->query($sql);

                                        // Display options in dropdown list
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['serial_number'] . "'>" . $row['serial_number'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-field">
                                    <label for="payed_method">Condition</label>
                                    <select class="bg-body" id="condition" name="condition">
                                        <option value="" selected disabled hidden>Select Condition </option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT `condition_id`, `condition_name` FROM tbl_resource_condition";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['condition_name'] . "'>" . $row['condition_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-field">
                                    <label for="payed_method">Fuel Type</label>
                                    <select class="bg-body" id="fuelType" name="fuelType">
                                        <option value="" selected disabled hidden>Select Fuel Type </option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT `fuel_id`, `fuel_name` FROM tbl_fuel_type";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['fuel_name'] . "'>" . $row['fuel_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-field">
                                    <label for="payed_method">Brand</label>
                                    <select class="bg-body" id="brand" name="brand">
                                        <option value="" selected disabled hidden>Select Brand </option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT `machine_id`, `brand` FROM tbl_machine";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['brand'] . "'>" . $row['brand'] . "</option>";
                                                }
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="startDate">From</label>
                                        <input class="bg-body" id="startDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="startDate" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="startDate">To</label>
                                        <input class="bg-body" id="endDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="endDate" value="">
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
            <h4>List of Machines</h4>
            <div class="table-responsive">
                <?php
                // Create SQL Query
                $sql = "SELECT `machine_id`,`machine_name`,`serial_number`,
                `purchase_date`,`condition`,`fuel_type`,`brand` FROM tbl_machine";

                // Calling to the Connection
                $db = dbConn();

                // Get Result
                $result = $db->query($sql);
                ?>
                <table class="table table-sm">
                    <thead class="shadow">
                        <tr>
                            <th scope="col">Machine ID</th>
                            <th scope="col">Machine Name</th>
                            <th scope="col">Serial Number</th>
                            <th scope="col">Purchase Date</th>
                            <th scope="col">Condition</th>
                            <th scope="col">Fuel Type</th>
                            <th scope="col">Brand</th>
                            <th scope="col">More Details</th>
                            <th scope="col">Remove</th>
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
</script>