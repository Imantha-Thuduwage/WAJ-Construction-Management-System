<?php
session_start();

include '../function.php';
include '../assets/phpmail/mail.php';

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
    <link rel="stylesheet" href="../assets/css/forgot.css">
</head>

<?php
// Cheking Submit button is clicked
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // This function uses array keys as variable names and values as variable values
    extract($_POST);

    // create array
    $message = array();

    // Reuired Fields Validation
    if (empty($userName)) {
        $message['error_userName'] = "Please Enter Your Email Address";
    }

    // Adavanced Validation
    if (!empty($userName)) {
        $sql = "SELECT * FROM tbl_user WHERE user_name = '$userName'";
        $db = dbConn();
        $result = $db->query($sql);

        if ($result->num_rows == 0) {
            $message['error_userName'] = "No Email Found!";
        } else {
            // Create a token for Use to Password Reset key
            $token = md5(rand());

            // Update the database with the token and User Name
            $sql = "UPDATE tbl_user SET reset_token = '$token' WHERE user_name = '$userName' LIMIT 1";
            $success = $db->query($sql);

            // When Token is Set, Process for Sending Email
            if ($success) {
                $row = $result->fetch_assoc();
                $_SESSION['firstname'] = $row['first_name'];
                $name = $row['first_name'];
                $reset_link = '<a href="http://localhost/construction-management-system/login/reset.php?token=' . $token . '">Reset Link</a>';
                $subject = "Password Reset Link";
                $body = "<h1>Reset Your Password</h1>
                <p>Dear $name,</p>
                <p>You recently requested to reset the password for your WAJ Portal account. </p>
                <p>$reset_link</p>
                <p>If you did not request a password reset, please ignore this email or reply to let us know.</p>
                <p>Thank You</p>
                <p>WAJ Construction</p>";
                $customer = $_SESSION['firstname'];
                $email = $userName;

                //Email Sending Function
                send_email($email, $customer, $subject, $body, "Team WAJ");
            } else {
                $message['error_userName'] = "Something Went Wrong";
            }
        }
    }
}
?>

<body>

<!-- Card Header -->
    <div class="card text-center mb-3">
        <div class="card-header text-white bg-secondary">
            <h4>Reset Password</h4>
        </div>
    </div>

<!-- Card Body With Form -->
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Find Your Account</h5>
                        </div>
                        <div class="card-body p-4">
                            <p class="card-text">Please enter your email address to search for your account.</p>
                            <form method="post" class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <div class="form-group mb-3">
                                    <input type="email" name="userName" class="form-control" placeholder="Enter Your Email">
                                    <div class="text-danger">
                                        <?php echo @$message['error_userName']; ?>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-primary w-100">Forgot Password</button>
                                </div>
                                <div class="form-group mb-3">
                                    <a href="./login.php" class="btn btn-primary w-100">Back to Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap CDN Link for JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>