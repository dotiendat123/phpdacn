<?php
// Hiện lỗi khi có lỗi PHP (debug)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Đảm bảo trả về JSON
header('Content-Type: application/json');

// Chỉ cho phép POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Phương thức không hợp lệ']);
    exit;
}

// Kiểm tra và lấy dữ liệu JSON
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['goal_title']) || empty(trim($data['goal_title']))) {
    http_response_code(400);
    echo json_encode(['error' => 'Vui lòng nhập tên mục tiêu']);
    exit;
}

$goalTitle = trim($data['goal_title']);

// Load API key
// Load config từ .env (qua file api.php)
$config = require __DIR__ . '/../config/api.php';
$apiKey = $config['AI_API_KEY'] ?? null;

if (!$apiKey) {
    file_put_contents(__DIR__ . '/../logs/ai_error.log', "❌ Thiếu API Key (config null hoặc không tồn tại AI_API_KEY).\n");
    http_response_code(500);
    echo json_encode(['error' => 'Thiếu API Key trong cấu hình']);
    exit;
}


// Soạn prompt
$prompt = <<<PROMPT
Tôi có mục tiêu: "$goalTitle".
Hãy gợi ý 5–7 bước nhỏ, cụ thể, có thể hành động để đạt được mục tiêu này.
Trả lời theo định dạng:
- Bước 1
- Bước 2
...
PROMPT;

// Chuẩn bị payload
$payload = [
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        ['role' => 'system', 'content' => 'Bạn là trợ lý lập kế hoạch giúp người dùng chia nhỏ mục tiêu thành các bước hành động cụ thể.'],
        ['role' => 'user', 'content' => $prompt]
    ]
];

// Gọi API
$ch = curl_init('https://openrouter.ai/api/v1/chat/completions');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ],
    CURLOPT_POSTFIELDS => json_encode($payload),
]);

$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

// Xử lý lỗi kết nối
if (!$response || !empty($error)) {
    file_put_contents(__DIR__ . '/../logs/ai_error.log', "CURL ERROR: $error\n");
    http_response_code(500);
    echo json_encode(['error' => 'Không thể kết nối đến OpenRouter', 'detail' => $error]);
    exit;
}

// Phân tích JSON phản hồi
$result = json_decode($response, true);

if (!isset($result['choices'][0]['message']['content'])) {
    file_put_contents(__DIR__ . '/../logs/ai_error.log', "OPENROUTER RAW: $response\n");
    http_response_code(500);
    echo json_encode(['error' => 'Không có phản hồi hợp lệ từ OpenRouter']);
    exit;
}

// Trích nội dung và chuyển thành danh sách
$message = $result['choices'][0]['message']['content'];
$lines = preg_split("/\n+/", $message);
$steps = [];

foreach ($lines as $line) {
    $line = trim($line);
    if (preg_match("/^[-\d\.]+[\)\.]?\s*(.+)/", $line, $matches)) {
        $steps[] = $matches[1];
    } elseif (!empty($line)) {
        $steps[] = $line;
    }
}

// Fallback nếu không parse được
if (empty($steps) && !empty($message)) {
    $steps[] = $message;
}

// Trả kết quả JSON
echo json_encode(['steps' => $steps]);
exit;
