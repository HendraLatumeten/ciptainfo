<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "vendor/autoload.php";
$mail = new PHPMailer(true);
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = 'ssl://smtp.gmail.com';
$mail->SMTPAuth = true;
//ganti dengan email dan password yang akan di gunakan sebagai email pengirim
$mail->Username = 'hendrawyt34@gmail.com';
$mail->Password = 'yvabhflofpkagjtn';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
//ganti dengan email yg akan di gunakan sebagai email pengirim
$mail->setFrom('hendrawyt34@gmail.com', 'CIPTA INFO');
$mail->addAddress($_POST['email'], $_POST['nama']);
$mail->isHTML(true);
$mail->Subject = "CIPTA INFO 'Aktivasi Pelanggan'";
$mail->Body = "Selemat, anda berhasil membuat akun di CIPTA INFO. Untuk mengaktifkan akun anda silahkan klik link dibawah ini.
 <a href='http://localhost/ciptainfo/activation.php?t=".$token."'>http://localhost/ciptainfo/activation.php?t=".$token."</a>  ";
$mail->send();
echo 'Message has been sent';