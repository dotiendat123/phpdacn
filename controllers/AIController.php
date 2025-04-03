<?php

function askAI($prompt)
{
    $config = require BASE_PATH . '/config/api.php';

    $data = [
        "model" => $config['model'],
        "messages" => [
            ["role" => "system", "content" => "Bạn là trợ lý năng suất cá nhân thông minh."],
            ["role" => "user", "content" => $prompt]
        ]
    ];

    $ch = curl_init($config['endpoint']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $config['api_key']
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);
    return $result['choices'][0]['message']['content'] ?? "Xin lỗi, không thể trả lời lúc này.";
}
