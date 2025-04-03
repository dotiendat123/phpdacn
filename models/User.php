<?php

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($email, $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        return $stmt->execute([$email, password_hash($password, PASSWORD_DEFAULT)]);
    }
    // Lấy email theo ID user
    public static function getEmailById($user_id)
    {
        $pdo = $GLOBALS['pdo']; // 👈 Lấy kết nối PDO toàn cục

        $stmt = $pdo->prepare("SELECT email FROM users WHERE id = :id");
        $stmt->execute([':id' => $user_id]);

        $result = $stmt->fetch();

        return $result ? $result['email'] : null;
    }
}
