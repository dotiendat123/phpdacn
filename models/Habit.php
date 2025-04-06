<?php
class Habit
{
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function getAllByUser($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM habits WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM habits WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO habits (user_id, name, description, frequency) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['user_id'],
            $data['name'],
            $data['description'],
            $data['frequency']
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE habits SET name = ?, description = ?, frequency = ? WHERE id = ?");
        return $stmt->execute([
            $data['name'],
            $data['description'],
            $data['frequency'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM habits WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function markComplete($id)
    {
        $stmt = $this->db->prepare("UPDATE habits SET streak = streak + 1, last_completed = CURDATE() WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function forUser($userId)
    {
        $pdo = require BASE_PATH . '/config/database.php';

        $stmt = $pdo->prepare("SELECT * FROM habits WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
