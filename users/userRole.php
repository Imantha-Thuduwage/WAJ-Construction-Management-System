<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/project.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Here! Your User Role Portal</h4>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 480px !important;
        }
    </style>

    <div class="card shadow col-10" id="form-card">
        <div class="card-body">
            <h4>List of User Roles</h4>
            <div class="table-responsive">
                <?php
                // Create SQL Query
                $sql = "SELECT `role_id`,`user_role` FROM tbl_user_role";

                // Calling to the Connection
                $db = dbConn();

                // Get Result
                $result = $db->query($sql);
                ?>
                <table class="table table-sm">
                    <thead class="shadow">
                        <tr>
                            <th scope="col">Role ID</th>
                            <th scope="col">User Role</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                        ?>
                                <tr class="shadow-sm">
                                    <td class="align-middle"><?= $row['role_id']; ?></td>
                                    <td class="align-middle"><?= $row['user_role']; ?></td>
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