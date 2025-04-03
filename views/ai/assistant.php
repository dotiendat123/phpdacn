<?php ob_start(); ?>

<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow space-y-4">
    <h2 class="text-xl font-bold text-blue-600 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
        </svg>
        Trợ lý AI - Hỏi tôi bất kỳ điều gì
    </h2>

    <div id="chat-box" class="bg-gray-50 p-4 h-48 overflow-y-auto rounded text-sm space-y-2">
        <!-- Tin nhắn sẽ hiển thị ở đây -->
    </div>

    <form id="chat-form" class="flex items-center gap-3">
        <input type="text" id="user-input" class="flex-grow p-3 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-300"
            placeholder="Bạn muốn hỏi gì hôm nay?" />
        <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center gap-1 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7M5 5h14" />
            </svg>
            Gửi
        </button>
    </form>
</div>

<script>
    const form = document.getElementById('chat-form');
    const input = document.getElementById('user-input');
    const chatBox = document.getElementById('chat-box');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = input.value.trim();
        if (!message) return;

        // Hiển thị câu hỏi người dùng
        chatBox.innerHTML += `<div class="text-right text-blue-600">🙋‍♂️ ${message}</div>`;
        chatBox.innerHTML += `<div class="text-left text-gray-400" id="loading">🧠 Đang trả lời...</div>`;
        input.value = '';
        chatBox.scrollTop = chatBox.scrollHeight;

        try {
            const res = await fetch('/ai/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    message
                })
            });

            const data = await res.json();

            // Xoá loading và hiển thị phản hồi
            document.getElementById('loading')?.remove();
            chatBox.innerHTML += `<div class="text-left text-gray-700">🤖 ${data.reply}</div>`;
        } catch (error) {
            document.getElementById('loading')?.remove();
            chatBox.innerHTML += `<div class="text-left text-red-500">❌ Lỗi kết nối đến AI</div>`;
        }

        chatBox.scrollTop = chatBox.scrollHeight;
    });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
