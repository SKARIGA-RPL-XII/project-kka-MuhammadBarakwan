<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Asisten Jadwal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex flex-col">

    <div class="bg-blue-600 p-4 text-white shadow-lg">
        <h1 class="text-xl font-bold text-center">AI Asisten Jadwal</h1>
    </div>

    <div id="chat-container" class="flex-1 overflow-y-auto p-4 space-y-4">
        <div class="flex justify-start">
            <div class="bg-white p-3 rounded-lg shadow-sm max-w-xs border border-gray-200">
                <p class="text-sm text-gray-800">Halo! Saya AI Asisten Jadwal. Ada yang bisa saya bantu?</p>
            </div>
        </div>
    </div>

    <div class="p-4 bg-white border-t border-gray-200">
        <form id="chat-form" class="flex space-x-2">
            <input type="text" id="user-input"
                class="flex-1 border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Tulis pesan..." required>
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition duration-200">
                Kirim
            </button>
        </form>
    </div>

    <script>
        const chatForm = document.getElementById('chat-form');
        const userInput = document.getElementById('user-input');
        const chatContainer = document.getElementById('chat-container');

        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const message = userInput.value;

            // 1. Tambahkan bubble chat user ke layar
            appendMessage('user', message);
            userInput.value = '';

            // 2. Kirim ke Laravel Controller
            try {
                // Gunakan URL route yang sudah kita buat di web.php sebelumnya
                const response = await fetch(`/tes-n8n?message=${encodeURIComponent(message)}`);
                const data = await response.json();

                // 3. Ambil balasan dari n8n (asumsi n8n membalas di field 'output' atau sesuai struktur n8n kamu)
                // Jika n8n belum dikonfigurasi balasannya, kita tampilkan status dulu
                const botReply = data.balasan_n8n.output || "Pesan terkirim ke n8n!";
                appendMessage('bot', botReply);

            } catch (error) {
                appendMessage('bot', 'Maaf, terjadi kesalahan koneksi ke server.');
                console.error(error);
            }
        });

        function appendMessage(sender, text) {
            const wrapper = document.createElement('div');
            wrapper.className = sender === 'user' ? 'flex justify-end' : 'flex justify-start';

            const bubble = document.createElement('div');
            bubble.className = sender === 'user'
                ? 'bg-blue-500 text-white p-3 rounded-lg shadow-sm max-w-xs'
                : 'bg-white p-3 rounded-lg shadow-sm max-w-xs border border-gray-200 text-gray-800';

            bubble.innerHTML = `<p class="text-sm">${text}</p>`;

            wrapper.appendChild(bubble);
            chatContainer.appendChild(wrapper);

            // Auto scroll ke bawah
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    </script>
</body>
</html>
