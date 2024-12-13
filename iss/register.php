<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];  // Ganti username dengan email
    $password = $_POST['password'];
    $recaptcha_response = $_POST['g-recaptcha-response'];

    // Verifikasi reCAPTCHA
    $secret_key = "6LcLYpYqAAAAAAeVN9ROV_AoM7ev-qYHW9rKeLeQ";
    $verify_url = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($verify_url . "?secret=" . $secret_key . "&response=" . $recaptcha_response);
    $response_data = json_decode($response);

    if (!$response_data->success) {
        echo "<script>alert('Verifikasi reCAPTCHA gagal!');</script>";
        exit;
    }

    // Validasi password
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        echo "<script>alert('Password harus memiliki minimal 8 karakter, termasuk huruf kapital, angka, dan simbol!');</script>";
    } else {
        // Hash password sebelum disimpan
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Cek apakah email sudah digunakan
        $check_user = "SELECT * FROM users WHERE email='$email'";  // Ganti username dengan email
        $result = $conn->query($check_user);

        if ($result->num_rows > 0) {
            echo "<script>alert('Email sudah terdaftar! Silakan gunakan email lain.');</script>";
        } else {
            // Tambahkan data user ke tabel
            $sql = "INSERT INTO users (email, password, failed_attempt) VALUES ('$email', '$hashed_password', 0)";  // Ganti username dengan email
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='index.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Register</title>
</head>
<body>
    <div class="form-container">
        <h2>Register</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required> <!-- Ganti username dengan email -->
            <input type="password" name="password" placeholder="Password" required>
            <!-- Tambahkan reCAPTCHA -->
            <div class="g-recaptcha" data-sitekey="6LcLYpYqAAAAAJ3lZsDvO_txC4ZMkRH9ooBzOVhZ"></div>
            <button type="submit">Register</button>
            <p>Sudah punya akun? <a href="index.php">Login</a></p>
        </form>
    </div>
</body>
</html>
