<?php
require_once __DIR__ . '/../config/database.php';

class Task
{
    public static function create($user_id, $title, $description, $due_date, $priority)
    {
        $pdo = $GLOBALS['pdo'];
        $stmt = $pdo->prepare("INSERT INTO tasks (user_id, title, description, due_date, priority)
                               VALUES (:user_id, :title, :description, :due_date, :priority)");
        $stmt->execute([
            ':user_id' => $user_id,
            ':title' => $title,
            ':description' => $description,
            ':due_date' => $due_date,
            ':priority' => $priority
        ]);
    }

    public static function getAll($user_id, $filter = null, $sort = 'due_date')
    {
        $pdo = $GLOBALS['pdo'];
        $query = "SELECT * FROM tasks WHERE user_id = :user_id";

        if ($filter === 'today') {
            $query .= " AND DATE(due_date) = CURDATE()";
        } elseif ($filter === 'week') {
            $query .= " AND WEEK(due_date) = WEEK(CURDATE())";
        } elseif ($filter === 'done') {
            $query .= " AND status = 'hoàn thành'";
        }

        $query .= " ORDER BY $sort ASC";

        $stmt = $pdo->prepare($query);
        $stmt->execute([':user_id' => $user_id]);

        return $stmt->fetchAll();
    }

    public static function find($id)
    {
        $pdo = $GLOBALS['pdo'];
        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public static function update($id, $title, $description, $due_date, $priority)
    {
        $pdo = $GLOBALS['pdo'];
        $stmt = $pdo->prepare("UPDATE tasks SET title = :title, description = :description,
                               due_date = :due_date, priority = :priority WHERE id = :id");
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':due_date' => $due_date,
            ':priority' => $priority,
            ':id' => $id
        ]);
    }

    public static function updateStatus($id, $status)
    {
        $pdo = $GLOBALS['pdo'];
        $stmt = $pdo->prepare("UPDATE tasks SET status = :status WHERE id = :id");
        $stmt->execute([
            ':status' => $status,
            ':id' => $id
        ]);
    }

    public static function delete($id)
    {
        $pdo = $GLOBALS['pdo'];
        $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
    // Lấy danh sách task sắp đến hạn trong vòng 1 giờ
    // Lấy danh sách task sắp đến hạn trong vòng 1 giờ
    public static function getUpcomingTasks($interval = '+1 hour')
    {
        $pdo = $GLOBALS['pdo'];

        $now = date('Y-m-d H:i:s');
        $upcoming = date('Y-m-d H:i:s', strtotime($interval));

        // Debug in console xem có đúng thời gian không
        echo "⏱️ Giờ hiện tại: $now<br>";
        echo "⏳ Giới hạn đến: $upcoming<br>";

        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE due_date BETWEEN :now AND :upcoming AND status = 'chưa hoàn thành'");
        $stmt->execute([
            ':now' => $now,
            ':upcoming' => $upcoming
        ]);

        $results = $stmt->fetchAll();

        // Debug luôn kết quả truy vấn
        echo "🧪 Số task lấy được: " . count($results) . "<br>";

        return $results;
    }
}
