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
    <title>Reset Password</title>

    <!-- Bootstrap CDN Link for CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Custom CSS File -->
    <link rel="stylesheet" href="../assets/css/forgot.css">
</head>

<?php
//Token Validation
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $token = $_GET['token'];
    $_SESSION['token'] = $token; // Setting Token Value to Session Variable

    // Setting DB Connection and Get Token from DB
    $db = dbConn();
    $sql = "SELECT * FROM tbl_user WHERE reset_token ='$token'";
    $result = $db->query($sql);

    $row = $result->fetch_assoc();
    $userName = $row['user_name']; // Get User Name

    // If there is no Token Ridercting to Login Page
    if ($result->num_rows == 0) {
        header('location:login.php');
    }
    $db->close();
}

$token = $_SESSION['token']; // Saving Token Value for Next Step
$db = dbConn();
$sql = "SELECT * FROM tbl_user WHERE reset_token='$token'";
$result = $db->query($sql);
$row = $result->fetch_assoc();
$userName = $row['user_name']; // Get User Name

// Cheking Submit button is clicked
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // This function uses array keys as variable names and values as variable values
    extract($_POST);

    // create array
    $message = array();

    // Checking Form Validation
    if (!empty($token)) {
        if (!empty($new_password) && !empty($confirm_password)) {

            //Checking Token is Valid or Not
            $sql = "SELECT reset_token FROM tbl_user WHERE reset_token='$token'";
            $result = $db->query($sql);

            if ($result->num_rows > 0) {

                // Updating Table with Saving New Password
                if ($confirm_password == $new_password) {
                    $sql = "UPDATE tbl_user SET `password`= sha1('$new_password') WHERE user_name='$userName'";
                    $result = $db->query($sql);

                    // If Success Redirecting to the Login Page
                    if ($result) {
                        header('LOCATION: login.php');
                    } else {
                        $_SESSION['status'] = "Something Wrong!";
                        header('LOCATION: reset.php?token=' . $token);
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "Passwords do not Match";
                    header('LOCATION: reset.php?token=' . $token);
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Invalid Token";
                header('LOCATION: reset.php?token=' . $token);
                exit(0);
            }
        } else {
            $_SESSION['status'] = "All Fields are Mandotory";
            header('LOCATION: reset.php?token=' . $token);
            exit(0);
        }
    } else {
        $_SESSION['status'] = "No Token Available";
    }
}
?>

<body>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <?php
                    if (isset($_SESSION['status'])) {
                    ?>
                        <div class="alert alert-danger">
                            <h5><?= $_SESSION['status']; ?></h5>
                        </div>
                    <?php
                        unset($_SESSION['status']);
                    }
                    ?>

                    <div class="card">
                        <div class="card-header">
                            <h5>Change Password</h5>
                        </div>
                        <div class="card-body p-4">
                            <form method="post" class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <div class="form-group mb-3">
                                    <label>New Password</label>
                                    <input type="password" name="new_password" class="form-control" placeholder="Enter Your Password">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Enter Your Password">
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" name="password_update" class="btn btn-success w-100">Update Password</button>
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