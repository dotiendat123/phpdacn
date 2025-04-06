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
            class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition shadow">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M12 4v16m8-8H4"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
            </svg>
            Thêm thói quen
        </a>
    </div>

    <!-- GỢI Ý THÓI QUEN TỪ MỤC TIÊU ĐÃ CÓ -->
    <div class="bg-white border border-gray-200 p-5 rounded-lg shadow mb-10">
        <h3 class="text-lg font-semibold text-gray-800 mb-2"> Gợi ý thói quen từ mục tiêu đã có</h3>
        <div class="flex items-center gap-3">
            <select id="goalSelect"
                class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm">
                <option value="">-- Chọn một mục tiêu --</option>
                <?php foreach ($goals as $goal): ?>
                    <option value="<?= htmlspecialchars($goal['description'] ?: $goal['title']) ?>">
                        <?= htmlspecialchars($goal['title']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button id="btnSuggestFromGoal"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">
                Gợi ý
            </button>
        </div>
        <ul id="habitSuggestionsFromGoal" class="list-disc pl-6 text-gray-700 mt-4"></ul>
        <!-- Kết quả trả lời AI -->
        <div id="aiSuggestionReply" class="bg-gray-50 rounded p-3 text-sm text-gray-800 mt-4 border border-gray-200 min-h-[40px] flex items-center"></div>
    </div>


    <!-- DANH SÁCH THÓI QUEN -->
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
                                Xóa
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

<script>
    document.getElementById('btnSuggestFromGoal').addEventListener('click', async () => {
        const goalSelect = document.getElementById('goalSelect');
        const list = document.getElementById('habitSuggestionsFromGoal');
        const replyBox = document.getElementById('aiSuggestionReply');
        const goal = goalSelect.value.trim();

        if (!goal) {
            alert('Vui lòng chọn một mục tiêu.');
            return;
        }

        list.innerHTML = '';
        replyBox.innerHTML = '<span class="text-gray-500">⏳ Đang gợi ý...</span>';

        const formData = new FormData();
        formData.append("goal", goal);

        try {
            const res = await fetch('/habits/suggest-ai', {
                method: 'POST',
                body: formData
            });

            const data = await res.json();

            if (data.habits && data.habits.length > 0) {
                list.innerHTML = '';
                data.habits.forEach(habit => {
                    const li = document.createElement('li');
                    li.textContent = habit;
                    list.appendChild(li);
                });
                replyBox.innerHTML = '<span class="text-green-600">✅ Đã gợi ý thành công các thói quen.</span>';
            } else {
                replyBox.innerHTML = '<span class="text-red-500">Không có gợi ý.</span>';
            }
        } catch (err) {
            replyBox.innerHTML = '<span class="text-red-500">Đã xảy ra lỗi khi gọi AI.</span>';
        }
    });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
