<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/dashboard.css">

<?php

// Get Today Date
$currentDate = date("Y-m-d");

// Get Today Date 
$thismonth = date("m");

// Get Today Year
$currentYear = date("Y");

// Get user id of logged
$userId = $_SESSION['userid'];

// SQL Query for Get Count of All Projects 
$sql = "SELECT COUNT(`project_id`) AS project_count FROM tbl_project";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $projectCount = $row['project_count'];
}

// SQL Query for Get Count of All Completed Projects
$sql = "SELECT COUNT(DISTINCT project_id) AS completed_projects_count
-- Why we getting current_status like this because if we get status = 4, this will give if one task is done all project is done
FROM tbl_schedule_task WHERE current_status <> 1 AND current_status <> 2 AND current_status <> 3 AND current_status <> 5";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $completedCount = $row['completed_projects_count'];
}

// SQL Query for Get Count All Employees
$sql = "SELECT COUNT(employee_id) AS total_employees
FROM tbl_employee ";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $totalEmployees = $row['total_employees'];
}

// SQL Query for Get Count All Employees Under Each Supervisor
$sql = "SELECT COUNT(employee_id) AS total_employees FROM tbl_employee WHERE supervisor = $userId";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $myEmployees = $row['total_employees'];
}

// SQL Query for Get Count of tasks end date is in this month
$sql = "SELECT COUNT(task_id) as overdue_count
FROM tbl_schedule_task WHERE ending_date = '$thismonth' AND current_status <> 4";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $taskCount = $row['overdue_count'];
}

// SQL Query for get data to showing completed project using Chart
// SQL Query for Get Count of All Completed Projects
$sql = "SELECT COUNT(DISTINCT project_id) AS completed_projects_count
FROM tbl_schedule_task WHERE current_status <> 1 AND current_status <> 2 AND current_status <> 3 AND current_status <> 5";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $completedCount = $row['completed_projects_count'];
}

$sql = "SELECT COUNT(*) as all_projects FROM tbl_project";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $allProjects = $row['all_projects'];
}

// Calculate the progress percentage
$completed = ($allProjects > 0) ? (($completedCount / $allProjects) * 100) : 0;

