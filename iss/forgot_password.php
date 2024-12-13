<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Menggunakan autoloader PHPMailer

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'security'); // Sesuaikan dengan nama database Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    // Cek apakah email ada di database
    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Generate token reset password
        $token = bin2hex(random_bytes(50));
        $token_expiry = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token berlaku selama 1 jam
        
        // Simpan token dan waktu kedaluwarsa di database
        $conn->query("UPDATE users SET reset_token = '$token', token_expiry = '$token_expiry' WHERE email = '$email'");
        
        // Kirim email dengan link reset password
        $mail = new PHPMailer(true);
        
        try {
            // Pengaturan server email
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kameliaaaputri25@gmail.com';
            $mail->Password = 'zone thhf hbmf pibd';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Pengaturan pengirim dan penerima
            $mail->setFrom('kameliaaaputri25@gmail.com', 'kamel cantik');
            $mail->addAddress($email);

            // Konten email
            $reset_link = "http://localhost/iss/reset_password.php?token=$token";
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password';
            $mail->Body    = "Klik <a href='$reset_link'>di sini</a> untuk mereset password Anda.";

            $mail->send();
            echo 'Email reset password telah dikirim.';
        } catch (Exception $e) {
            echo "Pesan tidak dapat dikirim. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Email tidak ditemukan.';
    }
}
?>

<form method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <button type="submit">Kirim Link Reset Password</button>
</form>
