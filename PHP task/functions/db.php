<?php
$servername = "feenix-mariadb.swin.edu.au";
$username = "s103841969";
$password = "Enrol@nchs23";
$dbname = "s103841969_db"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
