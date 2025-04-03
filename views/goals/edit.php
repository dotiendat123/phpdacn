<?php ob_start(); ?>

<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
    <h2 class="text-2xl font-bold text-indigo-600 mb-6">✏️ Chỉnh sửa mục tiêu</h2>

    <form action="/goals/edit/<?= $goal['id'] ?>" method="POST" class="space-y-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tên mục tiêu</label>
            <input type="text" name="title" value="<?= htmlspecialchars($goal['title']) ?>" required
                class="w-full px-4 py-2 border rounded focus:ring-indigo-400 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả</label>
            <textarea name="description" rows="3"
                class="w-full px-4 py-2 border rounded focus:ring-indigo-400 focus:outline-none"><?= htmlspecialchars($goal['description']) ?></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Hạn chót</label>
            <input type="date" name="deadline" value="<?= $goal['deadline'] ?>"
                class="w-full px-4 py-2 border rounded focus:ring-indigo-400 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Các bước nhỏ</label>
            <ul class="space-y-2">
                <?php foreach ($milestones as $m): ?>
                    <li class="flex items-center gap-2 text-sm">
                        <input type="checkbox" <?= $m['is_completed'] ? 'checked' : '' ?>
                            onchange="location.href='/goals/milestone/<?= $m['id'] ?>/<?= $m['is_completed'] ? 0 : 1 ?>'">
                        <?= htmlspecialchars($m['title']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="flex justify-between">
            <a href="/goals" class="text-gray-500 text-sm hover:underline">← Quay lại</a>
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Cập nhật</button>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
