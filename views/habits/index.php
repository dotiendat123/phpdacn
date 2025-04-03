<?php ob_start(); ?>

<div class="max-w-6xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-green-600 flex items-center gap-2">
            <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M9 17v-2a4 4 0 00-4-4H3m6 6h6m6-6a9 9 0 11-18 0 9 9 0 0118 0z"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
            </svg>
            Danh sách thói quen
        </h2>
        <a href="/habits/create"
            class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition shadow">
            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M12 4v16m8-8H4"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
            </svg>
            Thêm thói quen
        </a>
    </div>

    <?php if (!empty($habits)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($habits as $habit): ?>
                <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition border border-gray-100">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($habit['name']) ?></h3>
                        <span class="text-xs font-semibold text-white bg-green-500 px-2 py-0.5 rounded">
                            <?= ucfirst($habit['frequency']) ?>
                        </span>
                    </div>

                    <p class="text-sm text-gray-600 mb-3">
                        <?= htmlspecialchars($habit['description']) ?: 'Không có mô tả.' ?>
                    </p>

                    <div class="text-xs text-gray-500 mb-4">
                        Chuỗi hiện tại: <strong><?= $habit['streak'] ?> ngày</strong>
                        <?php if (!empty($habit['last_completed'])): ?>
                            <br>Hoàn thành gần nhất: <?= date('d/m/Y', strtotime($habit['last_completed'])) ?>
                        <?php endif; ?>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <form method="POST" action="/habits/complete/<?= $habit['id'] ?>">
                            <button type="submit"
                                class="flex items-center justify-center gap-2 w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow text-sm font-medium">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Hoàn thành hôm nay
                            </button>
                        </form>

                        <div class="flex gap-2">
                            <a href="/habits/edit/<?= $habit['id'] ?>"
                                class="flex items-center justify-center gap-2 w-full bg-yellow-400 hover:bg-yellow-500 text-white text-sm px-4 py-2 rounded-lg shadow">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5l2 2L13 12l-2.5.5.5-2.5 7.5-7.5z" />
                                </svg>
                                Sửa
                            </a>

                            <a href="/habits/delete/<?= $habit['id'] ?>" onclick="return confirm('Bạn chắc chắn muốn xóa thói quen này?')"
                                class="flex items-center justify-center gap-2 w-full bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-2 rounded-lg shadow">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Xoá
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-20 bg-white shadow rounded-xl">
            <h3 class="text-lg text-gray-600">Bạn chưa có thói quen nào. Hãy bắt đầu xây dựng!</h3>
        </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
