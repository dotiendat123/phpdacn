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
        redirect_if_not_logged_in();
        require_once BASE_PATH . '/controllers/TaskController.php';
        listTasks();
        break;

    case '/tasks/create':
        redirect_if_not_logged_in();
        require_once BASE_PATH . '/controllers/TaskController.php';
        createTask();
        break;

    case '/tasks/edit':
        redirect_if_not_logged_in();
        require_once BASE_PATH . '/controllers/TaskController.php';
        editTask();
        break;

    // HABITS
    case '/habits':
        redirect_if_not_logged_in();
        require_once BASE_PATH . '/controllers/HabitController.php';
        listHabits();
        break;

    case '/habits/create':
        redirect_if_not_logged_in();
        require_once BASE_PATH . '/controllers/HabitController.php';
        createHabit();
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
