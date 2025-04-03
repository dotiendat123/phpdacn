<?php

class History
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function log($user_id, $action, $description)
    {
        $stmt = $this->pdo->prepare("INSERT INTO history (user_id, action, description, created_at) VALUES (?, ?, ?, NOW())");
        return $stmt->execute([$user_id, $action, $description]);
    }

    public function getByUser($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM history WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
