<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];  // Ubah username menjadi email
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

    // Ambil data pengguna berdasarkan email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");  // Ganti username dengan email
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Periksa apakah pengguna terkunci
        if ($user['failed_attempt'] >= 5) {
            $last_attempt_time = strtotime($user['last_attempt']);
            $current_time = time();
            $time_diff = $current_time - $last_attempt_time;

            if ($time_diff < 30) {
                $remaining_time = 30 - $time_diff;
                echo "<script>alert('Akun terkunci! Coba lagi dalam $remaining_time detik.');</script>";
                exit;
            } else {
                // Reset failed_attempt setelah 30 detik
                $reset_attempt = $conn->prepare("UPDATE users SET failed_attempt = 0 WHERE email = ?");  // Ganti username dengan email
                $reset_attempt->bind_param("s", $email);
                $reset_attempt->execute();
            }
        }

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Login berhasil, reset failed_attempt
            $reset_attempt = $conn->prepare("UPDATE users SET failed_attempt = 0 WHERE email = ?");  // Ganti username dengan email
            $reset_attempt->bind_param("s", $email);
            $reset_attempt->execute();

            $_SESSION['email'] = $user['email'];  // Ganti username dengan email
            echo "<script>alert('Login berhasil!'); window.location.href='welcome.php';</script>";
        } else {
            // Login gagal, increment failed_attempt
            $increment_attempt = $conn->prepare("UPDATE users SET failed_attempt = failed_attempt + 1, last_attempt = NOW() WHERE email = ?");  // Ganti username dengan email
            $increment_attempt->bind_param("s", $email);
            $increment_attempt->execute();

            // Ambil nilai percobaan gagal setelah increment
            $remaining_attempts = 5 - ($user['failed_attempt'] + 1);
            if ($remaining_attempts > 0) {
                echo "<script>alert('Password salah! Anda memiliki $remaining_attempts percobaan lagi.');</script>";
            } else {
                echo "<script>alert('Akun terkunci! Coba lagi dalam 30 detik.');</script>";
            }
        }
    } else {
        echo "<script>alert('Email tidak ditemukan!');</script>";
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
    <title>Login</title>
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>  <!-- Ganti username dengan email -->
            <input type="password" name="password" placeholder="Password" required>
            <!-- Tambahkan reCAPTCHA -->
            <div class="g-recaptcha" data-sitekey="6LcLYpYqAAAAAJ3lZsDvO_txC4ZMkRH9ooBzOVhZ"></div>
            <button type="submit">Login</button>
            <p>Belum punya akun? <a href="register.php">Register</a></p>
            <p>Lupa akses? <a href="forgot_password.php">Ganti password</a></p>
            <p>Akun terkunci? <a href="unlock.php">Reset akun terkunci</a></p>
        </form>
    </div>
</body>
</html>
