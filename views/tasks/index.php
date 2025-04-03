<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        Công việc của bạn
    </h2>
    <a href="/tasks/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow inline-flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Thêm công việc
    </a>
</div>

<form method="GET" class="flex gap-3 mb-6 flex-wrap">
    <select name="filter" class="p-2 rounded border bg-white shadow-sm">
        <option value="">Tất cả</option>
        <option value="today">Hôm nay</option>
        <option value="week">Tuần này</option>
        <option value="done">Đã hoàn thành</option>
    </select>
    <select name="sort" class="p-2 rounded border bg-white shadow-sm">
        <option value="due_date">Theo thời hạn</option>
        <option value="priority">Theo ưu tiên</option>
        <option value="status">Theo trạng thái</option>
    </select>
    <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 shadow">Lọc</button>
</form>

<?php if (empty($tasks)): ?>
    <div class="flex flex-col justify-center items-center h-60 text-gray-500 text-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-3 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-4-4H4m16 6v-2a4 4 0 00-4-4h-1m-4-5a2 2 0 114 0 2 2 0 01-4 0z" />
        </svg>
        Không có công việc nào!
    </div>
<?php else: ?>
    <div class="space-y-4">
        <?php foreach ($tasks as $task): ?>
            <div class="p-4 bg-white rounded-lg shadow flex justify-between items-start border-l-4
                <?= $task['priority'] === 'cao' ? 'border-red-500' : ($task['priority'] === 'trung bình' ? 'border-yellow-400' : 'border-green-400') ?>">
                <div class="flex gap-3">
                    <input type="checkbox" class="task-checkbox accent-green-600 mt-1" data-id="<?= $task['id'] ?>"
                        <?= $task['status'] === 'hoàn thành' ? 'checked' : '' ?>>
                    <div>
                        <h3 class="<?= $task['status'] === 'hoàn thành' ? 'line-through text-gray-400' : 'font-semibold text-gray-800' ?>">
                            <?= htmlspecialchars($task['title']) ?>
                        </h3>
                        <p class="text-sm text-gray-600"><?= nl2br(htmlspecialchars($task['description'])) ?></p>
                        <p class="text-xs text-gray-400 mt-1">
                            ⏰ <?= date('d/m/Y H:i', strtotime($task['due_date'])) ?> |
                            Ưu tiên: <?= $task['priority'] ?> |
                            Trạng thái: <?= $task['status'] ?>
                        </p>
                    </div>
                </div>
                <div class="text-sm text-right space-y-1">
                    <a href="/tasks/edit/<?= $task['id'] ?>" class="text-blue-600 hover:underline flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z" />
                        </svg>
                        Sửa
                    </a>
                    <a href="/tasks/delete/<?= $task['id'] ?>" onclick="return confirm('Xoá công việc này?')" class="text-red-500 hover:underline flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Xoá
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<script>
    document.querySelectorAll('.task-checkbox').forEach(cb => {
        cb.addEventListener('change', function() {
            fetch('/task/status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=${this.dataset.id}&status=${this.checked ? 'hoàn thành' : 'chưa hoàn thành'}`
            });
        });
    });
</script>