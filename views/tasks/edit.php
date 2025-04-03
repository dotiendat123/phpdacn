<form method="POST" action="/task/update/<?= $task['id'] ?>" class="space-y-4 p-4">
    <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required class="w-full p-2 border rounded" />

    <textarea name="description" class="w-full p-2 border rounded"><?= htmlspecialchars($task['description']) ?></textarea>

    <input type="datetime-local" name="due_date" value="<?= date('Y-m-d\TH:i', strtotime($task['due_date'])) ?>" required class="w-full p-2 border rounded" />

    <select name="priority" class="w-full p-2 border rounded">
        <option value="cao" <?= $task['priority'] === 'cao' ? 'selected' : '' ?>>Cao</option>
        <option value="trung bình" <?= $task['priority'] === 'trung bình' ? 'selected' : '' ?>>Trung bình</option>
        <option value="thấp" <?= $task['priority'] === 'thấp' ? 'selected' : '' ?>>Thấp</option>
    </select>

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Cập nhật</button>
</form>