<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'triapujiastuti029@gmail.com'; //SMTP username
    $mail->Password = 'bezeehtlifzqhzlf'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable implicit TLS encryption
    $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('sp_penyakitkehamilan@gmail.com', 'Sistem Pakar Penyakit Pada Ibu Hamil');
    $mail->addAddress($data['email']); //Add a recipient

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Ubah Password Sistem Pakar Penyakit Pada Ibu Hamil';
    $mail->Body = '<p>Klik tombol di bawah <br> Anda akan diarahkan pada halaman ubah password, agar dapat login dengan password baru.</p><a href="http://localhost/sp_kehamilan/ubah_password.php?key=' . $enkripsi_email . '">Klik ini untuk ubah password</a>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    echo "
            <script>
                alert('Berhasil kirim email, silahkan check email');
                document.location.href='login.php';
            </script>
        ";
} catch (Exception $e) {
    echo "
            <script>
                alert('Email gagal dikirim');
               
            </script>
        ";
}

?>