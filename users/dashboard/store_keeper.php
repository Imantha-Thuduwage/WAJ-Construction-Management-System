<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/dashboard.css">

<?php

// Get Today Date 
$currentDate = date("Y-m-d");

// Get Today Date 
$thismonth = date("m");

// Get Today Year 
$currentYear = date("Y");

// SQL Query for Get Total Number of Tools
$sql = "SELECT COUNT(`tool_id`) AS total_tools FROM tbl_tool";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $TotalTools = $row['total_tools'];
}

// SQL Query for Get Total Number of Machines
$sql = "SELECT COUNT(`machine_id`) AS total_machines FROM tbl_machine";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $TotalMachines = $row['total_machines'];
}

// SQL Query for Get Count of All Maintenance
$sql = "SELECT COUNT(maintenance_id) AS total_t_maintenance FROM tbl_tool_maintenance";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $totalToolMaintenance = $row['total_t_maintenance'];
}
$sql = "SELECT COUNT(maintenance_id) AS total_m_maintenance FROM tbl_machine_maintenance";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $totalMachineMaintenance = $row['total_m_maintenance'];
}
$totalMaintenance = $totalToolMaintenance + $totalMachineMaintenance;

// Query to retrieve all tool count
$sql = "SELECT tbl_calendar.month, COUNT(tbl_tool.tool_id) AS total_tools
FROM tbl_calendar
LEFT JOIN tbl_tool
ON MONTH(tbl_tool.purchase_date) = tbl_calendar.month
GROUP BY tbl_calendar.month
HAVING tbl_calendar.month <= MONTH(CURDATE())
ORDER BY tbl_calendar.month";
$db = dbConn();
$result = $db->query($sql);
// Fetch the data into an array
$totalToolsCh = array();
while ($row = $result->fetch_assoc()) {
  $totalToolsCh[$row['month']] = $row['total_tools'];
}

// Query to retrieve all machine count
$sql = "SELECT tbl_calendar.month, COUNT(tbl_machine.machine_id) AS total_machines
FROM tbl_calendar
LEFT JOIN tbl_machine
ON MONTH(tbl_machine.purchase_date) = tbl_calendar.month
GROUP BY tbl_calendar.month
HAVING tbl_calendar.month <= MONTH(CURDATE())
ORDER BY tbl_calendar.month";
$db = dbConn();
$result = $db->query($sql);
// Fetch the data into an array
$totalMachinesCh = array();
while ($row = $result->fetch_assoc()) {
  $totalMachinesCh[$row['month']] = $row['total_machines'];
}

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

  <div class="container field p-3">
    <div class="row justify-content-start gx-5">
      <div class="col-sm">
        <div class="row row-cols-2 row-cols-lg-1 justify-content-between">
          <div class="col-3 card shadow m-3 custom-shadow" onclick="document.location='<?= SYSTEM_PATH; ?>tools/tool.php'">
            <div class="card-body">
              <h5 for="project_name" class="mb-2">Total Tools We Have</h5>
              <h4><?= $TotalTools ?></h4>
            </div>
          </div>
          <div class="col-4 card shadow m-3 custom-shadow" onclick="document.location='<?= SYSTEM_PATH; ?>machines/machine.php'">
            <div class="card-body">
              <h5 for="project_name" class="mb-2">Total Machines We Have</h5>
              <h4><?= $TotalMachines ?></h4>
            </div>
          </div>
          <div class="col-4 card shadow m-3 custom-shadow">
            <div class="card-body">
              <h5 for="project_name" class="mb-2">Total Maintenance We Did</h5>
              <h4><?= $totalMaintenance ?></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-start gx-5">
      <div class="col-6 mx-auto">
        <div class="card id-section text-center mb-3" onclick="document.location='<?= SYSTEM_PATH; ?>tools/tool.php'">
          <div class="card-body" style=" display: flex; justify-content: center; align-items: center;">
            <div class="p-1 border border-0" style="width: 100%;">
              <canvas id="lineChartTools"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 mx-auto">
        <div class="card id-section text-center mb-3" onclick="document.location='<?= SYSTEM_PATH; ?>machines/machine.php'">
          <div class="card-body" style=" display: flex; justify-content: center; align-items: center;">
            <div class="p-1 border border-0" style="width: 100%;">
              <canvas id="lineChartMachines"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-start gx-5">
          <div class="col-6" style="height: 345px; overflow: auto;">
            <h4 class="my-4">Tool Maintenance We Did This Month</h4>
            <div class="table-responsive">
              <?php
              // Get Today Date to Filter Overdue Tasks
              $thismonth = date("m");

              $sql = "SELECT maintenance_id, tool_id, maintenance_date
              FROM tbl_tool_maintenance WHERE MONTH(maintenance_date) = $thismonth";

              // Calling to the Connection
              $db = dbConn();

              // Get Result
              $result = $db->query($sql);
              ?>
              <table class="table table-sm custom-shadow-red">
                <thead class="shadow-lg">
                  <tr>
                    <th scope="col">Maintenance ID</th>
                    <th scope="col">Machine ID</th>
                    <th scope="col">Maintenance Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                  ?>
                      <tr class="shadow-lg">
                        <td class="align-middle"><?= $row['maintenance_id']; ?></td>
                        <td class="align-middle"><?= $row['tool_id']; ?></td>
                        <td class="align-middle"><?= $row['maintenance_date']; ?></td>
                      </tr>
                  <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-6" style="height: 345px; overflow: auto;">
            <h4 class="my-4">Machine Maintenance We Did This Month</h4>
            <div class="table-responsive">
              <?php
              // Get Today Date to Filter Overdue Tasks
              $thismonth = date("m");

              $sql = "SELECT maintenance_id, machine_id, maintenance_date
              FROM tbl_machine_maintenance WHERE MONTH(maintenance_date) = $thismonth";

              // Calling to the Connection
              $db = dbConn();

              // Get Result
              $result = $db->query($sql);
              ?>
              <table class="table table-sm custom-shadow-red">
                <thead class="shadow-lg">
                  <tr>
                    <th scope="col">Maintenance ID</th>
                    <th scope="col">Machine ID</th>
                    <th scope="col">Maintenance Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                  ?>
                      <tr class="shadow-lg">
                        <td class="align-middle"><?= $row['maintenance_id']; ?></td>
                        <td class="align-middle"><?= $row['machine_id']; ?></td>
                        <td class="align-middle"><?= $row['maintenance_date']; ?></td>
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
  var toolsData = <?php echo json_encode(array_values($totalToolsCh)); ?>;

  // Create the line chart
  document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById("lineChartTools").getContext("2d");
    var lineChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: months,
        datasets: [{
          label: "monthly tool count",
          data: toolsData,
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
  var machineData = <?php echo json_encode(array_values($totalMachinesCh)); ?>;

  // Create the line chart
  document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById("lineChartMachines").getContext("2d");
    var lineChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: months,
        datasets: [{
          label: "Monthly Machine Count",
          data: machineData,
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