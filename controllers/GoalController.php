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
}