// Pass the progress value to JavaScript
echo '<script>const projects = ' . $completed . ';</script>';

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

  <div class="container field p-3">
    <div class="row justify-content-start gx-5">
      <div class="col-sm">
        <div class="row row-cols-2 row-cols-lg-1 justify-content-between">
          <div class="col-2 card shadow m-2 custom-shadow" onclick="document.location='<?= SYSTEM_PATH; ?>projects/project.php'">
            <div class="card-body">
              <h5 for="project_name" class="mb-2">Total Number of Projects</h5>
              <h4><?= $projectCount ?></h4>
            </div>
          </div>
          <div class="col-2 card shadow m-2 custom-shadow" onclick="document.location='<?= SYSTEM_PATH; ?>projects/project.php'">
            <div class="card-body">
              <h5 for="project_name" class="mb-2">Total Projects Completed</h5>
              <h4><?= $completedCount ?></h4>
            </div>
          </div>
          <div class="col-3 card shadow m-2 custom-shadow" onclick="document.location='<?= SYSTEM_PATH; ?>employees/employee.php'">
            <div class="card-body">
              <h5 for="project_name" class="mb-2">Total Employess of  Company</h5>
              <h4><?= $totalEmployees ?></h4>
            </div>
          </div>
          <div class="col-4 card shadow m-2 custom-shadow" onclick="document.location='<?= SYSTEM_PATH; ?>employees/employee.php'">
            <div class="card-body">
              <h5 for="project_name" class="mb-2">Total Emplyees Under My Supervising</h5>
              <h4><?= $myEmployees ?></h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-start gx-5">
      <div class="col-sm-5 pt-3">
        <h5 for="project_name" class="mb-2">Completed Projects from All Projects</h5>
        <div class="border bg-light">
          <div class="card id-section text-center" onclick="document.location='<?= SYSTEM_PATH; ?>projects/project.php'">
            <div class="card-body" style=" display: flex; justify-content: center; align-items: center;">
              <div class="p-1 border border-0">
                <canvas id="project-chart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-7 pt-3">
        <div class="row row-cols-2 row-cols-lg-1 g-2 g-lg-3">
          <h5 for="project_name" class="mb-2">Employees, Under My Supervising</h5>
          <div class="col-sm border m-0" style="height: 345px; overflow: auto;" onclick="document.location='<?= SYSTEM_PATH; ?>employees/employee.php'">
            <div class="table-responsive">
              <?php
              // Get Today Date to Filter Overdue Tasks
              $thismonth = date("m");

              $sql = "SELECT `employee_id`, `first_name`, `last_name`, `nic_number`
                FROM tbl_employee WHERE supervisor = '$userId'";

              // Calling to the Connection
              $db = dbConn();

              // Get Result
              $result = $db->query($sql);
              ?>
              <table class="table table-sm custom-shadow-red">
                <thead class="shadow-lg">
                  <tr>
                    <th scope="col">Emp ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">NIC Number</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                  ?>
                      <tr class="shadow-lg">
                        <td class="align-middle"><?= $row['employee_id']; ?></td>
                        <td class="align-middle"><?= $row['first_name']; ?></td>
                        <td class="align-middle"><?= $row['last_name']; ?></td>
                        <td class="align-middle"><?= $row['nic_number']; ?></td>
                      </tr>
                  <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-start gx-5">
      <div class="col-6" onclick="document.location='<?= SYSTEM_PATH; ?>schedules/schedule.php'">
        <h4 for="project_name" class="my-4">Overdue Task List to Today</h4>
        <div class="table-responsive custom-shadow-red">
          <?php
          // Get Today Date to Filter Overdue Tasks
          $todayDate = date("Y-m-d");

          $sql = "SELECT `task_id`, `project_id`, `task_name`, `ending_date` 
              FROM tbl_schedule_task WHERE ending_date < '$todayDate' AND current_status <> 4";

          // Calling to the Connection
          $db = dbConn();

          // Get Result
          $result = $db->query($sql);
          ?>
          <table class="table table-sm custom-shadow-red">
            <thead class="shadow-lg">
              <tr>
                <th scope="col">Task ID</th>
                <th scope="col">Project ID</th>
                <th scope="col">Task Name</th>
                <th scope="col">Ending Date</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

              ?>
                  <tr class="shadow-lg">
                    <td class="align-middle"><?= $row['task_id']; ?></td>
                    <td class="align-middle"><?= $row['project_id']; ?></td>
                    <td class="align-middle"><?= $row['task_name']; ?></td>
                    <td class="align-middle"><?= $row['ending_date']; ?></td>
                  </tr>
              <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-6" onclick="document.location='<?= SYSTEM_PATH; ?>schedules/schedule.php'">
        <h4 for="project_name" class="my-4">Project List of Estimated to End This Month</h4>
        <div class="table-responsive">
          <?php

          $sql = "SELECT `project_id`, `project_name`, `end_date` 
              FROM tbl_project WHERE YEAR(`end_date`) = '$currentYear' AND MONTH(`end_date`) = '$thismonth'";

          // Calling to the Connection
          $db = dbConn();

          // Get Result
          $result = $db->query($sql);
          ?>
          <table class="table table-sm custom-shadow-red">
            <thead class="shadow-lg">
              <tr>
                <th scope="col">Project ID</th>
                <th scope="col">Project Name</th>
                <th scope="col">Ending Date</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

              ?>
                  <tr class="shadow-lg">
                    <td class="align-middle"><?= $row['project_id']; ?></td>
                    <td class="align-middle"><?= $row['project_name']; ?></td>
                    <td class="align-middle"><?= $row['end_date']; ?></td>
                  </tr>
              <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  // Access the projectProgress variable from PHP
  const progress = projects;

  // Create the chart
  const ctx = document.getElementById('project-chart').getContext('2d');

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