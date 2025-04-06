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
            <!-- SVG máy bay giấy -->
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.5 12L3 9.5l18-7-7 18-2.5-7.5z" />
            </svg>
            Gửi
        </button>
    </form>
</div>

<script>
    const form = document.getElementById('chat-form');
    const input = document.getElementById('user-input');
    const chatBox = document.getElementById('chat-box');

    // SVG cho icon người dùng
    const userIcon = `
        <svg class="inline w-4 h-4 text-blue-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5.121 17.804A9 9 0 1112 21v-3.243a1 1 0 00-.707-.949l-5.586-1.864z" />
        </svg>
    `;

    // SVG cho icon AI bot
    const botIcon = `
        <svg class="inline w-4 h-4 text-gray-700 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 11c0-1.105.895-2 2-2h2a2 2 0 110 4h-2a2 2 0 01-2-2zM6 11c0-1.105.895-2 2-2h2a2 2 0 110 4H8a2 2 0 01-2-2z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 2v2m0 16v2m8-10h2M2 12h2m16.95 4.95l1.414 1.414M3.636 6.636L5.05 8.05m14.142 0l1.414-1.414M3.636 17.364l1.414-1.414" />
        </svg>
    `;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = input.value.trim();
        if (!message) return;

        // Hiển thị câu hỏi người dùng
        chatBox.innerHTML += `<div class="text-right text-blue-600">${userIcon}${message}</div>`;
        chatBox.innerHTML += `<div class="text-left text-gray-400" id="loading"> Đang trả lời...</div>`;
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
            chatBox.innerHTML += `<div class="text-left text-gray-700">${botIcon}${data.reply}</div>`;
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
?>