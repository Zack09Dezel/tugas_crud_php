<?php
session_start();
include('../config/database.php');
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Cek apakah username ada di database
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Password salah!";
        }
    } else {
        $message = "Username tidak ditemukan!";
    }

    mysqli_stmt_close($stmt);
}
?>

<?php include('../includes/header.php'); ?>

<div class="form-container">
  <h2>Login</h2>
  <form action="" method="POST">
    <label>Username</label>
    <input type="text" name="username" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
  </form>

  <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
  <p class="message"><?= $message; ?></p>
</div>

<?php include('../includes/footer.php'); ?>
