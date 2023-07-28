<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/dashboard.css">

<?php

// Get Today Date to Filter Overdue Tasks
$currentDate = date("Y-m-d");

// Get Today Date to Filter Overdue Tasks
$thismonth = date("m");

// Get Today Year to Filter Overdue Tasks
$currentYear = date("Y");

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

// Query to retrieve monthly headcount growth
$sql = "SELECT tbl_calendar.month, COUNT(tbl_employee.date_of_joining) AS total_employees
FROM tbl_calendar
LEFT JOIN tbl_employee
ON MONTH(tbl_employee.date_of_joining) = tbl_calendar.month
GROUP BY tbl_calendar.month
HAVING tbl_calendar.month <= MONTH(CURDATE())
ORDER BY tbl_calendar.month
";
$db = dbConn();
$result = $db->query($sql);
// Fetch the data into an array
$employeeGrowth = array();
while ($row = $result->fetch_assoc()) {
  $employeeGrowth[$row['month']] = $row['total_employees'];
}

// Query for get Task Count for Each Project
$sql = "SELECT project_id, COUNT(*) AS task_count
        FROM tbl_schedule_task
        WHERE YEAR(add_date) >= '$currentYear' AND MONTH(add_date) >= '$thismonth'
        GROUP BY project_id
        ORDER BY project_id DESC
        LIMIT 10";
$db = dbConn();

$result = $db->query($sql);

// Step 3: Fetch the results and store them in variables
$projectIDs = [];
$taskCounts = [];

if ($result) {
  while ($row = $result->fetch_assoc()) {
    $projectIDs[] = $row['project_id'];
    $taskCounts[] = $row['task_count'];
  }
}

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

  <div class="container field p-3">
    <div class="row justify-content-start gx-5">
      <div class="col-sm">
        <div class="row row-cols-2 row-cols-lg-1 justify-content-between">
          <div class="col-3 card shadow m-3 custom-shadow" onclick="document.location='<?= SYSTEM_PATH; ?>projects/project.php'">
            <div class="card-body">
              <h5 for="project_name" class="mb-2">Total Projects</h5>
              <h4><?= $projectCount ?></h4>
            </div>
          </div>
          <div class="col-3 card shadow m-3 custom-shadow" onclick="document.location='<?= SYSTEM_PATH; ?>projects/project.php'">
            <div class="card-body">
              <h5 for="project_name" class="mb-2">Total Projects Completed</h5>
              <h4><?= $completedCount ?></h4>
            </div>
          </div>
          <div class="col-4 card shadow m-3 custom-shadow" onclick="document.location='<?= SYSTEM_PATH; ?>schedules/schedule.php'">
            <div class="card-body">
              <h5 for="project_name" class="mb-2">Total Employees Count</h5>
              <h4><?= $totalEmployees ?></h4>
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
        <h5 for="project_name" class="mb-2">Monthly Employee Growth of Company</h5>
        <div class="col mx-auto">
          <div class="card id-section text-center mb-3" onclick="document.location='<?= SYSTEM_PATH; ?>schedules/schedule.php'">
            <div class="card-body" style=" display: flex; justify-content: center; align-items: center;">
              <div class="p-1 border border-0" style="width: 100%;">
                <canvas id="lineChart"></canvas>
              </div>
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
              FROM tbl_schedule_task WHERE ending_date < '$todayDate'";

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

  const proData = {
    labels: ['Progress', 'Remaining'],
    datasets: [{
      data: [progress, 100 - progress],
      backgroundColor: ['#002158', '#f0e51a'],
      borderWidth: 0
    }]
  };

  const config = {
    type: 'doughnut',
    data: proData,
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

<script>
  // Get current year and months
  var currentDate = new Date();
  var currentYear = currentDate.getFullYear();
  var months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
  ];

  // Get data from PHP
  var empData = <?php echo json_encode(array_values($employeeGrowth)); ?>;

  // Create the line chart
  document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById("lineChart").getContext("2d");
    var lineChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: months,
        datasets: [{
          label: "Total Head Count",
          data: empData,
          borderColor: "rgb(75, 192, 192)",
          fill: false
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: true,
          }
        },
        scales: {
          x: {
            grid: {
              display: false // Remove vertical grid lines
            }
          },
          y: {
            grid: {
              display: false // Remove horizontal grid lines
            },
            beginAtZero: true,
            ticks: {
              stepSize: 1,
              callback: function(value) {
                if (Number.isInteger(value)) {
                  return value;
                }
              }
            }
          }
        }
      }
    });
  });
</script>