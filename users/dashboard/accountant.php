<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/form.css">

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
} else {
  echo "Error executing the query: " . $db->error;
}

// SQL Query for Get Count of All Completed Projects
$sql = "SELECT COUNT(DISTINCT project_id) AS completed_projects_count
FROM tbl_schedule_task WHERE current_status <> 1 AND current_status <> 2 AND current_status <> 3 AND current_status <> 5";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $completedCount = $row['completed_projects_count'];
} else {
  echo "Error executing the query: " . $db->error;
}

// SQL Query for Get Count of All Completed Projects
$sql = "SELECT COUNT(task_id) AS overdue_count
FROM tbl_schedule_task WHERE ending_date < '$currentDate'";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $overdueCount = $row['overdue_count'];
} else {
  echo "Error executing the query: " . $db->error;
}

// SQL Query for Get Count of All Completed Projects
$sql = "SELECT COUNT(task_id) as overdue_count
FROM tbl_schedule_task WHERE ending_date = '$thismonth'";
$db = dbConn();
$result = $db->query($sql);

if ($result) {
  $row = $result->fetch_assoc();
  $overdueCount = $row['overdue_count'];
} else {
  echo "Error executing the query: " . $db->error;
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
        <div class="row row-cols-2 row-cols-lg-1">
          <div class="col-4">
            <div class="p-1 border bg-light display-data">
              <label for="project_name">Total Projects</label>
              <h4><?= $projectCount ?></h4>
            </div>
          </div>
          <div class="col-4">
            <div class="p-1 border bg-light display-data">
              <label for="project_name">Total Projects Completed</label>
              <h4><?= $completedCount ?></h4>
            </div>
          </div>
          <div class="col-4">
            <div class="p-1 border bg-light display-data">
              <label for="project_name">Amount of Overdue Tasks as of Today</label>
              <h4><?= $completedCount ?></h4>
            </div>
          </div>
          <div class="col-4">
            <div class="p-1 border bg-light display-data">
              <label for="project_name">Task List, Deadline Coming This Month</label>
              <div class="table-responsive">
                <?php
                // Get Today Date to Filter Overdue Tasks
                $thismonth = date("m");

                $sql = "SELECT `task_id`, `project_id`, `task_name`, `ending_date` 
                FROM tbl_schedule_task WHERE YEAR(`ending_date`) = '$currentYear' AND MONTH(ending_date) = $thismonth";

                // Calling to the Connection
                $db = dbConn();

                // Get Result
                $result = $db->query($sql);
                ?>
                <table class="table table-sm">
                  <thead class="shadow">
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
                        <tr class="shadow-sm">
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
          </div>
          <div class="col-4">
            <label for="project_name">Overdue Task List to Today</label>
            <div class="table-responsive">
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
              <table class="table table-sm">
                <thead class="shadow">
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
                      <tr class="shadow-sm">
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
          <div class="col-4">
            <label for="project_name">Project List of Estimated to End This Month</label>
            <div class="table-responsive">
              <?php

              $sql = "SELECT `project_id`, `project_name`, `end_date` 
              FROM tbl_project WHERE YEAR(`end_date`) = '$currentYear' AND MONTH(`end_date`) = '$thismonth'";

              // Calling to the Connection
              $db = dbConn();

              // Get Result
              $result = $db->query($sql);
              ?>
              <table class="table table-sm">
                <thead class="shadow">
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
                      <tr class="shadow-sm">
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
          <div class="col-4">
            <div class="border bg-light">
              <div class="card id-section text-center">
                <div class="card-body" style=" display: flex; justify-content: center; align-items: center;">
                  <div class="p-1 border border-0">
                    <canvas id="project-chart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="border bg-light">
              <div class="card id-section text-center">
                <div class="card-body" style=" display: flex; justify-content: center; align-items: center;">
                  <div class="p-1 border border-0">
                    <canvas id="task-count"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
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

<script>
  // Retrieve data from the database (replace with your query and actual data)
  // Use the retrieved data to create a bar chart using Chart.js
  var projectIDs = <?php echo json_encode($projectIDs); ?>;
  var taskCounts = <?php echo json_encode($taskCounts); ?>;

  // Step 2: Create a bar chart using Chart.js
  var id = document.getElementById('task-count').getContext('2d');
  var chart = new Chart(id, {
    type: 'bar',
    data: {
      labels: projectIDs,
      datasets: [{
        label: 'Task Count',
        data: taskCounts,
        backgroundColor: '#e014cf', // Change the color as desired
        borderWidth: 1,
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1, // Set the step size to 1 to display whole numbers
            precision: 0 // Set the precision to 0 to remove decimal places
          }
        }
      }
    },
    dataset: {
      barPercentage: 0.5, // Adjust the bar width to be half of the default width
      categoryPercentage: 1.0 // Keep the category width the same as the default width
    }
  });
</script>