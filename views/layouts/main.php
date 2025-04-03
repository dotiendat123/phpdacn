<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Productivity App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/assets/css/output.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">

    <header class="bg-white shadow p-4">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold text-blue-600">🧠 Productivity App</h1>
        </div>
    </header>

    <main class="flex-grow container mx-auto p-6">
        <?= $content ?>
    </main>

    <footer class="bg-white shadow p-4 mt-10 text-center text-sm text-gray-500">
        © <?= date("Y") ?> Productivity App. All rights reserved.
    </footer>

</body>

</html>