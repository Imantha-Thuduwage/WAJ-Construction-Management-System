<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Create Payroll</h4>
        <div>
            <button type="button" class="btn btn-sm px-4 border-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>payroll/genaratePayroll.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">
                View PettyCash
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 650px !important;
        }
    </style>

    <div class="card shadow" id="form-card">
        <div class="card-body">

            <form method="post" class="form" id="payroll-form" action="createReport.php">
                <div class="container field p-0">
                    <div class="row justify-content-center gx-5">
                        <div class="col-sm-6">
                            <h6 class="pt-3 pb-2 mb-0">Generate Payroll Reports</h6>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-4">
                            <div class="input-field">
                                <label>Month</label>
                                <input class="p-3 bg-body" id="month" type="text" onfocus="(this.type='month')" placeholder="Pickup Month" name="month" value="">
                                <div class="error-message text-danger" id="error_month"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center gx-5">
                        <div class="col-6">
                            <button class="nextBtn" type="submit" id="submit">
                                <span class="btnText">Genarate</span>
                                <i class="uil uil-navigator"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <table class="table table-sm">
                <thead class="shadow">
                    <tr>
                        <th scope="col">Petty Cash ID</th>
                        <th scope="col">Project ID</th>
                        <th scope="col">Payed Amount</th>
                        <th scope="col">Payed Date</th>
                        <th scope="col">More Details</th>
                        <th scope="col">Remove</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                </tbody>
            </table>
        </div>
    </div>
    <div id="output"></div>
    <button type="button" onclick="printSlip('output')">Print</button>
</main>

<script src="<?= SYSTEM_PATH; ?>assets/js/payroll/genaratePayroll.js"></script>

<!-- Function for print paysheet as PDF -->
<script>
    function printSlip(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

<!-- Change date picker to select only month -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  const monthPickerInput = document.getElementById("month");

  monthPickerInput.addEventListener("change", function() {
    const selectedMonth = monthPickerInput.value;
  });
});
</script>

<?php include '../footer.php'; ?>