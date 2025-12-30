<?php
include('../config/database.php');

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Enkripsi password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Simpan ke database
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Registrasi berhasil! Silakan login.";
        } else {
            $message = "Username sudah digunakan!";
        }

        mysqli_stmt_close($stmt);
    } else {
        $message = "Semua field harus diisi!";
    }
}
?>

<?php include('../includes/header.php'); ?>

<div class="form-container">
  <h2>Register</h2>
  <form action="" method="POST">
    <label>Username</label>
    <input type="text" name="username" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit">Daftar</button>
  </form>

  <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
  <p class="message"><?= $message; ?></p>
</div>

<?php include('../includes/footer.php'); ?>
