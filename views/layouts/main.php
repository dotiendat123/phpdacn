<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Productivity App' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ✅ Tailwind đã build -->
    <link rel="stylesheet" href="/assets/css/tailwind.css">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">

    <!-- Navbar -->
    <header class="bg-white shadow-lg px-6 py-4 flex justify-between items-center sticky top-0 z-10">
        <a href="/dashboard" class="inline-block">
            <h1 class="text-xl font-bold text-blue-600 transition-colors duration-300 hover:text-blue-800">Productivity App</h1>
        </a>
        <nav class="space-x-6 text-sm font-medium">
            <a href="/dashboard" class="relative px-3 py-2 text-gray-700 transition-all duration-300 rounded-md hover:text-blue-600 hover:bg-blue-50 group">

                <span class="absolute inset-0 rounded-md bg-blue-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                <span class="relative z-10">Dashboard</span>
            </a>
            <a href="/tasks" class="relative px-3 py-2 text-gray-700 transition-all duration-300 rounded-md hover:text-blue-600 hover:bg-blue-50 group">
                <span class="absolute inset-0 rounded-md bg-blue-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                <span class="relative z-10">Công việc</span>
            </a>
            <a href="/habits" class="relative px-3 py-2 text-gray-700 transition-all duration-300 rounded-md hover:text-blue-600 hover:bg-blue-50 group">
                <span class="absolute inset-0 rounded-md bg-blue-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                <span class="relative z-10">Thói quen</span>
            </a>
            <a href="/goals" class="relative px-3 py-2 text-gray-700 transition-all duration-300 rounded-md hover:text-blue-600 hover:bg-blue-50 group">
                <span class="absolute inset-0 rounded-md bg-blue-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                <span class="relative z-10">Mục tiêu</span>
            </a>
            <a href="/ai/assistant" class="relative px-3 py-2 text-gray-700 transition-all duration-300 rounded-md hover:text-blue-600 hover:bg-blue-50 group">
                <span class="absolute inset-0 rounded-md bg-blue-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                <span class="relative z-10">Trợ lý AI</span>
            </a>
            <a href="/logout" class="relative px-3 py-2 text-red-500 transition-all duration-300 rounded-md hover:text-red-600 hover:bg-red-50 group">
                <span class="absolute inset-0 rounded-md bg-red-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                <span class="relative z-10">Đăng xuất</span>
            </a>
        </nav>
    </header>

    <!-- Nội dung -->
    <main class="flex-grow max-w-6xl mx-auto w-full px-4 py-6">
        <?= $content ?? '<p class="text-gray-500">Không có nội dung để hiển thị</p>' ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-50 text-center text-sm text-gray-500 p-4 mt-10">
        &copy; <?= date('Y') ?> Productivity App. All rights reserved.
    </footer>

    <script src="/assets/js/app.js"></script>
</body>

</html>