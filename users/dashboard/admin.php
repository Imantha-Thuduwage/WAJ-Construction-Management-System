<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/dashboard.css">

<?php

// Get Today Date
$currentDate = date("Y-m-d");

// Get Today Month
$thismonth = date("m");

// Get Today Year
$currentYear = date("Y");

// SQL Query for Get Count of All User Accounts
$sql = "SELECT COUNT(`user_id`) AS user_count FROM tbl_user";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $userCount = $row['user_count'];
}

// SQL Query for Get Count of All Deactive Users
$sql = "SELECT COUNT(user_id) AS active_user_accounts
FROM tbl_user WHERE `status` = 1 ";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $activedAcc = $row['active_user_accounts'];
}

// SQL Query for Get Count of All Deactive Users
$sql = "SELECT COUNT(user_id) AS deactivated_accounts
FROM tbl_user WHERE `status` = 0 ";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $deactivatedAcc = $row['deactivated_accounts'];
}

// Query to retrieve monthly headcount growth
$sql = "SELECT MONTH(add_date) AS month, COUNT(*) AS total_users
        FROM tbl_user
        GROUP BY MONTH(add_date)
        ORDER BY MONTH(add_date)";
$db = dbConn();
$result = $db->query($sql);
// Fetch the data into an array
$data = array();
while ($row = $result->fetch_assoc()) {
  $data[$row['month']] = $row['total_users'];
}

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

  <div class="container field p-3">
    <div class="row justify-content-start gx-5">
      <div class="col-sm">
        <div class="row row-cols-2 row-cols-lg-1 justify-content-between">
          <div class="col-3 card shadow m-3 custom-shadow" onclick="document.location='<?= SYSTEM_PATH; ?>users/user.php'">
            <div class="card-body">
              <h5 for="project_name" class="mb-2" style="color:#2784ff">Total Users</h5>
              <h4><?= $userCount ?></h4>
            </div>
          </div>
          <div class="col-4 card shadow m-3 custom-shadow" onclick="document.location='<?= SYSTEM_PATH; ?>users/user.php'">
            <div class="card-body">
              <h5 for="project_name" class="mb-2" style="color:green">Total Acitive User Accounts</h5>
              <h4><?= $activedAcc ?></h4>
            </div>
          </div>
          <div class="col-4 card shadow m-3 custom-shadow" onclick="document.location='<?= SYSTEM_PATH; ?>users/user.php'">
            <div class="card-body border-danger">
              <h5 for="project_name" class="mb-2" style="color:red">Total Deactivated User Accounts</h5>
              <h4><?= $deactivatedAcc ?></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row justify-content-start gx-5">
    <div class="col-9 mx-auto">
      <div class="card id-section text-center mb-3" onclick="document.location='<?= SYSTEM_PATH; ?>users/user.php'">
        <div class="card-body" style=" display: flex; justify-content: center; align-items: center;">
          <div class="p-1 border border-0" style="width: 100%;">
            <canvas id="lineChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
  var data = <?php echo json_encode(array_values($data)); ?>;

  // Create the line chart
  document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById("lineChart").getContext("2d");
    var lineChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: months,
        datasets: [{
          label: "Total Head Count",
          data: data,
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