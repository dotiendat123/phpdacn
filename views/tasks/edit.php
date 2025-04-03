<div class="max-w-xl mx-auto mt-8 bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-green-600 flex items-center gap-2 mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
        </svg>
        Chỉnh sửa công việc
    </h2>

    <form method="POST" action="/tasks/update/<?= $task['id'] ?>" class="space-y-5">

        <!-- Tiêu đề -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề</label>
            <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400"
                placeholder="Nhập tiêu đề công việc" />
        </div>

        <!-- Mô tả -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả</label>
            <textarea name="description" rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400"
                placeholder="Nhập mô tả chi tiết"><?= htmlspecialchars($task['description']) ?></textarea>
        </div>

        <!-- Hạn chót -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Thời hạn</label>
            <div class="flex items-center gap-2">
                <input type="datetime-local" name="due_date" required
                    value="<?= date('Y-m-d\TH:i', strtotime($task['due_date'])) ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400" />
            </div>
        </div>

        <!-- Ưu tiên -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Mức độ ưu tiên</label>
            <select name="priority"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400 bg-white">
                <option value="cao" <?= $task['priority'] === 'cao' ? 'selected' : '' ?>>Cao</option>
                <option value="trung bình" <?= $task['priority'] === 'trung bình' ? 'selected' : '' ?>>Trung bình</option>
                <option value="thấp" <?= $task['priority'] === 'thấp' ? 'selected' : '' ?>>Thấp</option>
            </select>
        </div>

        <!-- Gửi -->
        <div class="pt-4">
            <button type="submit"
                class="w-full bg-green-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-700 transition duration-150 shadow">
                Cập nhật công việc
            </button>