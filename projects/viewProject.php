<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/view.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Add New Project</h4>
        <div>
            <button type="button" class="btn btn-sm px-5 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>projects/project.php'">
                View Projects
            </button>
            <button type="button" class="btn btn-sm px-5 border-bottom border-end border-2">
                Filters
            </button>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        extract($_GET);

        $sql = "SELECT * FROM tbl_project WHERE project_id='$project_id'";
        $db = dbConn();
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $pId = $row['project_id'];
        $pName = $row['project_name'];
        $pLocation = $row['p_location'];
        $startDate = $row['start_date'];
        $endDate = $row['end_date'];
        $proManager = $row['project_manager'];
        $abcStatus = $row['abc_status'];
        $abcUnit = $row['abc_unit'];
        $abcQuantity = $row['abc_quantity'];
        $abcRate = $row['abc_rate'];
        $primeStatus = $row['prime_status'];
        $primeUnit = $row['prime_unit'];
        $primeQuantity = $row['prime_quantity'];
        $primeRate = $row['prime_rate'];
        $tackUnit = $row['tack_unit'];
        $tackQuantity = $row['tack_quantity'];
        $tackStatus = $row['tack_status'];
        $tackRate = $row['tack_rate'];
        $asphaltStatus = $row['asphalt_status'];
        $asphaltThicknes = $row['asphalt_thickness'];
        $asphaltUnit = $row['asphalt_unit'];
        $asphaltQuantity = $row['asphalt_quantity'];
        $asphaltRate = $row['asphalt_rate'];
        $markingStatus = $row['marking_status'];
        $bridges = $row['bridges_count'];
        $pCost = $row['total_cost'];
    }

    // SQL Functioin for get data to showing project progress using Chart
    $sql = "SELECT COUNT(*) as total_tasks FROM tbl_schedule_task WHERE project_id = $project_id";
    $db = dbConn();
    $result = $db->query($sql);
    $row_total_tasks = $result->fetch_assoc(); // Fetch the result and assign it to $row_total_tasks
    $total_tasks = $row_total_tasks['total_tasks'];

    $sql = "SELECT COUNT(*) as completed_tasks FROM tbl_schedule_task WHERE project_id = $project_id AND current_status = 4";
    $db = dbConn();
    $result = $db->query($sql);
    $row_completed_tasks = $result->fetch_assoc(); // Fetch the result and assign it to $row_completed_tasks
    $completed_tasks = $row_completed_tasks['completed_tasks'];

    // Calculate the progress percentage
    $progress = ($total_tasks > 0) ? (($completed_tasks / $total_tasks) * 100) : 0;

    // Pass the progress value to JavaScript
    echo '<script>const projectProgress = ' . $progress . ';</script>';

    ?>

    <div class="card shadow" id="form-card">
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-start mb-4" style="background-color:rgb(0 33 88);">
                    <div class="col-sm">
                        <h4 class="pt-3 text-center" style="color: white;">Project Details of <?php echo $pName?></h4>
                    </div>
                </div>
                <div class="row justify-content-start gx-5">
                    <div class="col-sm-6">
                        <div class="border bg-light">
                            <div class="card id-section text-center">
                                <div class="card-body" style=" display: flex; justify-content: center; align-items: center;">
                                    <div class="p-1 border border-0">
                                        <canvas id="progress-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="row row-cols-2 row-cols-lg-1 g-2 g-lg-3">
                            <div class="col-6 ">
                                <div class="p-1 border bg-light display-data">
                                    <label>Project name</label>
                                    <p><?php echo $pName; ?></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-1 border bg-light display-data">
                                    <label>Total Cost(Rs).</label>
                                    <p><?php echo $pCost; ?></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-1 border bg-light display-data">
                                    <label>Starting Date</label>
                                    <p><?php echo $startDate; ?></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-1 border bg-light display-data">
                                    <label>Ending Date</label>
                                    <p><?php echo $endDate; ?></p>
                                </div>
                            </div>
                            <div class="col-12 pt-3">
                                <div class="p-1 border bg-light display-data"><label>Project Manager</label>
                                    <?php
                                    // Retrieve data from MySQL database
                                    $sql = "SELECT u.`user_id`,u.`full_name`,r.`role_id`,r.`user_role` 
                                    FROM tbl_user AS u INNER JOIN tbl_user_role AS r ON u.`role_id` = r.`role_id` WHERE `user_id` = $proManager";
                                    $result = $db->query($sql);
                                    ?>
                                    <p><?php if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            echo  $row['full_name'];
                                        } ?></p>
                                </div>
                            </div>
                            <div class="col-12 pt-3">
                                <div class="p-1 border bg-light display-data"><label>Location</label>
                                    <p><?php echo $pLocation; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-start gx-5">
                    <div class="col-sm">
                        <h5 class="pt-3">ABC Details</h5>
                    </div>
                </div>
                <div class="row justify-content-start gx-5">
                    <div class="col-sm">
                        <div class="row row-cols-2 row-cols-lg-1 g-2 g-lg-3">
                            <div class="col-4">
                                <div class="p-1 border bg-light display-data">
                                    <label>ABC Status</label>
                                    <p><?php
                                        if ($abcStatus == '1') {
                                            echo "Yes";
                                        } else {
                                            echo "No";
                                        }
                                        ?></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <?php
                                if (empty($abcUnit)) {
                                    $abcUnitEmpty = "empty-value";
                                } else {
                                    $abcUnitEmpty = "";
                                }
                                ?>
                                <div class="p-1 border bg-light display-data <?php echo $abcUnitEmpty; ?>">
                                    <label>Unit</label>
                                    <?php
                                    if (!empty($abcUnit)) {
                                        // Retrieve data from MySQL database
                                        $sql = "SELECT unit_id,unit_short_name FROM tbl_measurement_unit WHERE unit_id = $abcUnit";
                                        $result = $db->query($sql);
                                    ?>
                                        <!-- Display Selected Option's Text Name -->
                                        <p>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            echo  $row['unit_short_name'];
                                        }
                                    }
                                        ?>
                                        </p>
                                </div>
                            </div>
                            <div class="col-4">
                                <?php
                                if (empty($abcQuantity)) {
                                    $abcQuaEmpty = "empty-value";
                                }
                                ?>
                                <div class="p-1 border bg-light display-data <?php echo $abcQuaEmpty; ?>">
                                    <label>Quantity</label>
                                    <p><?php echo $abcQuantity; ?></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <?php
                                if (empty($abcRate)) {
                                    $abcRateEmpty = "empty-value";
                                }
                                ?>
                                <div class="p-1 border bg-light display-data <?php echo $abcRateEmpty; ?>">
                                    <label>Rate</label>
                                    <p><?php echo $abcRate; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-start gx-5">
                    <div class="col-sm">
                        <h5 class="pt-3">Prime Coat Details</h5>
                    </div>
                </div>
                <div class="row justify-content-start gx-5">
                    <div class="col-sm">
                        <div class="row row-cols-2 row-cols-lg-1 g-2 g-lg-3">
                            <div class="col-4">
                                <div class="p-1 border bg-light display-data">
                                    <label>Prime Coat Status</label>
                                    <p><?php
                                        if ($primeStatus == '1') {
                                            echo "Yes";
                                        } else {
                                            echo "No";
                                        }
                                        ?></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <?php
                                if (empty($primeUnit)) {
                                    $primeUnitEmpty = "empty-value";
                                }
                                ?>
                                <div class="p-1 border bg-light display-data <?php echo $primeUnitEmpty; ?>">
                                    <label>Unit</label>
                                    <?php
                                    if (!empty($primeUnit)) {
                                        // Retrieve data from MySQL database
                                        $sql = "SELECT unit_id,unit_short_name FROM tbl_measurement_unit WHERE unit_id = $primeUnit";
                                        $result = $db->query($sql);
                                    ?>
                                        <!-- Display Selected Option's Text Name -->
                                        <p>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            echo  $row['unit_short_name'];
                                        }
                                    }
                                        ?>
                                        </p>
                                </div>
                            </div>
                            <div class="col-4">
                                <?php
                                if (empty($primeQuantity)) {
                                    $primeQaEmpty = "empty-value";
                                }
                                ?>
                                <div class="p-1 border bg-light display-data <?php echo $primeQaEmpty; ?>">
                                    <label>Quantity</label>
                                    <p><?php echo $primeQuantity; ?></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <?php
                                if (empty($primeRate)) {
                                    $primeRateEmpty = "empty-value";
                                }
                                ?>
                                <div class="p-1 border bg-light display-data <?php echo $primeRateEmpty; ?>">
                                    <label>Rate</label>
                                    <p><?php echo $primeRate; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-start gx-5">
                    <div class="col-sm">
                        <h5 class="pt-3">Tack Coat Details</h5>
                    </div>
                </div>
                <div class="row justify-content-start gx-5">
                    <div class="col-sm">
                        <div class="row row-cols-2 row-cols-lg-1 g-2 g-lg-3">
                            <div class="col-4">
                                <div class="p-1 border bg-light display-data">
                                    <label>Tack Coat Status</label>
                                    <p><?php
                                        if ($tackStatus == '1') {
                                            echo "Yes";
                                        } else {
                                            echo "No";
                                        }
                                        ?></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <?php
                                if (empty($tackUnit)) {
                                    $tackUnitEmpty = "empty-value";
                                }
                                ?>
                                <div class="p-1 border bg-light display-data <?php echo $tackUnitEmpty; ?>">
                                    <label>Unit</label>
                                    <?php
                                    if (!empty($tackUnit)) {
                                        // Retrieve data from MySQL database
                                        $sql = "SELECT unit_id,unit_short_name FROM tbl_measurement_unit WHERE unit_id = $tackUnit";
                                        $result = $db->query($sql);
                                    ?>
                                        <!-- Display Selected Option's Text Name -->
                                        <p>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            echo  $row['unit_short_name'];
                                        }
                                    }
                                        ?>
                                        </p>
                                </div>
                            </div>
                            <div class="col-4">
                                <?php
                                if (empty($tackQuantity)) {
                                    $tackQuaEmpty = "empty-value";
                                }
                                ?>
                                <div class="p-1 border bg-light display-data <?php echo $tackQuaEmpty; ?>">
                                    <label>Quantity</label>
                                    <p><?php echo $tackQuantity; ?></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <?php
                                if (empty($tackRate)) {
                                    $tackRateEmpty = "empty-value";
                                }
                                ?>
                                <div class="p-1 border bg-light display-data <?php echo $tackRateEmpty; ?>">
                                    <label>Rate</label>
                                    <p><?php echo $tackRate; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-start gx-5">
                    <div class="col-sm">
                        <h5 class="pt-3">Asphalt Details</h5>
                    </div>
                </div>
                <div class="row justify-content-start gx-5">
                    <div class="col-sm">
                        <div class="row row-cols-2 row-cols-lg-1 g-2 g-lg-3">
                            <div class="col-4">
                                <div class="p-1 border bg-light display-data">
                                    <label>Asphalt Status</label>
                                    <p><?php
                                        if ($asphaltStatus == '1') {
                                            echo "Yes";
                                        } else {
                                            echo "No";
                                        }
                                        ?></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <?php
                                if (empty($asphaltThicknes)) {
                                    $aspthickEmpty = "empty-value";
                                }
                                ?>
                                <div class="p-1 border bg-light display-data <?php echo $aspthickEmpty; ?>">
                                    <label>Thicknes</label>
                                    <p><?php echo $asphaltThicknes; ?></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <?php
                                if (empty($asphaltUnit)) {
                                    $aspUnitEmpty = "empty-value";
                                }
                                ?>
                                <div class="p-1 border bg-light display-data <?php echo $aspUnitEmpty; ?>">
                                    <label>Unit</label>
                                    <?php
                                    if (!empty($asphaltUnit)) {
                                        // Retrieve data from MySQL database
                                        $sql = "SELECT unit_id,unit_short_name FROM tbl_measurement_unit WHERE unit_id = $asphaltUnit";
                                        $result = $db->query($sql);
                                    ?>
                                        <!-- Display Selected Option's Text Name -->
                                        <p>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            echo  $row['unit_short_name'];
                                        }
                                    }
                                        ?>
                                        </p>
                                </div>
                            </div>
                            <div class="col-4">
                                <?php
                                if (empty($asphaltRate)) {
                                    $aspRateEmpty = "empty-value";
                                }
                                ?>
                                <div class="p-1 border bg-light display-data <?php echo $aspRateEmpty; ?>">
                                    <label>Quantity</label>
                                    <p><?php echo $primeRate; ?></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <?php
                                if (empty($asphaltRate)) {
                                    $aspRateEmpty = "empty-value";
                                }
                                ?>
                                <div class="p-1 border bg-light display-data <?php echo $aspRateEmpty; ?>">
                                    <label>Rate</label>
                                    <p><?php echo $primeRate; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-start gx-5">
                    <div class="col-sm">
                        <h5 class="pt-3">Other Details</h5>
                    </div>
                </div>
                <div class="row justify-content-start gx-5">
                    <div class="col-sm">
                        <div class="row row-cols-2 row-cols-lg-1 g-2 g-lg-3">
                            <div class="col-4">
                                <div class="p-1 border bg-light display-data">
                                    <label>Road Marking</label>
                                    <p><?php
                                        if ($markingStatus == '1') {
                                            echo "Yes";
                                        } else {
                                            echo "No";
                                        }
                                        ?></p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-1 border bg-light display-data">
                                    <label>Total Bridges</label>
                                    <p><?php echo $bridges; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <button class="nextBtn" onclick="document.location='<?= SYSTEM_PATH; ?>projects/project.php'">
                            <span class="btnText">Back</span>
                            <i class="uil uil-navigator"></i>
                        </button>
                    </div>
                    <div class="col-2">
                        <button class="nextBtn" onclick="document.location='editProject.php?project_id=<?= $pId; ?>'">
                            <span class="btnText">Update</span>
                            <i class="uil uil-navigator"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Access the projectProgress variable from PHP
    const progress = projectProgress;

    // Create the chart
    const ctx = document.getElementById('progress-chart').getContext('2d');

    const data = {
        labels: ['Progress', 'Remaining'],
        datasets: [{
            data: [progress, 100 - progress],
            backgroundColor: ['#002158', '#f0e51a'],
            borderWidth: 0
        }]
    };

    const config = {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Progress of Project'
                }
            }
        }
    };

    new Chart(ctx, config);
</script>

<?php include '../footer.php'; ?>