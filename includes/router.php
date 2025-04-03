<?php
// Đảm bảo BASE_PATH được định nghĩa
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

// Gọi hàm tiện ích (nếu chưa được gọi từ index.php)
require_once BASE_PATH . '/includes/functions.php';

// Lấy URI hiện tại (chỉ phần path)
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// ROUTER
switch ($uri) {
    case '/':
    case '/dashboard':
        redirect_if_not_logged_in();
        require_once BASE_PATH . '/views/dashboard.php';
        break;

    // TASKS
    case '/tasks':
        require_once BASE_PATH . '/controllers/TaskController.php';
        $controller = new TaskController();
        $controller->index();
        break;

    case '/tasks/create':
        require_once BASE_PATH . '/controllers/TaskController.php';
        $controller = new TaskController();
        $controller->create();
        break;

    case '/tasks/store':
        require_once BASE_PATH . '/controllers/TaskController.php';
        $controller = new TaskController();
        $controller->store();
        break;

    case (preg_match('#^/tasks/edit/(\d+)$#', $uri, $matches) ? true : false):
        require_once BASE_PATH . '/controllers/TaskController.php';
        $controller = new TaskController();
        $controller->edit($matches[1]);
        break;

    case (preg_match('#^/tasks/update/(\d+)$#', $uri, $matches) ? true : false):
        require_once BASE_PATH . '/controllers/TaskController.php';
        $controller = new TaskController();
        $controller->update($matches[1]);
        break;

    case '/task/status':
        require_once BASE_PATH . '/controllers/TaskController.php';
        $controller = new TaskController();
        $controller->toggleStatus();
        break;

    case (preg_match('#^/tasks/delete/(\d+)$#', $uri, $matches) ? true : false):
        require_once BASE_PATH . '/controllers/TaskController.php';
        $controller = new TaskController();
        $controller->delete($matches[1]);
        break;


    // HABITS
    // HABITS
    case '/habits':
        require_once BASE_PATH . '/controllers/HabitController.php';
        $controller = new HabitController();
        $controller->index();
        break;

    case '/habits/create':
        require_once BASE_PATH . '/controllers/HabitController.php';
        $controller = new HabitController();
        $controller->create(); // Hiển thị form thêm
        break;

    case '/habits/store':
        require_once BASE_PATH . '/controllers/HabitController.php';
        $controller = new HabitController();
        $controller->store(); // Xử lý lưu dữ liệu mới (POST)
        break;

    case (preg_match('#^/habits/edit/(\d+)$#', $uri, $matches) ? true : false):
        require_once BASE_PATH . '/controllers/HabitController.php';
        $controller = new HabitController();
        $controller->edit($matches[1]); // Hiển thị form chỉnh sửa
        break;

    case (preg_match('#^/habits/update/(\d+)$#', $uri, $matches) ? true : false):
        require_once BASE_PATH . '/controllers/HabitController.php';
        $controller = new HabitController();
        $controller->update($matches[1]); // Xử lý cập nhật (POST)
        break;

    case (preg_match('#^/habits/delete/(\d+)$#', $uri, $matches) ? true : false):
        require_once BASE_PATH . '/controllers/HabitController.php';
        $controller = new HabitController();
        $controller->delete($matches[1]);
        break;

    case (preg_match('#^/habits/complete/(\d+)$#', $uri, $matches) ? true : false):
        require_once BASE_PATH . '/controllers/HabitController.php';
        $controller = new HabitController();
        $controller->complete($matches[1]);
        break;

    // GOALS
    case '/goals':
        redirect_if_not_logged_in();
        require_once BASE_PATH . '/controllers/GoalController.php';
        listGoals();
        break;

    case '/goals/create':
        redirect_if_not_logged_in();
        require_once BASE_PATH . '/controllers/GoalController.php';
        createGoal();
        break;

    // AI Assistant
    case '/ai/assistant':
        redirect_if_not_logged_in();
        require_once BASE_PATH . '/views/ai/assistant.php';
        break;

    // AUTH
    case '/login':
        require_once BASE_PATH . '/controllers/AuthController.php';
        login();
        break;

    case '/register':
        require_once BASE_PATH . '/controllers/AuthController.php';
        register();
        break;

    case '/logout':
        session_destroy();
        header("Location: /login");
        exit;

        // 404
    default:
        http_response_code(404);
        echo "<h1 style='text-align:center;margin-top:40px;'>404 - Không tìm thấy trang</h1>";
        break;
}
