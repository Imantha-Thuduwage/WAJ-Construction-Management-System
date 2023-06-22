<?php
session_start();

if (!isset($_SESSION['userid'])) {
  header("Location: login.php");
}

include 'config.php';
include 'function.php';

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

  <!-- sweetalert2 CDN Link -->
  <!-- <link rel="stylesheet" href="sweetalert2.min.css"> -->

  <!-- Custom CSS File -->
  <link rel="stylesheet" href="<?= SYSTEM_PATH; ?>assets/css/styles.css">

  <!-- Boxicons CSS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
  crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- JQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
</head>

<body>

  <!-- Header Section with Nav Bar -->
  <header class="py-3 border-bottom sticky-top bg-light">
    <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
      <div class="d-flex align-items-center">
        <img src="<?= SYSTEM_PATH; ?>assets/images/waj-Logo.png" alt="mdo" width="40" class="rounded-circle">
        <span class="navbar-brand mb-0 h1" id="company-name">WAJ Construction</span>
      </div>

      <div class="d-flex align-items-center">
        <form class="w-100 me-3">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>

        <div class="nav-item text-nowrap" id="emp-position">
          <?= $_SESSION['firstname']; ?>
        </div>

        <div class="flex-shrink-0 dropdown">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="<?= SYSTEM_PATH; ?>login/login.php">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>