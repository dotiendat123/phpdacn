<?php ob_start(); ?>

<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
    <h2 class="text-2xl font-bold text-indigo-600 mb-6">➕ Thêm mục tiêu mới</h2>

    <form action="/goals/create" method="POST" class="space-y-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tên mục tiêu</label>
            <input type="text" name="title" required class="w-full px-4 py-2 border rounded focus:ring-indigo-400 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả</label>
            <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded focus:ring-indigo-400 focus:outline-none"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Hạn chót</label>
            <input type="date" name="deadline" required class="w-full px-4 py-2 border rounded focus:ring-indigo-400 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Các bước nhỏ (Milestones)</label>
            <div id="milestone-list" class="space-y-2">
                <input type="text" name="milestones[]" class="w-full px-3 py-2 border rounded" placeholder="Ví dụ: Hoàn thành báo cáo" />
            </div>
            <button type="button" onclick="addMilestone()" class="mt-2 text-sm text-indigo-600 hover:underline">+ Thêm bước</button>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Lưu mục tiêu</button>
        </div>
    </form>
</div>

<script>
    function addMilestone() {
        const container = document.getElementById('milestone-list');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'milestones[]';
        input.placeholder = 'Bước nhỏ tiếp theo';
        input.className = 'w-full px-3 py-2 border rounded';
        container.appendChild(input);
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
