<?php include '../header.php'; ?>
<link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/addEmployee.css">
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex p-2 justify-content-between flex-wrap flex-md-nowrap align-items-center" id="form-header">
        <h4>Update Tool</h4>
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

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        extract($_GET);

        $sql = "SELECT * FROM tbl_tool WHERE tool_id='$tool_id'";
        $db = dbConn();
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $toolId = $row['tool_id'];
        $toolName = $row['tool_name'];
        $description = $row['description'];
        $purchaseDate = $row['purchase_date'];
        $status = $row['current_condition'];
        $toolImg = $row['tool_image'];
    }
    ?>

    <div class="card shadow" method="POST" id="form-card" action="saveEditTool.php" enctype="multipart/form-data">
        <div class="card-body">
            <form method="post" class="form" id="tool-form">
                <div class="container field p-0">
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm-6">
                            <h6 class="pt-3 pb-2 mb-0">Enter Your Tool Details Here</h6>
                        </div>
                    </div>
                    <input type="hidden" name="toolId" value="<?php echo $toolId ?>">
                    <div class="row justify-content-start gx-5">
                        <div class="col-sm">
                            <div class="row row-cols-2 row-cols-lg-1 g-2 g-lg-3">
                                <div class="col-sm">
                                    <div class="input-field">
                                        <label for="tool_name">Tool Name</label>
                                        <input class="p-3 bg-body" id="toolName" type="text" placeholder="Tool Name" name="toolName" value="<?php echo $toolName ?>">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-field">
                                        <label for="purchase_date">Purchase Date</label>
                                        <input class="p-3 bg-body" id="purchaseDate" type="text" onfocus="(this.type='date')" placeholder="Pickup Date" name="purchaseDate" value="<?php echo $purchaseDate ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-field">
                                        <label for="status">Status</label>
                                        <select class="bg-body" id="status" name="status">
                                            <option value="">Pick Status</option>

                                            <?php
                                            // Retrieve data from MySQL database
                                            $sql = "SELECT condition_name FROM tbl_resource_condition";
                                            $db = dbConn();
                                            $result = $db->query($sql);

                                            // Display options in dropdown list
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    // Check if the option value matches the selected value from the database
                                                    $selected = ($row['condition_name'] == $status) ? 'selected' : '';
                                                    echo "<option value='" . $row['condition_name'] . "' " . $selected . ">" . $row['condition_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card id-section d-flex align-items-start border-0 mb-3">
                                <div class="card-body mb-2 p-2" style="display: flex; justify-content: center; align-items: center;">
                                    <img class="img-fluid" src="<?= SYSTEM_PATH; ?>assets/images/toolImages/<?= !empty($toolImg) ? $toolImg : 'no-image.png' ?>" style="height: 250px;">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row justify-content-start gx-5">
                        <div class="col-6">
                            <div class="col-sm">
                                <div class="input-field">
                                    <label for="description">Description</label>
                                    <textarea class="p-3 bg-body" id="description" type="text" placeholder="Enter Brief Description" name="description"><?php echo $description ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-field">
                                <label>Upload Tool Image (Not Mandatory)</label>
                                <input class="p-3 bg-body" type="file" id="toolImg" name="toolImg">
                                <!-- Set prvious image value to save DB when user is not update new image -->
                                <input type="hidden" name="sameToolImg" value="<?php echo @$toolImg; ?>">
                            </div>
                        </div>
                    </div>
                    <button class="nextBtn" type="submit" id="submit">
                        <span class="btnText">Save</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="<?= SYSTEM_PATH; ?>assets/js/tools/editTool.js"></script>

<?php include '../footer.php'; ?>