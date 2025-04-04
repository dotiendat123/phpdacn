<?php

// Đăng nhập người dùng
function login()
{
    global $pdo;
    ob_start();

    $error = '';

    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     $email = trim($_POST['email'] ?? '');
    //     $password = $_POST['password'] ?? '';

    //     // Tìm người dùng theo email
    //     $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    //     $stmt->execute([$email]);
    //     $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //     // Kiểm tra mật khẩu
    //     if ($user && password_verify($password, $user['password'])) {
    //         $_SESSION['user_id'] = $user['id'];
    //         require_once __DIR__ . '/../cron/send_task_reminders.php';
    //         header("Location: /dashboard");
    //         exit;
    //     } else {
    //         $error = "Email hoặc mật khẩu không đúng!";
    //     }
    // }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Kết nối và tìm người dùng theo email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];

            // ✅ Gửi mail nhắc việc (nếu có thể), nhưng không dừng nếu lỗi
            try {
                require_once __DIR__ . '/../cron/send_task_reminders.php';
            } catch (Throwable $e) {
                // Ghi log lỗi nếu cần (không ảnh hưởng chuyển hướng)
                error_log("Lỗi gửi mail nhắc việc: " . $e->getMessage());
            }

            // ✅ Luôn chuyển hướng về dashboard dù mail gửi thành công hay không
            header("Location: /dashboard");
            exit;
        } else {
            $error = "Email hoặc mật khẩu không đúng!";
        }
    }


    include BASE_PATH . '/views/auth/login.php';
}

// Đăng ký người dùng mới
function register()
{
    global $pdo;
    ob_start();

    $success = '';
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Kiểm tra dữ liệu
        if (empty($email) || empty($password)) {
            $error = "Vui lòng nhập đầy đủ thông tin.";
        } else {
            // Kiểm tra email đã tồn tại
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->fetch()) {
                $error = "Email đã tồn tại. Vui lòng dùng email khác.";
            } else {
                // Mã hoá mật khẩu
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Lưu vào database
                $insert = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
                if ($insert->execute([$email, $hashedPassword])) {
                    $success = "Đăng ký thành công! Bạn có thể đăng nhập.";
                } else {
                    $error = "Có lỗi xảy ra khi đăng ký.";
                }
            }
        }
    }

    include BASE_PATH . '/views/auth/register.php';
}
