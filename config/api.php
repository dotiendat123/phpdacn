<?php
// return [
//     'api_key' => 'your-api-key-here', // 🔐 Thay bằng API key thật
//     'endpoint' => 'https://openrouter.ai/api/v1/chat/completions',
//     'model' => 'openai/gpt-3.5-turbo' // Hoặc 'mistral', 'gpt-4', v.v.
// ];
// Load .env manually (nếu chưa dùng thư viện như vlucas/phpdotenv)
$envFile = dirname(__DIR__) . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}

return [
    'AI_API_URL' => $_ENV['AI_API_URL'],
    'AI_API_KEY' => $_ENV['AI_API_KEY']
];
