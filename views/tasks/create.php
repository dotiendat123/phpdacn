<div class="max-w-xl mx-auto mt-8 bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-blue-600 flex items-center gap-2 mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Thêm công việc mới
    </h2>

    <form method="POST" action="/tasks/store" class="space-y-5">

        <!-- Tiêu đề -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề</label>
            <input type="text" name="title" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Nhập tiêu đề công việc" />
        </div>

        <!-- Mô tả -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả</label>
            <textarea name="description" rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Nhập mô tả chi tiết"></textarea>
        </div>

        <!-- Hạn chót -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Thời hạn</label>
            <div class="flex items-center gap-2">
                <input type="datetime-local" name="due_date" id="due_date" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />

            </div>
        </div>

        <!-- Ưu tiên -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Mức độ ưu tiên</label>
            <select name="priority"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">
                <option value="cao"> Cao</option>
                <option value="trung bình" selected> Trung bình</option>
                <option value="thấp"> Thấp</option>
            </select>
        </div>

        <!-- Gửi -->
        <div class="pt-4">
            <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-150 shadow">
                Tạo công việc
            </button>
        </div>
    </form>
</div>

<script>
    function suggestDeadline() {
        const desc = document.querySelector('textarea[name="description"]').value;
        if (!desc.trim()) {
            alert('Vui lòng nhập mô tả để AI có thể gợi ý thời gian!');
            return;
        }

        fetch('/ai/suggest-deadline', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `description=${encodeURIComponent(desc)}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.suggested_due_date) {
                    document.getElementById('due_date').value = data.suggested_due_date;
                }
            });
    }
</script>