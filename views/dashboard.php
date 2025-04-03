<?php
redirect_if_not_logged_in();
ob_start();
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
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 min-h-[50vh]">

    <!-- Công việc -->
    <div class="transform transition hover:scale-105 duration-300 bg-gradient-to-br from-white to-blue-50 p-6 rounded-2xl shadow-md border border-blue-100">
        <div class="flex items-center gap-3 mb-4">
            <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5h6M9 3h6a2 2 0 012 2v1h1a2 2 0 012 2v11a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h1V5a2 2 0 012-2z" />
            </svg>
            <h2 class="text-xl font-bold text-blue-700">Công việc</h2>
        </div>

        <p class="text-gray-700 mb-2">Bạn có <strong>3</strong> công việc cần làm hôm nay.</p>
        <ul class="text-sm text-gray-600 list-disc pl-5 space-y-1 mb-3">
            <li><strong>Ưu tiên:</strong> Hoàn thành báo cáo tuần</li>
            <li>2 việc quá hạn</li>
            <li>1 việc mới được thêm</li>
        </ul>

        <div class="mb-4 text-sm">
            <div class="bg-gray-200 h-3 rounded-full overflow-hidden">
                <div class="bg-blue-500 h-3 rounded-full w-[75%]"></div>
            </div>
            <p class="text-gray-500 mt-1">Hoàn thành 75% công việc hôm nay</p>
        </div>

        <a href="/tasks" class="text-blue-600 hover:underline text-sm font-semibold">→ Xem danh sách công việc</a>
    </div>

    <!-- Thói quen -->
    <div class="transform transition hover:scale-105 duration-300 bg-gradient-to-br from-white to-green-50 p-6 rounded-2xl shadow-md border border-green-100">
        <div class="flex items-center gap-3 mb-4">
            <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3M5 11h14M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <h2 class="text-xl font-bold text-green-700">Thói quen</h2>
        </div>

        <p class="text-gray-700 mb-2">Đã hoàn thành <strong>2/5</strong> thói quen hôm nay.</p>
        <ul class="text-sm text-gray-600 list-disc pl-5 space-y-1 mb-3">
            <li><span class="text-green-500">✔</span> Uống nước đủ</li>
            <li><span class="text-green-500">✔</span> Dậy sớm</li>
            <li><span class="text-yellow-500">⌛</span> Thiền & đọc sách</li>
        </ul>

        <p class="text-xs text-gray-500 mt-2">🔥 Đang duy trì chuỗi <strong>3 ngày</strong></p>
        <a href="/habits" class="text-green-600 hover:underline text-sm font-semibold block mt-2">→ Xem danh sách thói quen</a>
    </div>

    <!-- Mục tiêu -->
    <div class="transform transition hover:scale-105 duration-300 bg-gradient-to-br from-white to-pink-50 p-6 rounded-2xl shadow-md border border-pink-100">
        <div class="flex items-center gap-3 mb-4">
            <svg class="w-6 h-6 text-pink-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3M12 2a10 10 0 110 20 10 10 0 010-20z" />
            </svg>
            <h2 class="text-xl font-bold text-pink-700">Mục tiêu</h2>
        </div>
        <p class="text-gray-700 mb-2">Bạn đang theo dõi <strong>4</strong> mục tiêu cá nhân.</p>
        <ul class="text-sm text-gray-600 list-disc pl-5 space-y-1">
            <li>💸 Tiết kiệm 5 triệu/tháng</li>
            <li>📖 Đọc 12 cuốn sách/năm</li>
            <li>🖥 Học xong khoá ReactJS</li>
        </ul>
        <a href="/goals" class="text-pink-600 hover:underline text-sm font-semibold block mt-2">→ Xem danh sách mục tiêu</a>
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
