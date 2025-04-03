<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

// Hàm gửi email tiện ích với Mailtrap
function sendEmail($to, $subject, $body)
{
    $mail = new PHPMailer(true);
    try {
        // Cấu hình SMTP Mailtrap
        $mail->isSMTP();
        $mail->Host       = 'sandbox.smtp.mailtrap.io';  // SMTP host Mailtrap
        $mail->SMTPAuth   = true;
        $mail->Username   = '9e00c6100de7b7';    // Mailtrap username
        $mail->Password   = '7beae4e8d0fb7e';    // Mailtrap password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 2525;

        $mail->CharSet    = 'UTF-8'; // 👈 Thêm dòng này để hỗ trợ tiếng Việt
        // Gửi mail
        $mail->setFrom('noreply@productivity-app.test', 'Productivity App');
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mail Error: {$mail->ErrorInfo}");
        return false;
    }
}


function is_logged_in()
{
    return isset($_SESSION['user_id']);
}

function redirect_if_not_logged_in()
{
    if (!is_logged_in()) {
        header("Location: /login");
        exit;
    }
}
