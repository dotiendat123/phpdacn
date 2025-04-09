<?php
class AISuggestionController
{
    public function suggestHabitsFromGoal()
    {
        $goalText = trim($_POST['goal'] ?? '');

        if (!$goalText) {
            http_response_code(400);
            echo json_encode(['error' => 'Goal is required']);
            exit;
        }

        $config = require BASE_PATH . '/config/api.php';

        $prompt = "Tôi có một mục tiêu: \"$goalText\". Hãy đề xuất đúng các thói quen cụ thể, đơn giản, thực tế giúp tôi đạt được mục tiêu này. 
Chỉ trả lời bằng danh sách các dòng bắt đầu bằng dấu gạch đầu dòng (-), không giải thích thêm.";

        $payload = [
            "model" => "openai/gpt-3.5-turbo",
            "messages" => [
                ["role" => "system", "content" => "Bạn là trợ lý năng suất, trả lời ngắn gọn và hiệu quả."],
                ["role" => "user", "content" => $prompt]
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
            echo json_encode(['habits' => [], 'error' => 'Lỗi CURL: ' . curl_error($ch)]);
            curl_close($ch);
            exit;
        }

        curl_close($ch);

        $result = json_decode($response, true);
        $content = $result['choices'][0]['message']['content'] ?? '';

        // Ghi log để debug nếu cần
        file_put_contents(BASE_PATH . '/logs/ai_suggestion.log', $content);

        // Tách các dòng thành danh sách
        $lines = preg_split('/\r\n|\r|\n/', $content);
        $habits = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if (preg_match('/^-/', $line)) {
                $habits[] = ltrim($line, "-•– \t");
            }
        }

        header('Content-Type: application/json');
        echo json_encode(['habits' => $habits]);
    }
}
