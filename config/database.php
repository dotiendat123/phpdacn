<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

// $host = 'localhost';
// $db   = 'productivity_app';
// $user = 'root';       // mặc định XAMPP là root
// $pass = '123456';     // nếu bạn chưa đặt password thì để rỗng
// $charset = 'utf8mb4';

// $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// try {
//     $pdo = new PDO($dsn, $user, $pass, [
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//     ]);

//     // Kết nối thành công
//     // echo "Kết nối database thành công!";
// } catch (PDOException $e) {
//     // Kết nối thất bại
//     die("Kết nối database thất bại: " . $e->getMessage());
// }


$host = 'localhost';
$db   = 'productivity_app';
$user = 'root';       // mặc định XAMPP là root
$pass = '123456';     // nếu chưa có mật khẩu thì để chuỗi rỗng ''
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // Biến toàn cục để các class có thể dùng
    $GLOBALS['pdo'] = $pdo;

    // echo "Kết nối database thành công!";
} catch (PDOException $e) {
    die("Kết nối database thất bại: " . $e->getMessage());
}
