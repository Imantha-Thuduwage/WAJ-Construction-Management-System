<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add New Product</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="../product.php" type="button" class="btn btn-sm btn-outline-secondary">View Product</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Update Product
            </button>
        </div>
    </div>

    <?php
    $name = @$_POST['pName'];
    $price = @$_POST['pPrice'];
    $qty = @$_POST['pQty'];

    $message =  empty($name) ? "Product Name Should Not Empty" : "";

    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="mb-3">
            <label for="EnterProductName" class="form-label">Enter Product Name</label>
            <input type="text" class="form-control" id="product_name" name="pName" <?php echo @$message ?>>

        </div>
        <div class="mb-3">
            <label for="EnterProductQuantity" class="form-label">Enter Product Quantity</label>
            <select name="pQty" id="product_quantity" class="form-control">
                <?php
                for ($q = 1; $q <= 100; $q++) {
                ?>
                    <option value="<?= $q; ?>"><?= $q; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="EnterProductQuantity" class="form-label">Enter Product Year</label>
            <select name="pYr" id="product_year" class="form-control">
                <?php
                for ($y = 2000; $y < date('Y'); $y++) {
                ?>
                    <option value="<?= $y; ?>"><?= $y; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="EnterProductPrice" class="form-label">Enter Product Price</label>
            <input type="number" class="form-control" id="product_price" name="pPrice">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>

<?php include '../footer.php'; ?>