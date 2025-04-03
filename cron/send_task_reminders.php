<?php
// // require_once __DIR__ . '/config/database.php';
// // require_once __DIR__ . '/includes/functions.php';
// // require_once __DIR__ . '/models/Task.php';
// // require_once __DIR__ . '/models/User.php';

// require_once __DIR__ . '/../config/database.php';
// require_once __DIR__ . '/../includes/functions.php';
// require_once __DIR__ . '/../models/Task.php';
// require_once __DIR__ . '/../models/User.php';



// // Lấy các task sắp đến hạn
// $tasks = Task::getUpcomingTasks('+1 hour');

// if (empty($tasks)) {
//     echo "❗ Không có task nào sắp đến hạn trong vòng 1 giờ.";
//     exit;
// }

// foreach ($tasks as $task) {
//     $user_email = User::getEmailById($task['user_id']);

//     if ($user_email) {
//         $subject = "🔔 Nhắc việc: " . $task['title'];
//         $body = "
//             <h2>Chào bạn!</h2>
//             <p>Bạn có công việc sắp đến hạn: <strong>{$task['title']}</strong></p>
//             <p><strong>Hạn chót:</strong> " . date('H:i d/m/Y', strtotime($task['due_date'])) . "</p>
//             <p><strong>Mức ưu tiên:</strong> " . ucfirst($task['priority']) . "</p>
//             <p>" . nl2br($task['description']) . "</p>
//             <hr>
//             <p style='color:gray;'>Email này được gửi từ ứng dụng <strong>Productivity App</strong>.</p>
//         ";

//         $sent = sendEmail($user_email, $subject, $body);

//         echo $sent
//             ? "✅ Đã gửi nhắc việc tới: $user_email<br>"
//             : "❌ Gửi mail thất bại cho: $user_email<br>";
//     } else {
//         echo "⚠️ Không tìm thấy email người dùng ID: {$task['user_id']}<br>";
//     }
// }




try {
    require_once __DIR__ . '/../config/database.php';
    require_once __DIR__ . '/../includes/functions.php';
    require_once __DIR__ . '/../models/Task.php';
    require_once __DIR__ . '/../models/User.php';

    // Lấy các task sắp đến hạn
    $tasks = Task::getUpcomingTasks('+1 hour');

    if (empty($tasks)) {
        echo "❗ Không có task nào sắp đến hạn trong vòng 1 giờ.<br>";
        return;
    }

    foreach ($tasks as $task) {
        $user_email = User::getEmailById($task['user_id']);

        if ($user_email) {
            $subject = "🔔 Nhắc việc: " . $task['title'];
            $body = "
                <h2>Chào bạn!</h2>
                <p>Bạn có công việc sắp đến hạn: <strong>{$task['title']}</strong></p>
                <p><strong>Hạn chót:</strong> " . date('H:i d/m/Y', strtotime($task['due_date'])) . "</p>
                <p><strong>Mức ưu tiên:</strong> " . ucfirst($task['priority']) . "</p>
                <p>" . nl2br($task['description']) . "</p>
                <hr>
                <p style='color:gray;'>Email này được gửi từ ứng dụng <strong>Productivity App</strong>.</p>
            ";

            $sent = sendEmail($user_email, $subject, $body);

            echo $sent
                ? "✅ Đã gửi nhắc việc tới: $user_email<br>"
                : "❌ Gửi mail thất bại cho: $user_email<br>";
        } else {
            echo "⚠️ Không tìm thấy email người dùng ID: {$task['user_id']}<br>";
        }
    }
} catch (Throwable $e) {
    // Ghi log lỗi nếu có bất kỳ lỗi nào xảy ra, nhưng không làm vỡ luồng chương trình
    error_log("[Nhắc việc] Lỗi: " . $e->getMessage());
    echo "⚠️ Đã xảy ra lỗi trong quá trình gửi nhắc việc, nhưng chương trình vẫn tiếp tục.<br>";
}
