<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Income Reports</h4>
    </div>

    <div class="card shadow" id="form-card">
        <div class="card-body">

            <form method="post" class="form" id="income-form" action="createReport.php">
                <div class="container field p-0">
                    <div class="row justify-content-center gx-5">
                        <div class="col-sm-6">
                            <h6 class="pt-3 pb-2 mb-0">Enter Your Details Here</h6>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-sm-6">
                            <div class="input-field">
                                <label for="emp_id" class="mb-1">Project ID</label>
                                <select class="bg-body" id="proIdId" name="proIdId">
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
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-3">
                            <div class="input-field">
                                <label>Start Date</label>
                                <input class="p-3 bg-body" id="startDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="startDate" value="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-field">
                                <label>End Date</label>
                                <input class="p-3 bg-body" id="endDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="endDate" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-6">
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
                            <th scope="col">Project ID</th>
                            <th scope="col">Project Name</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Total Cost(Rs)</th>
                            <th scope="col">Total Income</th>
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
            url: 'genarateIncomeReport.php',
            method: 'POST',
            data: $('#income-form').serialize(),
            success: function(response) {

                // Showing data inside HTML Table
                $('#table-body').html(response);

                // Clear Modal FormData
                $("#income-form")[0].reset();
            }
        });
    });
</script>

<?php include '../footer.php'; ?>