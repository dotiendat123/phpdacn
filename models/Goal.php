<?php

class Goal
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllByUser($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM goals WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($user_id, $title, $description)
    {
        $stmt = $this->pdo->prepare("INSERT INTO goals (user_id, title, description) VALUES (?, ?, ?)");
        return $stmt->execute([$user_id, $title, $description]);
    }
}
