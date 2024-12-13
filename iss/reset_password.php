<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'security'); // Sesuaikan dengan nama database Anda

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Cek apakah token ada di database dan belum kadaluarsa
    $result = $conn->query("SELECT * FROM users WHERE reset_token = '$token' AND token_expiry > NOW()");
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Tampilkan form untuk mereset password
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_password = $_POST['password'];

            // Hash password baru
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            
            // Update password dan reset token di database
            $conn->query("UPDATE users SET password = '$hashed_password', reset_token = NULL, token_expiry = NULL WHERE id = " . $user['id']);
            
            echo 'Password Anda telah direset. Silakan login.';
        }
    } else {
        echo 'Token tidak valid atau telah kadaluarsa.';
    }
} else {
    echo 'Token tidak ditemukan.';
}
?>

<form method="post">
    <label for="password">Password Baru:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Reset Password</button>
</form>
