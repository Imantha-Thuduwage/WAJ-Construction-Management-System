<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New User Account</h1>
        <!-- <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="../product.php" type="button" class="btn btn-sm btn-outline-secondary">View Project</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Update Project
            </button>
        </div> -->
    </div>

    <?php
    $name = @$_POST['pName'];
    $price = @$_POST['pCost'];
    $qty = @$_POST['pManager'];

    $message =  empty($name) ? "Project Name Should Not Empty" : "";

    ?>
    <form method="post" class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="mb-3">
            <label for="EnterProductName" class="form-label">User Name</label>
            <input type="text" class="form-control" id="project_name" name="pName" <?php echo @$message ?>>
        </div>
        <div class="mb-3">
            <label for="EnterProductName" class="form-label">Password</label>
            <input type="password" class="form-control" id="project_name" name="pName" <?php echo @$message ?>>
        </div>
        <div class="mb-3">
            <label for="EnterProductName" class="form-label">User Role</label>
            <input type="text" class="form-control" id="project_manager" name="pManager" <?php echo @$message ?>>
        </div>
        <div class="mb-3">
            <label for="EnterProductName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="project_manager" name="pManager" <?php echo @$message ?>>
        </div>
        <div class="mb-3">
            <label for="EnterProductName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="project_manager" name="pManager" <?php echo @$message ?>>
        </div>
        <div class="mb-3">
            <label for="EnterProductName" class="form-label">Email</label>
            <input type="email" class="form-control" id="project_manager" name="pManager" <?php echo @$message ?>>
        </div>
        <div class="mb-3">
            <label for="EnterProductName" class="form-label">Add User</label>
            <input type="text" class="form-control" id="project_manager" name="pManager" <?php echo @$message ?>>
        </div>
        <div class="mb-3">
            <label for="EnterProductName" class="form-label">Add Date</label>
            <input type="date" class="form-control" id="project_manager" name="pManager" <?php echo @$message ?>>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</main>

<?php include '../footer.php'; ?>