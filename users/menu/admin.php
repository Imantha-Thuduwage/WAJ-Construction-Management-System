  <!-- Side Bar Menu -->
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">

        <div class="position-sticky pt-3 sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?= SYSTEM_PATH; ?>index.php">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/layout.png" class="me-2">
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= SYSTEM_PATH; ?>users/user.php">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/blueprint.png" class="me-2">
                User Management
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= SYSTEM_PATH ?>users/userRole.php">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/tool-box.png" class="me-2">
                User Roles
              </a>
            </li>
          </ul>

          <h5 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-warning text-uppercase">
            <span class="text-warning">Report Portal</span>
          </h5>

          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="<?= SYSTEM_PATH ?>totalUserRep/totUserRep.php">
                <img src="<?= SYSTEM_PATH; ?>assets/icons/report.png" class="me-2">
                Users Report
              </a>
            </li>
          </ul>
        </div>

      </nav>
      <script>
        // Get the current page URL
        var currentUrl = window.location.href;

        // Find all sidebar links
        var sidebarLinks = document.querySelectorAll('#sidebarMenu .nav-link');

        // Iterate over the links and check if their href matches the current URL
        for (var i = 0; i < sidebarLinks.length; i++) {
          var link = sidebarLinks[i];

          // Check if the link's href matches the current URL
          if (link.href === currentUrl) {
            // Add the active class to the link
            link.classList.add('active');
            break; // Exit the loop after finding the active link
          }
        }
      </script>