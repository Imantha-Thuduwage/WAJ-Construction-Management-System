<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/form.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Add New User Account</h4>
        <div>
            <button type="button" class="btn btn-sm px-5-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>users/user.php'">
                View Users
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 790px !important;
        }
    </style>

    <div class="card shadow" id="form-card">
        <div class="card-body">

            <form method="post" class="form" id="user-form" action="saveUser.php">
                <div class="container field p-0">
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <h6 class="pt-3 pb-2 mb-0">User Account Details</h6>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-4 ">
                                    <div class="input-field">
                                        <label for="user_name">User Name</label>
                                        <input class="p-3 bg-body" id="userName" type="email" placeholder="Enter User Name" name="userName" value="">
                                        <div class="error-message text-danger" id="error_already"></div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="password">Password for New Account</label>
                                        <input class="p-3 bg-body" id="password" type="text" placeholder="Enter Password" name="password" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <h6 class="pt-3 pb-2 mb-0">Basic User Details</h6>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="first_name">First Name</label>
                                        <select class="bg-body" id="firstName" name="firstName">
                                            <option value="">Pick an Unit</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT employee_id, first_name FROM tbl_employee";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {

                                                    // Step 4: Check if the option value matches the selected value from the database
                                                    $selected = ($row['employee_id'] == $selectedValue) ? 'selected' : '';

                                                    echo "<option value='" . $row['first_name'] . "'" . $selected . ">" . $row['first_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="last_name">Last Name</label>
                                        <select class="bg-body" id="lastName" name="lastName">
                                            <option value="" selected disabled hidden>Last Name</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT employee_id, last_name FROM tbl_employee";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {

                                                    // Step 4: Check if the option value matches the selected value from the database
                                                    $selected = ($row['employee_id'] == $selectedValue) ? 'selected' : '';

                                                    echo "<option value='" . $row['last_name'] . "'" . $selected . ">" . $row['last_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-4">
                                    <div class="input-field">
                                        <label for="user_role">User Role</label>
                                        <select class="bg-body" id="userRole" name="userRole">
                                            <option value="" selected disabled hidden>Pick an Role</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT role_id, user_role FROM tbl_user_role";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {

                                                    // Step 4: Check if the option value matches the selected value from the database
                                                    $selected = ($row['role_id'] == $selectedValue) ? 'selected' : '';

                                                    echo "<option value='" . $row['role_id'] . "'" . $selected . ">" . $row['user_role'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="nextBtn" type="submit" id="submit">
                    <span class="btnText">Save</span>
                    <i class="uil uil-navigator"></i>
                </button>
            </form>
        </div>
    </div>
</main>

<script src="<?= SYSTEM_PATH; ?>assets/js/users/addUser.js"></script>

<?php include '../footer.php'; ?>