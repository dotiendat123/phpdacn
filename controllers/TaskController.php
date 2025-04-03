<?php
require_once BASE_PATH . '/models/Task.php';

class TaskController
{
    public function index()
    {
        $user_id = $_SESSION['user_id'];
        $filter = $_GET['filter'] ?? null;
        $sort = $_GET['sort'] ?? 'due_date';

        $tasks = Task::getAll($user_id, $filter, $sort);

        $title = "Quản lý Công việc";
        ob_start();
        include BASE_PATH . '/views/tasks/index.php';
        $content = ob_get_clean();

        include BASE_PATH . '/views/layouts/main.php';
    }

    public function create()
    {
        $title = "Thêm công việc mới";

        ob_start();
        include BASE_PATH . '/views/tasks/create.php'; // form
        $content = ob_get_clean();

        include BASE_PATH . '/views/layouts/main.php'; // layout tổng
    }

    public function store()
    {
        // Đảm bảo người dùng đã đăng nhập
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        // Lấy dữ liệu từ form
        $user_id = $_SESSION['user_id'];
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $due_date = $_POST['due_date'] ?? null;
        $priority = $_POST['priority'] ?? 'trung bình';

        // Kiểm tra dữ liệu hợp lệ (có thể thêm validate nâng cao nếu cần)
        if (empty($title) || empty($due_date)) {
            // Quay lại form nếu thiếu dữ liệu bắt buộc
            header('Location: /tasks/create');
            exit;
        }

        // Gọi model để lưu vào cơ sở dữ liệu
        require_once BASE_PATH . '/models/Task.php';
        Task::create($user_id, $title, $description, $due_date, $priority);

        // Chuyển hướng về danh sách công việc
        header('Location: /tasks');

        exit;
    }



    public function edit($id)
    {
        $task = Task::find($id);

        if (!$task) {
            echo "Không tìm thấy công việc.";
            return;
        }

        $title = "Chỉnh sửa công việc";

        ob_start();
        include BASE_PATH . '/views/tasks/edit.php';
        $content = ob_get_clean();

        include BASE_PATH . '/views/layouts/main.php'; // 🟢 Layout chính có Tailwind
    }


    public function update($id)
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $due_date = $_POST['due_date'];
        $priority = $_POST['priority'];

        Task::update($id, $title, $description, $due_date, $priority);

        header("Location: /tasks");
    }

    public function toggleStatus()
    {
        $id = $_POST['id'];
        $status = $_POST['status'];

        Task::updateStatus($id, $status);
    }

    public function delete($id)
    {
        Task::delete($id);
        header("Location: /tasks");
    }
}
