<?php

//define db connection
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

// Function for show sweet alert message inside php files
function showMessage(){
    $alert = "Swal.fire(
        'Recorded',
        'Data Saved in Data Base Successfully',
        'success'
      )";

      echo "<script>";
      echo "window.onload = (event) => {";
      echo $alert;
      echo "}";
      echo "</script>";
}

?>