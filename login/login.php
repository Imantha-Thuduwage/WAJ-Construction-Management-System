<?php
session_start();

include '../function.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <!-- Bootstrap CDN Link for CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Custom CSS File -->
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <div class="container-fluid">
        <div class="d-flex justify-content-center align-items-center  " id="login-parent-div">
            <div class="d-flex justify-content-center align-items-center  " id="login-child-div">
                <div class="row col-8 g-0" id="side-image"></div>
                <div class="row col-8 g-0" id="login-form">
                    <img src="../assets/images/profile.png" id="login-avtar">
                    <h1>Hello Again!</h1>
                    <form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <?php
                        // Cheking Submit button is clicked
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {

                            // This function uses array keys as variable names and values as variable values
                            extract($_POST);

                            // create array
                            $message = array();

                            // Reuired Fields Validation
                            if (empty($user_name)) {
                                $message['error_user_name'] = "Email Field should not be empty!";
                            }
                            if (empty($password)) {
                                $message['error_password'] = "Password Field should not be empty!";
                            }

                            // Advanced Validation
                            if (empty($message)) {
                                $db = dbConn();
                                // Change password in to sha1 
                                $password = sha1($password);
                                $sql = "SELECT u.`user_id`,u.`user_name`,u.`password`,u.`first_name`,u.`full_name`,r.`role_id`,r.`user_role` 
                                FROM tbl_user AS u INNER JOIN tbl_user_role AS r ON u.`role_id` = r.`role_id` WHERE user_name='$user_name' AND `password`='$password'";

                                // Passing Mmy SQL qurey in to inbuild query function
                                $result = $db->query($sql);

                                if ($result->num_rows <= 0) {
                                    $message['error_login'] = "Inavalid User Name or Password ...!";
                                } else {
                                    $row = $result->fetch_assoc();
                                    $_SESSION['userid'] = $row['user_id'];
                                    $_SESSION['firstname'] = $row['first_name'];
                                    $_SESSION['fullname'] = $row['full_name'];
                                    $_SESSION['userrole'] = $row['user_role'];
                                    $_SESSION['email'] = $row['email'];
                                    header("Location: ../index.php");
                                }
                            }
                        }

                        ?>
                        <label class="text-danger"><?php echo @$message['error_login']; ?></label>
                        <input type="email" class="input_box" name="user_name" placeholder="Your Email" value="<?= @$user_name; ?>">
                        <span class="text-danger"><?php echo @$message['error_user_name']; ?></span>
                        <input type="password" class="input_box" name="password" placeholder="Your Password">
                        <span class="text-danger"><?php echo @$message['error_password']; ?></span>
                        <button type="submit" class="signup_btn">Sign In</button>
                        <a href="forgotPass.php">Forgot Password</a>
                    </form>


                </div>
            </div>
        </div>

        <!-- Bootstrap CDN Link for JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>