<?php
ob_start();
?>

<h2 class="text-xl font-semibold mb-4">🎯 Dashboard</h2>

<div class="bg-white p-6 rounded-lg shadow-md">
    <p class="text-gray-700">
        Chào mừng bạn đến với <strong class="text-blue-500">Productivity App</strong>!
        Đây là nơi bạn có thể quản lý công việc, thói quen, và mục tiêu cá nhân một cách hiệu quả.
    </p>

    <div class="mt-6">
        <a href="#" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded transition">
            ➕ Tạo công việc mới
        </a>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'views/layouts/main.php';
?>