<?php
class Goal
{
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function getAllByUser($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM goals WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM goals WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getMilestones($goal_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM milestones WHERE goal_id = ?");
        $stmt->execute([$goal_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO goals (user_id, title, description, deadline) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $data['user_id'],
            $data['title'],
            $data['description'],
            $data['deadline']
        ]);
        return $this->db->lastInsertId();
    }

    public function addMilestone($goal_id, $title)
    {
        $stmt = $this->db->prepare("INSERT INTO milestones (goal_id, title) VALUES (?, ?)");
        return $stmt->execute([$goal_id, $title]);
    }

    public function markMilestone($milestone_id, $status)
    {
        $stmt = $this->db->prepare("UPDATE milestones SET is_completed = ? WHERE id = ?");
        return $stmt->execute([$status, $milestone_id]);
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE goals SET title = ?, description = ?, deadline = ? WHERE id = ?");
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['deadline'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM goals WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public static function forUser($userId)
    {
        $pdo = require BASE_PATH . '/config/database.php';

        $stmt = $pdo->prepare("SELECT id, title, description FROM goals WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
