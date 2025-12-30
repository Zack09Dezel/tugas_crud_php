<?php
session_start();
include('../config/database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM barang WHERE id = $id");
}
header("Location: dashboard.php");
?>