<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/project.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Here! Your Projects Portal</h4>
        <div>
            <!-- Link to add project form -->
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>projects/addProject.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/plus.png" class="me-2">
                Add Project
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
            padding-right: 535px !important;
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
                                    <label>Project ID</label>
                                    <select class="bg-body" id="proId" name="proId">
                                        <option value="" selected disabled hidden>Select Project ID</option>

                                        <?php
                                        // Retrieve data from MySQL database
                                        $sql = "SELECT `project_id` FROM tbl_project";
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
                                    <label>Project Name</label>
                                    <select class="bg-body" id="proName" name="proName">
                                        <option value="" selected disabled hidden>Select Project Name</option>

                                        <?php
                                        // Retrieve data from MySQL database
                                        $sql = "SELECT `project_id`, `project_name` FROM tbl_project";
                                        $db = dbConn();
                                        $result = $db->query($sql);

                                        // Display options in dropdown list
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['project_name'] . "'>" . $row['project_name'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-field">
                                    <label for="project_manager">Project Manager</label>
                                    <select class="bg-body" id="proManager" name="proManager">
                                        <option value="" selected disabled hidden>Select Project Manager</option>

                                        <?php
                                        // Retrieve data from MySQL database
                                        $sql = "SELECT u.`user_id`,u.`last_name`,r.`role_id`,r.`user_role` 
                                            FROM tbl_user AS u INNER JOIN tbl_user_role AS r ON u.`role_id` = r.`role_id` WHERE `user_role` = 'Project_Manager'";
                                        $db = dbConn();
                                        $result = $db->query($sql);

                                        // Display options in dropdown list
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['user_id'] . "'>" . $row['last_name'] . "</option>";
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
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="total_cost">Min Total Cost</label>
                                        <input class="bg-body" id="minCost" type="Number" placeholder="Total Cost" name="minCost" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="total_cost">Max Total Cost</label>
                                        <input class="bg-body" id="maxCost" type="Number" placeholder="Total Cost" name="maxCost" value="">
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
            <h4>List of Projects</h4>
            <div class="table-responsive">
                <?php
                // Create SQL Query
                $sql = "SELECT `project_id`,`project_name`,`p_location`,`start_date`,`end_date`,`project_manager`,`total_cost` FROM tbl_project";

                // Calling to the Connection
                $db = dbConn();

                // Get Result
                $result = $db->query($sql);
                ?>
                <table class="table table-sm">
                    <thead class="shadow">
                        <tr>
                            <th scope="col">Project ID</th>
                            <th scope="col">Project Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Starting Date</th>
                            <th scope="col">Ending Date</th>
                            <th scope="col">Project Manager</th>
                            <th scope="col">Total Cost (Rs)</th>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
                url: 'projectFilter.php',
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

    // Function to delete selected Record From the Project Table
    function confirmDelete(event) {
        event.preventDefault(); // Prevent the default link behavior

        // Retrieve the project ID from the href attribute
        var projectID = event.currentTarget.getAttribute('href').match(/project_id=(\d+)/)[1];

        // Use SweetAlert2 to show a confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: 'You Are Going to Delete Your Project',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms and projectID is defined, proceed with the deletion by navigating to the link
                if (projectID) {
                    window.location.href = 'deleteProject.php?project_id=' + projectID;
                }
            }
        });
    }
</script>