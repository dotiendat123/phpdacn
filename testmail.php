<?php
require_once __DIR__ . '/includes/functions.php';

$to = 'test@example.com';
$subject = '📬 Thử nghiệm gửi mail bằng tiếng Việt';
$body = '
    <h2>Chào bạn!</h2>
    <p>Đây là email thử nghiệm gửi bằng <strong>PHPMailer</strong> sử dụng Mailtrap.</p>
    <p>Nội dung này hỗ trợ <strong>Tiếng Việt</strong> đầy đủ.</p>
    <hr>
    <p style="color:gray;">Được gửi từ ứng dụng <strong>Productivity App</strong>.</p>
';

if (sendEmail($to, $subject, $body)) {
    echo "✅ Gửi email thành công! Hãy kiểm tra Mailtrap.";
} else {
    echo "❌ Gửi email thất bại!";
}
