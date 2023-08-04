<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Completed Projects</h4>
    </div>

    <div class="card shadow" id="form-card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-strips">
                    <thead class="shadow">
                        <tr>
                            <th scope="col">Project ID</th>
                            <th scope="col">Project Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Starting Date</th>
                            <th scope="col">Ending Date</th>
                            <th scope="col">Project Manager</th>
                            <th scope="col">Total Cost (Rs)</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include '../footer.php'; ?>

<script>
    $(document).ready(function() {
        // AJAX request to get all records initially
        $.ajax({
            url: 'genarateRep.php',
            method: 'POST',
            data: '',
            success: function(response) {
                $('#table-body').html(response);
            }
        });
    });

</script>