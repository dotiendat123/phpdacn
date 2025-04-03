<?php
$host = 'localhost';
$db   = 'productivity_app';
$user = 'root';       // mặc định XAMPP là root
$pass = '123456';           // nếu bạn chưa đặt password thì để rỗng
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Kết nối database thất bại: " . $e->getMessage());
}
