<?php ob_start(); ?>

<div class="flex justify-center mt-12 px-4">
    <div class="w-full max-w-xl bg-white shadow-md rounded-xl p-6">
        <h2 class="text-2xl font-bold text-indigo-600 mb-6 text-center flex items-center justify-center gap-2">
            👤 Chỉnh sửa hồ sơ cá nhân
        </h2>

        <!-- Hộp thông báo -->
        <div id="messageBox" class="hidden mb-4 px-4 py-2 rounded text-sm font-medium text-center"></div>

        <form id="profileForm" class="space-y-5">
            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" required
                    value="<?= htmlspecialchars($user['email']) ?>"
                    class="w-full px-4 py-2 border rounded focus:ring-indigo-400 focus:outline-none shadow-sm">
            </div>

            <!-- Mật khẩu -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Đổi mật khẩu (tuỳ chọn)</label>
                <input type="password" name="password" placeholder="Mật khẩu mới"
                    class="w-full px-4 py-2 border rounded focus:ring-indigo-400 focus:outline-none mb-2 shadow-sm">
                <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu"
                    class="w-full px-4 py-2 border rounded focus:ring-indigo-400 focus:outline-none shadow-sm">
            </div>

            <!-- Nút -->
            <div class="flex justify-center">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-md shadow transition">
                    Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('profileForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);
        const messageBox = document.getElementById('messageBox');

        const res = await fetch('/user/update', {
            method: 'POST',
            body: formData
        });

        const data = await res.json();

        messageBox.classList.remove('hidden');
        if (data.success) {
            messageBox.textContent = data.message;
            messageBox.className = 'mb-4 px-4 py-2 rounded text-sm font-medium text-green-700 bg-green-100 border border-green-300 text-center';
        } else {
            messageBox.textContent = data.message;
            messageBox.className = 'mb-4 px-4 py-2 rounded text-sm font-medium text-red-700 bg-red-100 border border-red-300 text-center';
        }
    });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
