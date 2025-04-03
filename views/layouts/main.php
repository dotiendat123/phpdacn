<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Productivity App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ✅ Thêm Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="bg-gray-100 text-gray-800">
    <!-- Navbar -->
    <header class="bg-white shadow-md p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-600">Productivity App</h1>
        <nav class="space-x-4 text-sm font-medium">
            <a href="/dashboard" class="hover:text-blue-600">Dashboard</a>
            <a href="/tasks" class="hover:text-blue-600">Công việc</a>
            <a href="/habits" class="hover:text-blue-600">Thói quen</a>
            <a href="/goals" class="hover:text-blue-600">Mục tiêu</a>
            <a href="/ai/assistant" class="hover:text-blue-600">Trợ lý AI</a>
            <a href="/logout" class="text-red-500 hover:text-red-600">Đăng xuất</a>
        </nav>
    </header>

    <main class="p-6">
        <?= $content ?>
    </main>

    <footer class="text-center text-sm text-gray-500 p-4 mt-8">
        &copy; <?= date('Y') ?> Productivity App. All rights reserved.
    </footer>

    <script src="/assets/js/app.js"></script>
</body>

</html>