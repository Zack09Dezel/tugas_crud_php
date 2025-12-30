<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include('../config/database.php');

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM barang WHERE id = $id");
$row = mysqli_fetch_assoc($data);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "UPDATE barang SET nama_barang='$nama', harga='$harga', stok='$stok' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php");
    }
}
include('../includes/header.php');
?>

<div class="form-container">
    <h3>Edit Barang</h3>
    <form method="POST">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" value="<?= $row['nama_barang']; ?>" required>
        <label>Harga</label>
        <input type="number" name="harga" value="<?= $row['harga']; ?>" required>
        <label>Stok</label>
        <input type="number" name="stok" value="<?= $row['stok']; ?>" required>
        <button type="submit">Update Data</button>
    </form>
</div>

<?php include('../includes/footer.php'); ?>