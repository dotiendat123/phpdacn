<?php ob_start(); ?>

<div class="max-w-6xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
            🎯 Danh sách mục tiêu
        </h2>
        <a href="/goals/create"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition shadow">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4v16m8-8H4"></path>
            </svg>
            Thêm mục tiêu
        </a>

    </div>

    <?php if (!empty($goals)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($goals as $goal): ?>
                <?php
                $milestones = (new Goal($GLOBALS['pdo']))->getMilestones($goal['id']);
                $total = count($milestones);
                $completed = count(array_filter($milestones, fn($m) => $m['is_completed']));
                $progress = $total > 0 ? round(($completed / $total) * 100) : 0;
                ?>
                <div class="bg-white p-5 rounded-xl shadow border">
                    <h3 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($goal['title']) ?></h3>
                    <p class="text-sm text-gray-600 mb-2"><?= htmlspecialchars($goal['description']) ?></p>
                    <p class="text-xs text-gray-400 mb-2">Hạn chót: <?= date('d/m/Y', strtotime($goal['deadline'])) ?></p>

                    <div class="mb-4">
                        <div class="w-full bg-gray-200 h-3 rounded-full">
                            <div class="h-3 bg-indigo-600 rounded-full" style="width: <?= $progress ?>%;"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Tiến độ: <?= $progress ?>%</p>
                    </div>

                    <div class="flex justify-between text-sm">
                        <a href="/goals/edit/<?= $goal['id'] ?>" class="text-indigo-600 hover:underline">✏️ Sửa</a>
                        <a href="/goals/delete/<?= $goal['id'] ?>" class="text-red-500 hover:underline"
                            onclick="return confirm('Xoá mục tiêu này?')">🗑️ Xoá</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="bg-white text-center py-16 rounded-xl shadow">
            <p class="text-gray-500 text-lg">Chưa có mục tiêu nào được tạo.</p>
        </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
