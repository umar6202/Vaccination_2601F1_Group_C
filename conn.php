<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "evaccination_db"; // J database name

//  Create Connection 
$conn = mysqli_connect($host, $username, $password, $database);

// check  Connection 
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
} else {
    echo "  ";
}
?>