<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Get Overoll Income From Projects in This Month</h4>
        <div>
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>reportPortal/reportPortal.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">
                Back
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 600px !important;
        }
    </style>

    <div class="card shadow" id="form-card">
        <div class="card-body">
            <h4 class="pt-4">Overoll Income From Projects in This Month</h4>
            <div class="table-responsive pt-3">
                <table class="table table-sm">
                    <thead class="shadow">
                        <tr>
                            <th scope="col">Project ID</th>
                            <th scope="col">Project Name</th>
                            <th scope="col">Total Cost Of Project</th>
                            <th scope="col">Starting Date</th>
                            <th scope="col">Ending Date</th>
                            <th scope="col">Payed Amount</th>
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
        // AJAX request to filter records
        $.ajax({
            type: 'POST',
            url: 'getoverollIncomeProject.php',
            method: 'POST',
            data: '',
            success: function(response) {
                $('#table-body').html(response);

            },
        });
    });
</script>