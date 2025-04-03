<?php
ob_start();
?>

<h2 class="text-xl font-bold mb-4">Trợ lý AI</h2>

<div id="chat-box" class="bg-white p-4 border rounded h-64 overflow-y-auto mb-4"></div>

<form id="chat-form" class="flex gap-2">
    <input type="text" id="user-input" placeholder="Nhập câu hỏi của bạn..." class="flex-1 p-2 border rounded" required>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Gửi</button>
</form>

<script>
    document.getElementById("chat-form").addEventListener("submit", async function(e) {
        e.preventDefault();
        const input = document.getElementById("user-input");
        const chatBox = document.getElementById("chat-box");

        const userMessage = input.value.trim();
        if (!userMessage) return;

        // Hiển thị câu hỏi
        chatBox.innerHTML += `<div class="mb-2"><strong>Bạn:</strong> ${userMessage}</div>`;
        input.value = '';

        const response = await fetch("/ai/assistant", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                prompt: userMessage
            })
        });

        const data = await response.text();
        chatBox.innerHTML += `<div class="mb-4"><strong>AI:</strong> ${data}</div>`;
        chatBox.scrollTop = chatBox.scrollHeight;
    });
</script>

<?php
// Xử lý gọi AI nếu là POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once BASE_PATH . '/controllers/AIController.php';
    $json = json_decode(file_get_contents("php://input"), true);
    $prompt = $json['prompt'] ?? '';
    echo askAI($prompt);
    exit;
}

$content = ob_get_clean();
include BASE_PATH . '/views/layouts/main.php';
