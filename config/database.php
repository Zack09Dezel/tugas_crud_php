<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // default kosong di XAMPP
$db   = 'crud_db';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
