<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Get All Task List of Your Project</h4>
        <div>
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>reportPortal/reportPortal.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">
                Back
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 600px !important;
        }
    </style>

    <div class="card shadow" id="form-card">
        <div class="card-body">

            <form method="post" class="form" id="allTask-form" action="getAllTask.php">
                <div class="container field p-0">
                    <div class="row justify-content-center gx-5">
                        <div class="col-sm-6">
                            <h6 class="pt-3 pb-2 mb-0">Select Project ID</h6>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-sm-6">
                            <div class="input-field">
                                <label for="emp_id" class="mb-1">Project ID</label>
                                <select class="bg-body" id="proId" name="proId">
                                    <option value="" selected disabled hidden>Pick Project ID</option>

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
                        <div class="row justify-content-center gx-5">
                            <div class="col-sm-6">
                                <button class="nextBtn" type="button" id="genarate">
                                    <span class="btnText">Go</span>
                                    <i class="uil uil-navigator"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <h4 class="pt-4">All Task Details of Selected Project</h4>
            <div class="table-responsive pt-3">
                <table class="table table-sm">
                    <thead class="shadow">
                        <tr>
                            <th scope="col">Project_ID</th>
                            <th scope="col">Project Name</th>
                            <th scope="col">Project Location</th>
                            <th scope="col">Project Manager</th>
                            <th scope="col">Total Cost</th>
                            <th scope="col">Schedule ID</th>
                            <th scope="col">Schedule ID</th>
                            <th scope="col">Task Name</th>
                            <th scope="col">Starting Date</th>
                            <th scope="col">Ending Date</th>
                            <th scope="col">Current Status</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include '../footer.php'; ?>

<script>
    $(document).ready(function() {
        // AJAX request to filter records
        $('#genarate').click(function() {
            $.ajax({
                type: 'POST',
                url: 'getAllTask.php',
                method: 'POST',
                data: $('#allTask-form').serialize(),
                success: function(response) {

                    // Reset the form fields
                    $('#allTask-form')[0].reset();

                    // Check if response contains error messages
                    if (response.indexOf("error_proId") !== -1) {
                        $("#proId").addClass("error").addClass("option-color-set");
                        $("#proId").change(function() {
                            var selectedValue = $(this).val();
                            if (selectedValue !== "") {
                                $("#proId").removeClass("option-color-set");
                            }
                        });
                    } else {
                        // Showing data inside HTML Table
                        $('#table-body').html(response);

                        // Clear Modal FormData
                        $("#allTask-form")[0].reset();
                    }
                },
                error: function(response) {
                    Swal.fire("Failed", response.error, "error");
                },
            });
        });
    });
</script>