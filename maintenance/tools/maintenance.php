<?php include '../../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/project.css">
<?php include '../../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Here! Your Maintenance Portal</h4>
        <div>
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>maintenance/tools/addMaintenance.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/plus.png" class="me-2">
                Add Maintenance
            </button>
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" data-bs-toggle="modal" data-bs-target="#filterModal">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/filter.png" class="me-2">
                Filter
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 540px !important;
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
                                    <label>Maintenance ID</label>
                                    <select class="bg-body" id="maintenanceId" name="maintenanceId">
                                        <option value="" selected disabled hidden>Select Maintenance ID</option>

                                        <?php
                                        // Retrieve data from MySQL database
                                        $sql = "SELECT `maintenance_id` FROM tbl_tool_maintenance";
                                        $db = dbConn();
                                        $result = $db->query($sql);

                                        // Display options in dropdown list
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['maintenance_id'] . "'>" . $row['maintenance_id'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-field">
                                    <label>Tool ID</label>
                                    <select class="bg-body" id="toolId" name="toolId">
                                        <option value="" selected disabled hidden>Select Tool ID </option>

                                        <?php
                                        // Retrieve data from MySQL database
                                        $sql = "SELECT `tool_id` FROM tbl_tool";
                                        $db = dbConn();
                                        $result = $db->query($sql);

                                        // Display options in dropdown list
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['tool_id'] . "'> " . $row['tool_id'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-6">
                                    <div class="input-field">
                                        <label>From</label>
                                        <input class="bg-body" id="startDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="startDate" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-field">
                                        <label>To</label>
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
            <h4>List of Maintenance</h4>
            <div class="table-responsive">
                <?php
                // Create SQL Query
                $sql = "SELECT `maintenance_id`, `tool_id`,`maintenance_date` FROM tbl_tool_maintenance";

                // Calling to the Connection
                $db = dbConn();

                // Get Result
                $result = $db->query($sql);
                ?>
                <table class="table table-sm">
                    <thead class="shadow">
                        <tr>
                            <th scope="col">Maintenance ID</th>
                            <th scope="col">Tool ID</th>
                            <th scope="col">Maintained Date</th>
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

<?php include '../../footer.php'; ?>

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

    // Function to delete selected Record 
    function confirmDelete(maintenanceId) {

        // Use SweetAlert2 to show a confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: 'You Are Going to Delete Your Record',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms and maintenanceId is defined, proceed with the deletion by navigating to the link
                if (maintenanceId) {
                    window.location.href = 'deleteMaintenance.php?maintenance_id=' + maintenanceId;
                }
            }
        });
    }
</script>