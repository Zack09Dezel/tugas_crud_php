<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include('../config/database.php');
include('../includes/header.php');

$result = mysqli_query($conn, "SELECT * FROM barang ORDER BY id DESC");
?>

<div class="content">
    <h3>Selamat Datang, <?= $_SESSION['username']; ?>!</h3>
    <h4>Daftar Inventaris Barang</h4>
    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_barang']; ?></td>
            <td>Rp <?= number_format($row['harga']); ?></td>
            <td><?= $row['stok']; ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id']; ?>">Edit</a> | 
                <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include('../includes/footer.php'); ?>