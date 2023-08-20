<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/dashboard.css">

<?php

// Get Today Date to Filter Overdue Tasks
$currentDate = date("Y-m-d");

// Get Today Date to Filter Overdue Tasks
$thismonth = date("m");

// Get Today Year to Filter Overdue Tasks
$currentYear = date("Y");

// SQL Query for Get Total Income in this Month
$sql = "SELECT SUM(`payed_amount`) AS total_income FROM tbl_payment 
WHERE YEAR(payed_date) = '$currentYear' AND MONTH(payed_date) = '$thismonth'";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $TotalIncome = $row['total_income'];
}

// SQL Query for Get Total Expensive in this Month
$sql = "SELECT SUM(`payed_amount`) AS total_petty_cash FROM tbl_petty_cash
WHERE YEAR(payed_date) = '$currentYear' AND MONTH(payed_date) = '$thismonth'";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $TotalExpensive = $row['total_petty_cash'];
}

// SQL Query for Get Total Expensive in this Month
$sql = "SELECT SUM(`payed_amount`) AS total_petty_cash FROM tbl_petty_cash
WHERE YEAR(payed_date) = '$currentYear' AND MONTH(payed_date) = '$thismonth'";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $TotalPettyCash = $row['total_petty_cash'];
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

// Query to retrieve monthly income
// COALESCE function returns the first non-null argument from a list of expressions
$sql = "SELECT tbl_calendar.month, COALESCE(SUM(tbl_payment.payed_amount), 0)AS total_income
FROM tbl_calendar
LEFT JOIN tbl_payment
ON MONTH(tbl_payment.payed_date) = tbl_calendar.month
GROUP BY tbl_calendar.month
HAVING tbl_calendar.month <= MONTH(CURDATE())
ORDER BY tbl_calendar.month";
$db = dbConn();
$result = $db->query($sql);
// Fetch the data into an array
$totalIncomeCh = array();
while ($row = $result->fetch_assoc()) {
  $totalIncomeCh[$row['month']] = $row['total_income'];
}

// Query to retrieve monthly expensive for projects
// COALESCE function returns the first non-null argument from a list of expressions
$sql = "SELECT tbl_calendar.month, COALESCE(SUM(tbl_petty_cash.payed_amount), 0)AS total_expensive
FROM tbl_calendar
LEFT JOIN tbl_petty_cash
ON MONTH(tbl_petty_cash.payed_date) = tbl_calendar.month
GROUP BY tbl_calendar.month
HAVING tbl_calendar.month <= MONTH(CURDATE())
ORDER BY tbl_calendar.month";
$db = dbConn();
$result = $db->query($sql);
// Fetch the data into an array
$TotalExpensiveCh = array();
while ($row = $result->fetch_assoc()) {
  $TotalExpensiveCh[$row['month']] = $row['total_expensive'];
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
          <div class="col-3 card shadow m-2 custom-shadow" onclick="document.location='<?= SYSTEM_PATH; ?>payments/payment.php'">
            <div class="card-body">
              <h5 for="project_name" class="mb-2">Total Income in This Month (Rs)</h5>
              <h4><?= $TotalIncome ?></h4>
            </div>
          </div>
          <div class="col-3 card shadow m-2 custom-shadow" onclick="document.location='<?= SYSTEM_PATH; ?>pettyCash/pettyCash.php'">
            <div class="card-body">
              <h5 for="project_name" class="mb-2">Total Expensive for Projects This Month (Rs)</h5>
              <h4><?= $TotalExpensive ?></h4>
            </div>
          </div>
          <div class="col-3 card shadow m-2 custom-shadow" onclick="document.location='<?= SYSTEM_PATH; ?>pettyCash/pettyCash.php'">
            <div class="card-body">
              <h5 for="project_name" class="mb-2">Total Petty Cash for Projects This Month (Rs)</h5>
              <h4><?= $TotalPettyCash ?></h4>
            </div>
          </div>
          <div class="col-2 card shadow m-2 custom-shadow" onclick="document.location='<?= SYSTEM_PATH; ?>employees/employee.php'">
            <div class="card-body">
              <h5 for="project_name" class="mb-2">Total Employees</h5>
              <h4><?= $totalEmployees ?></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-start gx-5">
      <div class="col-6 mx-auto">
        <div class="card id-section text-center mb-3" onclick="document.location='<?= SYSTEM_PATH; ?>payments/payment.php'">
          <div class="card-body" style=" display: flex; justify-content: center; align-items: center;">
            <div class="p-1 border border-0" style="width: 100%;">
              <canvas id="lineChartIncome"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 mx-auto">
        <div class="card id-section text-center mb-3" onclick="document.location='<?= SYSTEM_PATH; ?>pettyCash/pettyCash.php'">
          <div class="card-body" style=" display: flex; justify-content: center; align-items: center;">
            <div class="p-1 border border-0" style="width: 100%;">
              <canvas id="lineChartExpensive"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-start gx-5">
      <div class="col-sm-5">
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
    </div>
  </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Line chart to showing monthly income for projects -->
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
  var incomeData = <?php echo json_encode(array_values($totalIncomeCh)); ?>;

  // Create the line chart
  document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById("lineChartIncome").getContext("2d");
    var lineChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: months,
        datasets: [{
          label: "Total Income for Month",
          data: incomeData,
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

<!-- Line chart to showing monthly expensive for projects -->
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
  var expensiveData = <?php echo json_encode(array_values($TotalExpensiveCh)); ?>;

  // Create the line chart
  document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById("lineChartExpensive").getContext("2d");
    var lineChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: months,
        datasets: [{
          label: "Total expensive for Month",
          data: expensiveData,
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

<!-- Script for showing completed project count related to all projects -->
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
          text: 'Complted Projects'
        }
      }
    }
  };

  new Chart(ctx, config);
</script>