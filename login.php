<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CDN Link for CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Custom CSS File -->
    <link rel="stylesheet" href="./css/login.css">

</head>

<body>
    <div class="container-fluid">
        <div class="d-flex justify-content-center align-items-center  " id="login-parent-div">
            <div class="d-flex justify-content-center align-items-center  " id="login-child-div">
                <div class="row col-8 g-0" id="side-image"></div>
                <div class="row col-8 g-0" id="login-form">
                    <img src="./images/profile.jpg" id="login-avtar">
                    <h1>Sign Up Now</h1>
                    <form>
                        <input type="email" class="input_box" placeholder="Your Email">
                        <input type="password" class="input_box" placeholder="Your Password">
                        <p> <span><input type="checkbox"></span> I agree to the terms of services </p>
                        <button type="button" class="signup_btn">Sign up</button>
                        <p class="or">OR</p>
                        <button type="button" class="twitter_btn">Login with twitter</button>
                        <p>Do you have an account?<a href="#">Sign in</a></p>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bootstrap CDN Link for JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>