<?php
class AIController
{
    public function chat()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $message = trim($data['message'] ?? '');

        if (!$message) {
            http_response_code(400);
            echo json_encode(['error' => 'Empty message']);
            exit;
        }

        $config = require BASE_PATH . '/config/api.php';

        $payload = [
            "model" => "openai/gpt-3.5-turbo",
            "messages" => [
                ["role" => "system", "content" => "Bạn là trợ lý năng suất, trả lời ngắn gọn và hiệu quả."],
                ["role" => "user", "content" => $message]
            ]
        ];

        $ch = curl_init($config['AI_API_URL']);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $config['AI_API_KEY'],
                'Content-Type: application/json'
            ],
            CURLOPT_POSTFIELDS => json_encode($payload)
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo json_encode(['reply' => 'Lỗi CURL: ' . curl_error($ch)]);
            curl_close($ch);
            exit;
        }

        curl_close($ch);


        $result = json_decode($response, true);
        $reply = $result['choices'][0]['message']['content'] ?? 'Xin lỗi, tôi không thể trả lời lúc này.';

        header('Content-Type: application/json');
        echo json_encode(['reply' => $reply]);
    }
}
