<?php
session_start();
include('../config/database.php');

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);

    if (!empty($name) && !empty($price)) {
        $sql = "INSERT INTO items (name, description, price) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssd", $name, $description, $price);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Data berhasil ditambahkan!";
        } else {
            $message = "Gagal menambah data!";
        }

        mysqli_stmt_close($stmt);
    } else {
        $message = "Nama dan Harga wajib diisi!";
    }
}
?>

<?php include('../includes/header.php'); ?>

<div class="form-container">
  <h2>Tambah Data</h2>
  <form method="POST" action="">
    <label>Nama:</label>
    <input type="text" name="name" required>

    <label>Deskripsi:</label>
    <textarea name="description"></textarea>

    <label>Harga:</label>
    <input type="number" name="price" step="0.01" required>

    <button type="submit">Simpan</button>
  </form>

  <p class="message"><?= $message; ?></p>
  <p><a href="dashboard.php">← Kembali ke Dashboard</a></p>
</div>

<?php include('../includes/footer.php'); ?>
