<?php
// Database connection
$servername = "localhost";  // your DB host
$username = "root";         // your DB username
$password = "";             // your DB password
$dbname = "alumni"; // your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>