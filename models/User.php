<?php

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Tìm user theo email
    public function getByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    // Tạo user mới
    public function create($email, $password)
    {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        return $stmt->execute([$email, $hashed]);
    }

    // Tìm user theo ID
    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Cập nhật email hoặc mật khẩu
    public function update($id, $email, $password = null)
    {
        if ($password) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
            return $stmt->execute([$email, $hashed, $id]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
            return $stmt->execute([$email, $id]);
        }
    }
}
