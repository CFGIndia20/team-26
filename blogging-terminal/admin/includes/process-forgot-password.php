<?php
include_once("admin_connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('../../vendor/autoload.php');

if (isset($_POST['forgot_password'])) {
    $email = $_POST['email'];
    $query = "SELECT * FROM users WHERE email = '{$email}'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));
        $query = "UPDATE users SET token='{$token}' WHERE email='{$email}'";
        $result = mysqli_query($connection, $query);

        //code to send email
        $to = $email;
        $subject = "RESET PASSWORD!!";
//
        $message = "To reset your password please click the below link<br>";
        $message .= "<a href='http://localhost/blog-template/admin/reset.php?token={$token}'>http://localhost/blog-template/admin/reset.php?token={$token}</a>";

        $mail = new PHPMailer();

        $mail->isSMTP();

        $mail->Host = "smtp.mailtrap.io";
        $mail->SMTPAuth = true;
        $mail->Username = "536acd19f4529f";
        $mail->Password = "c506216d8333dd";

        $mail->SMTPSecure = 'tls';
        $mail->Port = 2525;

        $mail->setFrom("no-reply@admin.com", "Blog CMS");
        $mail->addAddress($to);
        $mail->Subject = $subject;

        $mail->isHTML(true);

        $mail->Body = $message;
        if ($mail->send()) {
            echo "Message sent";
        } else {
            echo "message not sent";
            echo "<br>";
            echo "some error" . $mail->ErrorInfo;
        }


    }


}