<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Add New Tool</h4>
        <div>
            <button type="button" class="btn btn-sm px-5-bottom border-end border-2" onclick="document.location='<?= SYSTEM_PATH; ?>tools/tool.php'">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/eye.png" class="me-2">
                View Tools
            </button>
        </div>
    </div>

    <style>
        #form-header>h4 {
            padding-right: 790px !important;
        }
    </style>

    <div class="card shadow" method="POST" id="form-card" action="saveTool.php" enctype="multipart/form-data">
        <div class="card-body">

            <form method="post" class="form" id="tool-form">
                <div class="container field p-0">
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm-10">
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="tool_name">Tool Name</label>
                                        <input class="p-3 bg-body" id="toolName" type="text" placeholder="Tool Name" name="toolName" value="">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-field">
                                        <label for="purchase_date">Purchase Date</label>
                                        <input class="p-3 bg-body" id="purchaseDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="purchaseDate" value="">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-field">
                                        <label for="status">Status</label>
                                        <select class="bg-body" id="status" name="status">
                                            <option value="" selected disabled hidden>Pick Status</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT condition_id, condition_name FROM tbl_resource_condition";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['condition_name'] . "'>" . $row['condition_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-field">
                                        <label for="description">Description</label>
                                        <textarea class="p-3 bg-body" id="description" type="text" placeholder="Enter Brief Description" name="description" value=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <div class="row row-cols-2 row-cols-lg-1">
                                <div class="col-6">
                                    <div class="input-field">
                                        <label>Upload Tool Image (Not Mandatory)</label>
                                        <input class="p-3 bg-body" type="file" id="toolImg" name="toolImg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="nextBtn" type="submit" id="submit">
                        <span class="btnText">Save</span>
                        <i class="uil uil-navigator"></i>
                    </button>
            </form>
        </div>
    </div>
</main>

<script src="<?= SYSTEM_PATH; ?>assets/js/tools/addTool.js"></script>

<?php include '../footer.php'; ?>