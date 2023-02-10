<?php
session_start();

if (!isset($_SESSION['userid'])) {
  header("Location: login.php");
}

include 'config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>

  <!-- Bootstrap CDN Link for CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Custom CSS File -->
  <link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/dashboard.css">

</head>

<body>

  <!-- Header Section with Nav Bar -->
  <header class="py-3 mb-3 border-bottom sticky-top">
    <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
      <div class="d-flex align-items-center">
        <img src="<?= SYSTEM_PATH; ?>assets/images/WAJ-Logo.png" alt="mdo" width="40" class="rounded-circle">
        <span class="navbar-brand mb-0 h1" id="company-name">WAJ Construction</span>
      </div>

      <div class="d-flex align-items-center">
        <form class="w-100 me-3">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>

        <div class="nav-item text-nowrap" id="emp-position">
          <?= $_SESSION['lastname']; ?>
        </div>

        <div class="flex-shrink-0 dropdown">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>