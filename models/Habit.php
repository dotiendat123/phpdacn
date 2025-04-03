<?php

class Habit
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllByUser($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM habits WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($user_id, $name, $frequency)
    {
        $stmt = $this->pdo->prepare("INSERT INTO habits (user_id, name, frequency) VALUES (?, ?, ?)");
        return $stmt->execute([$user_id, $name, $frequency]);
    }
}
