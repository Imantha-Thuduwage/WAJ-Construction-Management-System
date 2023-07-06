<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Add New Employee</h4>
        <div>
            <button type="button" class="btn btn-sm px-5-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>projects/project.php'">
                View Emplyees
            </button>
            <button type="button" class="btn btn-sm px-5 border-bottom border-end border-2">
                Filters
            </button>
        </div>
    </div>


    <div class="card shadow" method="POST" id="form-card" action="saveEmployee.php" enctype="multipart/form-data">
        <div class="card-body">

            <form method="post" class="form" id="employee-form">
                <div class="container field p-0">
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <h6 class="pt-3 pb-2 mb-0">Basic Details</h6>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <label for="title" class="mb-1">Title</label>
                            <div class="form-group mb-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="title" id="title1" value="1" checked>
                                    <label class="form-check-label" for="title1">
                                        Mr
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="title" id="title2" value="2">
                                    <label class="form-check-label" for="title2">
                                        Miss
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="title" id="title3" value="3">
                                    <label class="form-check-label" for="title3">
                                        Mrs
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-start gx-5">
                            <div class="col-sm-10">
                                <div class="row row-cols-2 row-cols-lg-1">

                                    <div class="col-6">
                                        <div class="input-field">
                                            <label for="first_name">First Name</label>
                                            <input class="p-3 bg-body" id="firstName" type="text" placeholder="First Name" name="firstName" value="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-field">
                                            <label for="last_name">Last Name</label>
                                            <input class="p-3 bg-body" id="lastName" type="text" placeholder="Last Name" name="lastName" value="">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-field">
                                            <label for="nic_number">NIC Number</label>
                                            <input class="p-3 bg-body" id="nicNumber" type="text" placeholder="NIC Number" name="nicNumber" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-start gx-5">
                            <div class="col-sm">
                                <div class="row row-cols-2 row-cols-lg-1">
                                    <div class="col-4">
                                        <label for="gender" class="mb-1">Gender</label>
                                        <div class="form-group mb-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="gender1" value="1" checked>
                                                <label class="form-check-label" for="gender1">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="gender2" value="2">
                                                <label class="form-check-label" for="gender2">
                                                    Female
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="gender3" value="3">
                                                <label class="form-check-label" for="gender3">
                                                    Other
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-field">
                                            <label for="date_birth">Date of Birth</label>
                                            <input class="p-3 bg-body" id="dob" type="text" onfocus="(this.type='date')" placeholder="Date of Birth" name="dob" value="">
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
                                            <input class="p-3 bg-body" id="street1" type="text" placeholder="Street Line 01" name="street1" value="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-field">
                                            <label for="street_line2">Address -> Street Line 02(Optional)</label>
                                            <input class="p-3 bg-body" id="street2" type="text" placeholder="Street Line 02" name="street2" value="">
                                        </div>
                                    </div>
                                    <div class="col-4 ">
                                        <div class="input-field">
                                            <label for="street_line2">City</label>
                                            <input class="p-3 bg-body" id="city" type="text" placeholder="City" name="city" value="">
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
                                            <input class="p-3 bg-body" id="phoneNum" type="number" placeholder="Phone Number" name="phoneNum" value="">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-field">
                                            <label for="date_birth">Joined Date</label>
                                            <input class="p-3 bg-body" id="joinDate" type="text" onfocus="(this.type='date')" placeholder="Joined Date" name="joinDate" value="">
                                        </div>
                                    </div>
                                    <div class="col-4 ">
                                        <div class="input-field">
                                            <label for="basic_salary">Basic Salary</label>
                                            <input class="p-3 bg-body" id="basicSal" type="number" placeholder="Basic Salary" name="basicSal" value="">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="input-field">
                                            <label for="formFile">Upload Profile Image</label>
                                            <input class="p-3 bg-body" type="file" id="profileImg" name="profileImg">
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

<script src="<?= SYSTEM_PATH; ?>assets/js/employees/addEmployee.js"></script>

<?php include '../footer.php'; ?>