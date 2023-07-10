<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Update With New Details</h4>
        <div>
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>employees/employee.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">
                View Employees
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 600px !important;
        }

        #form-card {
            margin-top: 45px;
        }
    </style>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        extract($_GET);

        $sql = "SELECT * FROM tbl_employee WHERE employee_id='$employee_id'";
        $db = dbConn();
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $empId = $row['employee_id'];
        $title = $row['title'];
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $nicNumber = $row['nic_number'];
        $dob = $row['date_of_birth'];
        $gender = $row['gender'];
        $street1 = $row['street_line_one'];
        $street2 = $row['street_line_two'];
        $city = $row['city'];
        $phoneNum = $row['contact_number'];
        $joinDate = $row['date_of_joining'];
        $basicSal = $row['basic_salary'];
        $profileImg = $row['profile_image'];
    }
    ?>

    <div class="card shadow" method="POST" id="form-card" action="saveEmployee.php" enctype="multipart/form-data">
        <div class="card-body">

            <form method="post" class="form" id="employee-form">
                <div class="container field p-0">
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm-5">
                            <div class="card id-section d-flex align-items-start border-0">
                                <div class="card-body mb-2 p-2" style="display: flex; justify-content: center; align-items: center;">
                                    <img class="img-fluid rounded-circle" src="<?= SYSTEM_PATH; ?>assets/images/profileImages/<?= !empty($profileImg) ? $profileImg : 'myProfile.png' ?>" style="width: 300px; height: 300px;">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="row row-cols-2 row-cols-lg-1 g-2 g-lg-3">
                                <div class="col-sm-6">
                                    <label for="title" class="mb-1">Title</label>
                                    <div class="form-group mb-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="title" id="title1" value="1" <?php if ($title == '1') echo "checked"; ?>>
                                            <label class="form-check-label" for="title1">
                                                Mr
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="title" id="title2" value="2" <?php if ($title == '2') echo "checked"; ?>>
                                            <label class="form-check-label" for="title2">
                                                Miss
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="title" id="title3" value="3" <?php if ($title == '3') echo "checked"; ?>>
                                            <label class="form-check-label" for="title3">
                                                Mrs
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="row row-cols-2 row-cols-lg-1">
                                        <div class="col-6">
                                            <div class="input-field">
                                                <label for="first_name">First Name</label>
                                                <input class="p-3 bg-body" id="firstName" type="text" placeholder="First Name" name="firstName" value="<?php echo @$firstName; ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-field">
                                                <label for="last_name">Last Name</label>
                                                <input class="p-3 bg-body" id="lastName" type="text" placeholder="Last Name" name="lastName" value="<?php echo @$lastName; ?>">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-field">
                                                <label for="nic_number">NIC Number</label>
                                                <input class="p-3 bg-body" id="nicNumber" type="text" placeholder="NIC Number" name="nicNumber" value="<?php echo @$nicNumber; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input class="p-3 bg-body" type="hidden" name="empId" value="<?php echo @$empId; ?>">
                    <div class="row justify-content-start gx-5">

                        <div class="row justify-content-start gx-5">
                            <div class="col-sm">
                                <div class="row row-cols-2 row-cols-lg-1">
                                    <div class="col-4">
                                        <label for="gender" class="mb-1">Gender</label>
                                        <div class="form-group mb-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="gender1" value="1" <?php if ($gender == '1') echo "checked"; ?>>
                                                <label class="form-check-label" for="gender1">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="gender2" value="2" <?php if ($gender == '2') echo "checked"; ?>>
                                                <label class="form-check-label" for="gender2">
                                                    Female
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="gender3" value="3" <?php if ($gender == '3') echo "checked"; ?>>
                                                <label class="form-check-label" for="gender3">
                                                    Other
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-field">
                                            <label for="date_birth">Date of Birth</label>
                                            <input class="p-3 bg-body" id="dob" type="text" onfocus="(this.type='date')" placeholder="Date of Birth" name="dob" value="<?php echo @$dob; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-start gx-5">
                            <div class="col-sm">
                                <div class="row row-cols-2 row-cols-lg-1">
                                    <div class="col-6">
                                        <div class="input-field">
                                            <label for="street_line1">Address -> Street Line 01</label>
                                            <input class="p-3 bg-body" id="street1" type="text" placeholder="Street Line 01" name="street1" value="<?php echo @$street1; ?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-field">
                                            <label for="street_line2">Address -> Street Line 02(Optional)</label>
                                            <input class="p-3 bg-body" id="street2" type="text" placeholder="Street Line 02" name="street2" value="<?php echo @$street2; ?>">
                                        </div>
                                    </div>
                                    <div class="col-4 ">
                                        <div class="input-field">
                                            <label for="street_line2">City</label>
                                            <input class="p-3 bg-body" id="city" type="text" placeholder="City" name="city" value="<?php echo @$city; ?>">
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
                                            <label for="mobile_number">Phone Number</label>
                                            <input class="p-3 bg-body" id="phoneNum" type="number" placeholder="Phone Number" name="phoneNum" value="<?php echo @$phoneNum; ?>">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-field">
                                            <label for="date_birth">Joined Date</label>
                                            <input class="p-3 bg-body" id="joinDate" type="text" onfocus="(this.type='date')" placeholder="Joined Date" name="joinDate" value="<?php echo @$joinDate; ?>">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="input-field">
                                            <label for="formFile">Upload Profile Image</label>
                                            <input class="p-3 bg-body" type="file" id="profileImg" name="profileImg">
                                            <!-- Set prvious image value to save DB when user is not update new image -->
                                            <input type="hidden" name="sameProfileImg" value="<?php echo @$profileImg; ?>">
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

<script src="<?= SYSTEM_PATH; ?>assets/js/employees/editEmployee.js"></script>

<?php include '../footer.php'; ?>