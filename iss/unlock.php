<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];  // Ganti username menjadi email

    // Cek apakah email ada
    $sql = "SELECT * FROM users WHERE email='$email'";  // Ganti username dengan email
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Reset failed_attempt
        $reset_attempt = "UPDATE users SET failed_attempt=0, last_attempt=NULL WHERE email='$email'";  // Ganti username dengan email
        if ($conn->query($reset_attempt)) {
            echo "<script>alert('Akun berhasil direset. Silakan login kembali.'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal mereset akun.');</script>";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Reset Akun Terkunci</title>
</head>
<body>
    <div class="form-container">
        <h2>Reset Akun Terkunci</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>  <!-- Ganti username dengan email -->
            <button type="submit">Reset</button>
            <p><a href="index.php">Kembali ke Login</a></p>
        </form>
    </div>
</body>
</html>
