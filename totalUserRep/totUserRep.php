<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>User Reports</h4>
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
                                <label>User ID</label>
                                <select class="bg-body" id="userId" name="userId">
                                    <option value="" selected disabled hidden>Select User ID</option>

                                    <?php
                                    // Retrieve data from MySQL database
                                    $sql = "SELECT `user_id` FROM tbl_user WHERE `status` = 1";
                                    $db = dbConn();
                                    $result = $db->query($sql);

                                    // Display options in dropdown list
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['user_id'] . "'>" . $row['user_id'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-field">
                                <label>User Name</label>
                                <select class="bg-body" id="userName" name="userName">
                                    <option value="" selected disabled hidden>Select User Name</option>

                                    <?php
                                    // Retrieve data from MySQL database
                                    $sql = "SELECT `user_id`, `user_name` FROM tbl_user";
                                    $db = dbConn();
                                    $result = $db->query($sql);

                                    // Display options in dropdown list
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['user_name'] . "'>" . $row['user_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-field">
                                <label>Fisrt Name</label>
                                <select class="bg-body" id="firstName" name="firstName">
                                    <option value="" selected disabled hidden>Select First Name</option>

                                    <?php
                                    // Retrieve data from MySQL database
                                    $sql = "SELECT `user_id`, `first_name` FROM tbl_user";
                                    $db = dbConn();
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
                                <label>Last Name</label>
                                <select class="bg-body" id="lastName" name="lastName">
                                    <option value="" selected disabled hidden>Select Last Name</option>

                                    <?php
                                    // Retrieve data from MySQL database
                                    $sql = "SELECT `user_id`, `last_name` FROM tbl_user";
                                    $db = dbConn();
                                    $result = $db->query($sql);

                                    // Display options in dropdown list
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['last_name'] . "'>" . $row['last_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-field">
                                <label>User Role</label>
                                <select class="bg-body" id="userRole" name="userRole">
                                    <option value="" selected disabled hidden>Select Project Manager</option>

                                    <?php
                                    // Retrieve data from MySQL database
                                    $sql = "SELECT `role_id`, `user_role` FROM tbl_user_role";
                                    $db = dbConn();
                                    $result = $db->query($sql);

                                    // Display options in dropdown list
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['role_id'] . "'>" . $row['user_role'] . "</option>";
                                        }
                                    }
                                    ?>

                                </select>
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
                            <th scope="col">User ID</th>
                            <th scope="col">User Name</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">User Role</th>
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