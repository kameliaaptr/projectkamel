<?php
function sendVerificationEmail($email, $token) {
    $subject = "Verifikasi Akun Anda";
    $message = "
        <h1>Verifikasi Akun Anda</h1>
        <p>Klik link di bawah ini untuk memverifikasi akun Anda:</p>
        <a href='https://yourdomain.com/verify.php?token=$token'>Verifikasi Akun</a>
        <p>Link ini hanya berlaku selama 24 jam.</p>
    ";
    $headers = "From: no-reply@yourdomain.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    return mail($email, $subject, $message, $headers);
}
?>