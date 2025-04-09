<?php ob_start(); ?>

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow-lg">
    <h2 class="text-3xl font-bold text-indigo-600 mb-6 flex items-center gap-2">
        <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
        </svg>
        Thêm mục tiêu mới
    </h2>

    <form action="/goals/create" method="POST" class="space-y-6">
        <!-- Tên mục tiêu -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tên mục tiêu</label>
            <input type="text" name="title" id="goal-title" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
        </div>

        <!-- Mô tả -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả</label>
            <textarea name="description" rows="3"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none"></textarea>
        </div>

        <!-- Hạn chót -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Hạn chót</label>
            <input type="date" name="deadline" required
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
        </div>

        <!-- Gợi ý từ AI -->
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="flex justify-between items-center mb-2">
                <label class="text-sm font-medium text-gray-700">🎯 Gợi ý các bước nhỏ từ AI</label>
                <button type="button" onclick="getAISuggestions()"
                    class="text-sm bg-indigo-100 px-3 py-1 rounded hover:bg-indigo-200 text-indigo-700 border border-indigo-300">
                    🤖 Gợi ý từ tên mục tiêu
                </button>
            </div>
            <ul id="ai-suggestions" class="list-disc pl-5 text-sm text-gray-700 space-y-1"></ul>
            <input type="hidden" name="suggested_steps_json" id="suggested-steps-json">
            <div id="ai-status" class="text-sm text-gray-500 mt-2"></div>
        </div>

        <!-- Milestones thủ công -->
        <div>
            <div class="flex items-center justify-between mb-1">
                <label class="text-sm font-medium text-gray-700">Các bước nhỏ thủ công</label>
                <button type="button" onclick="addMilestone()"
                    class="text-sm text-indigo-600 hover:underline">+ Thêm bước</button>
            </div>
            <div id="milestone-list" class="space-y-2">
                <input type="text" name="milestones[]" class="w-full px-3 py-2 border rounded"
                    placeholder="Ví dụ: Hoàn thành bài đọc tuần 1">
            </div>
        </div>

        <!-- Nút submit -->
        <div class="flex justify-end pt-4">
            <button type="submit"
                class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                💾 Lưu mục tiêu
            </button>
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

    async function getAISuggestions() {
        const title = document.getElementById('goal-title').value.trim();
        const status = document.getElementById('ai-status');
        const suggestionList = document.getElementById('ai-suggestions');
        const hiddenInput = document.getElementById('suggested-steps-json');

        if (!title) {
            alert("Vui lòng nhập tên mục tiêu trước khi gợi ý.");
            return;
        }

        suggestionList.innerHTML = '';
        status.innerHTML = '⏳ Đang gợi ý từ AI...';

        try {
            const response = await fetch('/controllers/AISuggestionGoalController.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    action: 'suggest_steps',
                    goal_title: title
                })
            });

            const data = await response.json();
            const steps = data.steps || [];

            if (steps.length > 0) {
                steps.forEach(step => {
                    const li = document.createElement('li');
                    li.textContent = step;
                    suggestionList.appendChild(li);
                });
                hiddenInput.value = JSON.stringify(steps);
                status.innerHTML = '✅ Đã gợi ý xong.';
            } else {
                status.innerHTML = '⚠️ Không có gợi ý từ AI.';
            }
        } catch (error) {
            console.error(error);
            status.innerHTML = '❌ Lỗi khi gọi API gợi ý.';
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>