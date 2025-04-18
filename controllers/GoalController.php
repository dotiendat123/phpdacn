<?php
require_once __DIR__ . '/../models/Goal.php';
require_once __DIR__ . '/../config/database.php';

class GoalController
{
    private $model;

    public function __construct()
    {
        $this->model = new Goal($GLOBALS['pdo']);
    }

    public function index()
    {
        $goals = $this->model->getAllByUser($_SESSION['user_id']);
        include __DIR__ . '/../views/goals/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $goal_id = $this->model->create([
                'user_id' => $_SESSION['user_id'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'deadline' => $_POST['deadline']
            ]);

            // Thêm milestones nếu có
            foreach ($_POST['milestones'] as $milestone) {
                if (trim($milestone) !== '') {
                    $this->model->addMilestone($goal_id, $milestone);
                }
            }

            header('Location: /goals');
            exit;
        }
        include __DIR__ . '/../views/goals/create.php';
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'deadline' => $_POST['deadline']
            ]);
            header('Location: /goals');
            exit;
        }

        $goal = $this->model->getById($id);
        $milestones = $this->model->getMilestones($id);
        include __DIR__ . '/../views/goals/edit.php';
    }

    public function delete($id)
    {
        $this->model->delete($id);
        header('Location: /goals');
    }

    public function toggleMilestone($id, $status)
    {
        $this->model->markMilestone($id, $status);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    public function store()
    {
        session_start();
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            header('Location: /auth/login');
            exit;
        }

        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $deadline = $_POST['deadline'] ?? '';
        $manualMilestones = $_POST['milestones'] ?? [];
        $suggestedStepsJson = $_POST['suggested_steps_json'] ?? '[]';

        if (empty($title) || empty($deadline)) {
            $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin";
            header('Location: /goals/create');
            exit;
        }

        // Tạo mục tiêu
        $goalId = Goal::create([
            'user_id' => $userId,
            'title' => $title,
            'description' => $description,
            'deadline' => $deadline,
        ]);

        // Thêm các milestones thủ công
        foreach ($manualMilestones as $step) {
            if (trim($step)) {
                Goal::addMilestone($goalId, trim($step));
            }
        }

        // Thêm các bước nhỏ được gợi ý từ AI
        $aiSteps = json_decode($suggestedStepsJson, true);
        foreach ($aiSteps as $step) {
            if (trim($step)) {
                Goal::addMilestone($goalId, trim($step));
            }
        }

        $_SESSION['success'] = "Mục tiêu đã được tạo cùng các bước nhỏ";
        header('Location: /goals');
    }
}
