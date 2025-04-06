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
    <header class="bg-white shadow px-6 py-4 sticky top-0 z-20">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="/dashboard" class="flex items-center space-x-2 text-blue-600 hover:text-blue-800 transition-colors">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7m-9 5v6m4-6v6m5-6h3m-18 0h3" />
                </svg>
                <span class="text-xl font-bold">Productivity App</span>
            </a>

            <!-- Navigation -->
            <nav class="flex items-center space-x-4 text-sm font-medium">
                <?php
                $navItems = [
                    ['href' => '/dashboard', 'label' => 'Dashboard'],
                    ['href' => '/tasks', 'label' => 'Công việc'],
                    ['href' => '/habits', 'label' => 'Thói quen'],
                    ['href' => '/goals', 'label' => 'Mục tiêu'],
                    ['href' => '/ai/assistant', 'label' => 'Trợ lý AI'],
                    ['href' => '/user/edit', 'label' => 'Hồ sơ cá nhân'],
                ];
                foreach ($navItems as $item): ?>
                    <a href="<?= $item['href'] ?>"
                        class="relative px-3 py-2 rounded-md transition-all duration-300 group <?= $item['class'] ?? 'text-gray-700 hover:text-blue-600 hover:bg-blue-50' ?>">
                        <span class="absolute inset-0 rounded-md bg-blue-100 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span class="relative z-10"><?= $item['label'] ?></span>
                    </a>
                <?php endforeach; ?>

                <!-- Logout with icon -->
                <a href="/logout"
                    class="relative flex items-center px-3 py-2 text-red-500 transition-all duration-300 rounded-md hover:text-red-600 hover:bg-red-50 group">
                    <span class="absolute inset-0 rounded-md bg-red-100 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                    <span class="relative z-10 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5a2 2 0 00-2-2h-3a2 2 0 00-2 2v1" />
                        </svg>
                        Đăng xuất
                    </span>
                </a>
            </nav>
        </div>
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