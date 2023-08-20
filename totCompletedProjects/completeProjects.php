<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/project.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Here! Your Completed Projects
    </div>

    <style>
        #form-header>h4 {
            padding-right: 600px !important;
        }
    </style>

    <div class="card shadow" id="form-card">
        <div class="card-body">
            <h4>List of Complete Projects</h4>
            <div class="table-responsive">
                <?php
                // Create SQL Query
                // SQL Query for Get Count of All Completed Projects
                $sql = "SELECT p.project_id, project_name, p_location, `start_date`, end_date
                FROM tbl_project p
                LEFT JOIN tbl_schedule_task t
                ON p.project_id = t.project_id
                 WHERE p.project_manager = '$user' AND current_status <> 1 AND current_status <> 2 AND current_status <> 3 AND current_status <> 5
                 GROUP BY p.project_id";


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
                            <th scope="col">Project Location</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                        ?>
                                <tr class="shadow-sm">
                                    <td class="align-middle"><?= $row['project_id']; ?></td>
                                    <td class="align-middle"><?= $row['project_name']; ?></td>
                                    <td class="align-middle"><?= $row['p_location']; ?></td>
                                    <td class="align-middle"><?= $row['start_date']; ?></td>
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
        <div>
</main>

<?php include '../footer.php'; ?>

<script>
    $(document).ready(function() {
        // AJAX request to get all records initially
        $.ajax({
            url: 'getAllRecords.php',
            method: 'POST',
            data: '',
            success: function(response) {
                $('#table-body').html(response);
            }
        });

    });
</script>