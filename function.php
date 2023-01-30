<!-- Form Values Cleaning Section -->
<?php
function clean_input($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    return $input;
}

//db connection
function dbConn()
{
    //create variables to connect db
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "waj";

    //create mysqli connection object
    $conn = new mysqli($server, $username, $password, $dbname);

    //check db connection has error
    if ($conn->connect_error) {
        die("connection Error :" . $conn->connect_error);
    } else {
        return $conn;
    }
}

?>