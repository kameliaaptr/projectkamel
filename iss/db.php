<?php
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "security";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
