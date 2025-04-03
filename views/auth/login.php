<?php
ob_start();
?>

<!-- Phần logo + tiêu đề -->
<div class="text-center mb-6">
    <h1 class="text-3xl font-bold text-blue-600">ĐĂNG NHẬP</h1>
    <p class="text-gray-500 text-sm mt-1">Đăng nhập để bắt đầu công việc của bạn</p>
</div>

<!-- Thông báo lỗi nếu có -->
<?php if (!empty($error)): ?>
    <p class="bg-red-100 text-red-700 p-3 mb-4 rounded text-sm text-center shadow-sm">
        <?= htmlspecialchars($error) ?>
    </p>
<?php endif; ?>

<!-- Form đăng nhập -->
<form method="POST" action="/login" class="space-y-4 bg-white p-6 rounded-2xl shadow-md">
    <input type="email" name="email" placeholder="Nhập email..." required
        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">

    <input type="password" name="password" placeholder="Nhập mật khẩu..." required
        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">

    <button type="submit"
        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">
        Đăng nhập
    </button>
</form>

<!-- Link chuyển sang đăng ký -->
<p class="text-sm mt-4 text-center text-gray-600">
    Chưa có tài khoản?
    <a href="/register" class="text-blue-600 hover:underline font-medium">Đăng ký ngay</a>
</p>

<?php
$content = ob_get_clean();
include BASE_PATH . '/views/layouts/auth.php';
