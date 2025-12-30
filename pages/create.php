<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include('../config/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO barang (nama_barang, harga, stok) VALUES ('$nama', '$harga', '$stok')";
    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php");
    }
}
include('../includes/header.php');
?>

<div class="form-container">
    <h3>Tambah Barang Baru</h3>
    <form method="POST">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" required>
        <label>Harga</label>
        <input type="number" name="harga" required>
        <label>Stok</label>
        <input type="number" name="stok" required>
        <button type="submit">Simpan</button>
    </form>
</div>

<?php include('../includes/footer.php'); ?>