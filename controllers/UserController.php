<?php
require_once './config/database.php'; // Trả về $pdo
require_once './models/User.php';

class UserController
{
    public function index()
    {
        session_start();
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            header('Location: /auth/login');
            exit;
        }

        $pdo = require './config/database.php';
        $userModel = new User($pdo);
        $user = $userModel->find($userId);

        include './views/user/index.php';
    }

    public function edit()
    {
        // session_start();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            header('Location: /auth/login');
            exit;
        }

        $pdo = require './config/database.php';
        $userModel = new User($pdo);
        $user = $userModel->find($userId);

        include './views/user/edit.php';
    }

    public function update()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        header('Content-Type: application/json');

        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            echo json_encode(['success' => false, 'message' => 'Chưa đăng nhập']);
            return;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['password_confirmation'] ?? '';

        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Email không hợp lệ']);
            return;
        }

        if (!empty($password) && $password !== $confirm) {
            echo json_encode(['success' => false, 'message' => 'Mật khẩu xác nhận không khớp']);
            return;
        }

        $pdo = require './config/database.php';
        $userModel = new User($pdo);
        $success = $userModel->update($userId, $email, $password ?: null);

        if ($success) {
            echo json_encode(['success' => true, 'message' => '✅ Cập nhật thành công!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Cập nhật thất bại!']);
        }
    }
}
