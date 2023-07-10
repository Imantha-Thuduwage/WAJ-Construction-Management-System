  <!-- Side Bar Menu -->
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">

        <div class="position-sticky pt-3 sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= SYSTEM_PATH; ?>index.php">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= SYSTEM_PATH; ?>tools/tool.php">
                <span data-feather="file" class="align-text-bottom"></span>
                Tools
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= SYSTEM_PATH ?>machines/machine.php">
                <span data-feather="shopping-cart" class="align-text-bottom"></span>
                Machines
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= SYSTEM_PATH ?>assign/tools/assign.php">
                <span data-feather="bar-chart-2" class="align-text-bottom"></span>
               Tool Assign
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= SYSTEM_PATH ?>assign/machines/assign.php">
                <span data-feather="users" class="align-text-bottom"></span>
                Machine Assigning
              </a>
            <li class="nav-item">
              <a class="nav-link" href="<?= SYSTEM_PATH ?>users/user.php">
                <span data-feather="layers" class="align-text-bottom"></span>
                Users
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= SYSTEM_PATH ?>payments/payment.php">
                <span data-feather="layers" class="align-text-bottom"></span>
                Payments
              </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Saved reports</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
              <span data-feather="plus-circle" class="align-text-bottom"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text" class="align-text-bottom"></span>
                Current month
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text" class="align-text-bottom"></span>
                Last quarter
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text" class="align-text-bottom"></span>
                Social engagement
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text" class="align-text-bottom"></span>
                Year-end sale
              </a>
            </li>
          </ul>
        </div>

      </nav>