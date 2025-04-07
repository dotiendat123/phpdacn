<?php
// session_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
redirect_if_not_logged_in();
ob_start();

//  Gọi và nhận biến `$conn` từ database.php
$conn = require __DIR__ . '/../config/database.php';

require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../models/Habit.php';
require_once __DIR__ . '/../models/Goal.php';

$user_id = $_SESSION['user_id'] ?? 1;

// Lấy dữ liệu công việc
$tasks = Task::getTodayTasks($conn, $user_id);
$totalTasks = count($tasks);
$completedTasks = Task::countCompletedToday($conn, $user_id);
$taskProgress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

// Lấy dữ liệu thói quen
$habits = Habit::getTodayHabits($conn, $user_id);
$totalHabits = count($habits);
$completedHabits = Habit::countCompletedToday($conn, $user_id);
$habitStreak = Habit::getStreak($conn, $user_id);

// Lấy dữ liệu mục tiêu
$goals = Goal::getGoals($conn, $user_id);
$totalGoals = count($goals);
?>


<!-- Tiêu đề -->
<div class="text-center mb-10">
    <h1 class="text-4xl font-extrabold text-blue-600 flex items-center justify-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a8 8 0 11-16 0 8 8 0 0116 0z" />
        </svg>
        <span>Tổng quan hôm nay</span>
    </h1>
    <p class="text-gray-500 mt-2 text-base">Cập nhật hiệu suất mỗi ngày để cải thiện bản thân</p>
</div>

<!-- Thẻ chính -->


<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
    <!-- Công việc -->
    <div class="bg-blue-50 p-5 rounded-2xl shadow">
        <h2 class="text-blue-600 font-bold text-xl flex items-center">
            🗂️ Công việc
        </h2>
        <p class="mt-2">Bạn có <strong><?= $totalTasks ?></strong> công việc cần làm hôm nay.</p>
        <ul class="text-sm mt-2 list-disc pl-5">
            <?php if (!empty($tasks)): ?>
                <li><strong>Ưu tiên:</strong> <?= htmlspecialchars($tasks[0]['title']) ?></li>
                <?php if ($totalTasks > 1): ?>
                    <li><?= $totalTasks - 1 ?> việc khác</li>
                <?php endif; ?>
            <?php else: ?>
                <li>Không có công việc nào hôm nay.</li>
            <?php endif; ?>
        </ul>
        <div class="w-full h-3 bg-gray-200 rounded-full mt-3">
            <div class="h-3 bg-blue-500 rounded-full" style="width: <?= $taskProgress ?>%;"></div>
        </div>
        <p class="text-sm mt-1 text-gray-600">Hoàn thành <?= $taskProgress ?>% công việc hôm nay</p>
        <a href="/views/tasks/index.php" class="text-blue-600 text-sm mt-2 inline-block">→ Xem danh sách công việc</a>
    </div>

    <!-- Thói quen -->
    <div class="bg-green-50 p-5 rounded-2xl shadow">
        <h2 class="text-green-700 font-bold text-xl flex items-center">
            📅 Thói quen
        </h2>
        <p class="mt-2">Đã hoàn thành <strong><?= $completedHabits ?>/<?= $totalHabits ?></strong> thói quen hôm nay.</p>
        <ul class="text-sm mt-2 list-disc pl-5">
            <?php foreach ($habits as $habit): ?>
                <li>
                    <?= $habit['last_completed'] === date('Y-m-d') ? '✅' : '⏳' ?>
                    <?= htmlspecialchars($habit['name']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="text-sm mt-2 text-orange-500">🔥 Đang duy trì chuỗi <strong><?= $habitStreak ?></strong> ngày</p>
        <a href="/views/habits/index.php" class="text-green-700 text-sm mt-2 inline-block">→ Xem danh sách thói quen</a>
    </div>

    <!-- Mục tiêu -->
    <div class="bg-pink-50 p-5 rounded-2xl shadow">
        <h2 class="text-pink-600 font-bold text-xl flex items-center">
            ⏰ Mục tiêu
        </h2>
        <p class="mt-2">Bạn đang theo dõi <strong><?= $totalGoals ?></strong> mục tiêu cá nhân.</p>
        <ul class="text-sm mt-2 list-disc pl-5">
            <?php foreach (array_slice($goals, 0, 3) as $goal): ?>
                <li>🎯 <?= htmlspecialchars($goal['title']) ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="/views/goals/index.php" class="text-pink-600 text-sm mt-2 inline-block">→ Xem danh sách mục tiêu</a>
    </div>
</div>


<!-- Trợ lý AI và Nút thêm -->
<div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Widget AI -->
    <div class="bg-gradient-to-br from-purple-50 to-white p-6 rounded-2xl shadow border border-purple-100">
        <div class="flex items-center gap-2 mb-2">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            <h2 class="text-lg font-semibold text-purple-700">Trợ lý AI – Gợi ý hôm nay</h2>
        </div>
        <p class="text-sm text-gray-700 italic">
            Bạn nên tập trung hoàn thành báo cáo, tập thể dục 30 phút và dành 15 phút để thiền. Đừng quên nghỉ ngơi đủ nhé 🌿
        </p>
    </div>

    <!-- Nút thêm nhanh -->
    <div class="bg-white p-6 rounded-2xl shadow border flex items-center justify-around">
        <a href="/tasks/create" class="bg-blue-100 hover:bg-blue-200 text-blue-700 font-semibold px-4 py-2 rounded-lg transition">+ Công việc</a>
        <a href="/habits/create" class="bg-green-100 hover:bg-green-200 text-green-700 font-semibold px-4 py-2 rounded-lg transition">+ Thói quen</a>
        <a href="/goals/create" class="bg-pink-100 hover:bg-pink-200 text-pink-700 font-semibold px-4 py-2 rounded-lg transition">+ Mục tiêu</a>
    </div>
</div>


<?php
$content = ob_get_clean();
include BASE_PATH . '/views/layouts/main.php';
