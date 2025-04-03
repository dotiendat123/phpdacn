<?php ob_start(); ?>

<div class="max-w-xl mx-auto mt-10 bg-white p-6 shadow-lg rounded-2xl">
    <h2 class="text-2xl font-bold text-blue-600 flex items-center gap-2 mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Thêm thói quen mới
    </h2>

    <form action="/habits/store" method="POST" class="space-y-5">

        <!-- Tên thói quen -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tên thói quen</label>
            <input type="text" name="name" required
                class="w-full px-4 py-2 border border-gray-400 rounded-md shadow-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500
                          placeholder:text-sm"
                placeholder="Nhập tên thói quen...">
        </div>

        <!-- Mô tả -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả</label>
            <textarea name="description" rows="3"
                class="w-full px-4 py-2 border border-gray-400 rounded-md shadow-sm
                             focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500
                             placeholder:text-sm"
                placeholder="Ví dụ: Dậy sớm lúc 6h sáng, đọc sách 15 phút..."></textarea>
        </div>

        <!-- Tần suất -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tần suất</label>
            <select name="frequency"
                class="w-full px-4 py-2 border border-gray-400 rounded-md shadow-sm
                           bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                <option value="daily">Hàng ngày</option>
                <option value="weekly">Hàng tuần</option>
                <option value="monthly">Hàng tháng</option>
            </select>
        </div>

        <!-- Gửi -->
        <div class="flex justify-end pt-2">
            <button type="submit"
                class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 shadow font-medium transition">
                Lưu thói quen
            </button>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
