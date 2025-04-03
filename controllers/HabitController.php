<?php
require_once __DIR__ . '/../models/Habit.php';
require_once __DIR__ . '/../config/database.php';

class HabitController
{
    private $model;

    public function __construct()
    {
        $this->model = new Habit($GLOBALS['pdo']);
    }

    public function index()
    {
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            header('Location: /login');
            exit;
        }

        $habits = $this->model->getAllByUser($userId);
        include __DIR__ . '/../views/habits/index.php';
    }


    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create([
                'user_id' => $_SESSION['user_id'],
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'frequency' => $_POST['frequency']
            ]);
            header('Location: /habits');
            exit;
        }
        include __DIR__ . '/../views/habits/create.php';
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'frequency' => $_POST['frequency']
            ]);
            header('Location: /habits');
            exit;
        }
        $habit = $this->model->getById($id);
        include __DIR__ . '/../views/habits/edit.php';
    }

    public function delete($id)
    {
        $this->model->delete($id);
        header('Location: /habits');
    }

    public function complete($id)
    {
        $this->model->markComplete($id);
        header('Location: /habits');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create([
                'user_id' => $_SESSION['user_id'],
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'frequency' => $_POST['frequency']
            ]);
            header('Location: /habits');
            exit;
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'frequency' => $_POST['frequency']
            ]);
            header('Location: /habits');
            exit;
        }
    }
}
