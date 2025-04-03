<?php
ob_start();
?>

<!-- Phần logo + tiêu đề -->
<div class="text-center mb-6">
    <h1 class="text-3xl font-bold text-green-600">Tạo tài khoản</h1>
    <p class="text-gray-500 text-sm mt-1">Bắt đầu hành trình năng suất của bạn</p>
</div>

<!-- Thông báo lỗi hoặc thành công -->
<?php if (!empty($error)): ?>
    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 text-sm text-center shadow-sm">
        <?= htmlspecialchars($error) ?>
    </div>
<?php elseif (!empty($success)): ?>
    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 text-sm text-center shadow-sm">
        <?= htmlspecialchars($success) ?>
    </div>
<?php endif; ?>

<!-- Form đăng ký -->
<form method="POST" action="/register" class="space-y-4 bg-white p-6 rounded-2xl shadow-md">
    <input type="email" name="email" placeholder="Nhập email..." required
        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">

    <input type="password" name="password" placeholder="Tạo mật khẩu..." required
        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">

    <button type="submit"
        class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-lg transition">
        Đăng ký
    </button>
</form>

<!-- Link quay về đăng nhập -->
<p class="text-sm mt-4 text-center text-gray-600">
    Đã có tài khoản?
    <a href="/login" class="text-blue-600 hover:underline font-medium">Đăng nhập ngay</a>
</p>

<?php
$content = ob_get_clean();
include BASE_PATH . '/views/layouts/auth.php';
