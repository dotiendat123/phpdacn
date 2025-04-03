<?php
redirect_if_not_logged_in();
ob_start();
?>

<!-- Tiêu đề tổng quan -->
<div class="text-center mb-10">
    <h1 class="text-4xl font-extrabold text-blue-600 flex items-center justify-center gap-2">
        📈 <span>Tổng quan hôm nay</span>
    </h1>
    <p class="text-gray-500 mt-2 text-base">Cập nhật hiệu suất mỗi ngày để cải thiện bản thân 🌱</p>
</div>

<!-- Card thống kê -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 min-h-[55vh]">
    <!-- Công việc -->
    <div class="bg-gradient-to-br from-white to-blue-50 p-6 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 border border-blue-100">
        <div class="flex items-center gap-3 mb-4">
            <span class="text-2xl">📝</span>
            <h2 class="text-xl font-bold text-blue-700">Công việc</h2>
        </div>
        <p class="text-gray-700 mb-4">Hôm nay bạn có <strong>3</strong> công việc cần làm.</p>
        <ul class="text-sm text-gray-600 list-disc pl-5 space-y-1">
            <li><span class="font-medium">Ưu tiên:</span> Hoàn thành báo cáo tuần</li>
            <li>Còn 2 việc quá hạn</li>
            <li>1 việc mới được thêm</li>
        </ul>
        <a href="/tasks" class="mt-4 inline-block text-blue-600 hover:underline text-sm font-semibold">→ Xem danh sách công việc</a>
    </div>

    <!-- Thói quen -->
    <div class="bg-gradient-to-br from-white to-green-50 p-6 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 border border-green-100">
        <div class="flex items-center gap-3 mb-4">
            <span class="text-2xl">📅</span>
            <h2 class="text-xl font-bold text-green-700">Thói quen</h2>
        </div>
        <p class="text-gray-700 mb-4">Bạn đã hoàn thành <strong>2/5</strong> thói quen hôm nay.</p>
        <ul class="text-sm text-gray-600 list-disc pl-5 space-y-1">
            <li>✅ Uống nước đủ</li>
            <li>✅ Dậy sớm</li>
            <li>⏳ Thiền & đọc sách còn thiếu</li>
        </ul>
        <a href="/habits" class="mt-4 inline-block text-green-600 hover:underline text-sm font-semibold">→ Xem danh sách thói quen</a>
    </div>

    <!-- Mục tiêu -->
    <div class="bg-gradient-to-br from-white to-pink-50 p-6 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 border border-pink-100">
        <div class="flex items-center gap-3 mb-4">
            <span class="text-2xl">🎯</span>
            <h2 class="text-xl font-bold text-pink-700">Mục tiêu</h2>
        </div>
        <p class="text-gray-700 mb-4">Bạn đang theo dõi <strong>4</strong> mục tiêu cá nhân.</p>
        <ul class="text-sm text-gray-600 list-disc pl-5 space-y-1">
            <li>💰 Tiết kiệm 5 triệu/tháng</li>
            <li>📚 Đọc 12 cuốn sách/năm</li>
            <li>💻 Học xong khoá ReactJS</li>
        </ul>
        <a href="/goals" class="mt-4 inline-block text-pink-600 hover:underline text-sm font-semibold">→ Xem danh sách mục tiêu</a>
    </div>
</div>



<?php
$content = ob_get_clean();
include BASE_PATH . '/views/layouts/main.php';
