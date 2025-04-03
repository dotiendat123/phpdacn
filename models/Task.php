<?php

class Task
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllByUser($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($user_id, $title, $due_date)
    {
        $stmt = $this->pdo->prepare("INSERT INTO tasks (user_id, title, due_date) VALUES (?, ?, ?)");
        return $stmt->execute([$user_id, $title, $due_date]);
    }

    public function update($id, $title, $due_date)
    {
        $stmt = $this->pdo->prepare("UPDATE tasks SET title = ?, due_date = ? WHERE id = ?");
        return $stmt->execute([$title, $due_date, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
