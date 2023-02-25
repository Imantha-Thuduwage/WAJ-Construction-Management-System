<?php
session_start();

include 'function.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <!-- Bootstrap CDN Link for CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Custom CSS File -->
    <link rel="stylesheet" href="./assets/css/forgot.css">
</head>

<body>
    <div class="card text-center mb-3">
        <div class="card-header text-white bg-secondary">
            Reset Password
        </div>
        <div class="card-body">
            <h5 class="card-title">Find Your Account</h5>
            <p class="card-text">Please enter your email address to search for your account.</p>
            <input type="email" class="input_box" name="user_name" placeholder="Your Email" value="">
        </div>
        <div class="card-footer bg-transparent">
            <a href="#" class="btn btn-primary">Forgot Password</a>
        </div>
    </div>
    
    <!-- Bootstrap CDN Link for JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>