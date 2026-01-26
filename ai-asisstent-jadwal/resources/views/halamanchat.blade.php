<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AION AI Chat</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #0a0a0a;
            color: #ffffff;
            overflow: hidden;
            height: 100vh;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #1a0000 0%, #0a0a0a 100%);
            border-right: 1px solid rgba(255, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 0, 0, 0.2);
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: radial-gradient(circle, #ff0000, #cc0000);
            border-radius: 50%;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #ffffff;
            font-size: 1.25rem;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 0.1em;
            text-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
        }

        .new-chat-btn {
            width: 100%;
            padding: 0.875rem 1rem;
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid #ff0000;
            border-radius: 10px;
            color: #ffffff;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .new-chat-btn:hover {
            background: rgba(255, 0, 0, 0.2);
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.3);
            transform: translateY(-2px);
        }

        .chat-history {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
        }

        .chat-history::-webkit-scrollbar {
            width: 6px;
        }

        .chat-history::-webkit-scrollbar-track {
            background: rgba(255, 0, 0, 0.05);
        }

        .chat-history::-webkit-scrollbar-thumb {
            background: rgba(255, 0, 0, 0.3);
            border-radius: 3px;
        }

        .chat-history::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 0, 0, 0.5);
        }

        .history-section {
            margin-bottom: 1.5rem;
        }

        .history-title {
            font-size: 0.75rem;
            color: #ff6666;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 0.5rem;
            padding: 0 0.5rem;
        }

        .history-item {
            padding: 0.75rem;
            margin-bottom: 0.5rem;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 0, 0, 0.1);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .history-item:hover {
            background: rgba(255, 0, 0, 0.1);
            border-color: rgba(255, 0, 0, 0.3);
            transform: translateX(5px);
        }

        .history-item.active {
            background: rgba(255, 0, 0, 0.15);
            border-color: #ff0000;
        }

        .history-item-title {
            font-size: 0.9rem;
            color: #ffffff;
            margin-bottom: 0.25rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .history-item-time {
            font-size: 0.75rem;
            color: #888;
        }

        .delete-btn {
            position: absolute;
            right: 0.5rem;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 0, 0, 0.2);
            border: none;
            width: 24px;
            height: 24px;
            border-radius: 4px;
            color: #ff0000;
            cursor: pointer;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .history-item:hover .delete-btn {
            opacity: 1;
        }

        .delete-btn:hover {
            background: rgba(255, 0, 0, 0.4);
        }

        /* Main Chat Area */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .chat-header {
            padding: 1.5rem 2rem;
            background: rgba(10, 10, 10, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .menu-toggle {
            display: none;
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid rgba(255, 0, 0, 0.3);
            width: 40px;
            height: 40px;
            border-radius: 8px;
            color: #ff0000;
            cursor: pointer;
            font-size: 1.2rem;
        }

        .chat-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #ffffff;
        }

        .status-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: #888;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #00ff00;
            border-radius: 50%;
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .chat-messages::-webkit-scrollbar {
            width: 8px;
        }

        .chat-messages::-webkit-scrollbar-track {
            background: rgba(255, 0, 0, 0.05);
        }

        .chat-messages::-webkit-scrollbar-thumb {
            background: rgba(255, 0, 0, 0.3);
            border-radius: 4px;
        }

        .message {
            display: flex;
            gap: 1rem;
            max-width: 800px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message.user {
            align-self: flex-end;
            flex-direction: row-reverse;
        }

        .message-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        .message.user .message-avatar {
            background: linear-gradient(135deg, #ff0000, #cc0000);
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.4);
        }

        .message.ai .message-avatar {
            background: linear-gradient(135deg, #333, #111);
            border: 2px solid #ff0000;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.3);
        }

        .message-content {
            flex: 1;
        }

        .message-bubble {
            padding: 1rem 1.25rem;
            border-radius: 12px;
            line-height: 1.6;
            word-wrap: break-word;
        }

        .message.user .message-bubble {
            background: rgba(255, 0, 0, 0.15);
            border: 1px solid rgba(255, 0, 0, 0.3);
            color: #ffffff;
        }

        .message.ai .message-bubble {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 0, 0, 0.1);
            color: #e0e0e0;
        }

        .message-time {
            font-size: 0.75rem;
            color: #666;
            margin-top: 0.5rem;
        }

        .typing-indicator {
            display: flex;
            gap: 0.3rem;
            padding: 1rem;
        }

        .typing-dot {
            width: 8px;
            height: 8px;
            background: #ff0000;
            border-radius: 50%;
            animation: typing 1.4s ease-in-out infinite;
        }

        .typing-dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {
            0%, 60%, 100% {
                transform: translateY(0);
                opacity: 0.7;
            }
            30% {
                transform: translateY(-10px);
                opacity: 1;
            }
        }

        .welcome-screen {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            text-align: center;
        }

        .welcome-logo {
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, #ff0000, #cc0000);
            border-radius: 50%;
            box-shadow: 0 0 40px rgba(255, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #ffffff;
            font-size: 3rem;
            margin-bottom: 2rem;
            animation: pulse-glow 3s ease-in-out infinite;
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-shadow: 0 0 20px rgba(255, 0, 0, 0.5);
        }

        .welcome-subtitle {
            font-size: 1.1rem;
            color: #888;
            margin-bottom: 2rem;
        }

        .suggestion-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            max-width: 800px;
            width: 100%;
        }

        .suggestion-card {
            padding: 1.25rem;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 0, 0, 0.2);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .suggestion-card:hover {
            background: rgba(255, 0, 0, 0.1);
            border-color: #ff0000;
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(255, 0, 0, 0.2);
        }

        .suggestion-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .suggestion-text {
            font-size: 0.9rem;
            color: #ccc;
        }

        /* Input Area */
        .input-area {
            padding: 1.5rem 2rem;
            background: rgba(10, 10, 10, 0.9);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 0, 0, 0.2);
        }

        .input-container {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            gap: 1rem;
            align-items: flex-end;
        }

        .input-wrapper {
            flex: 1;
            position: relative;
        }

        #messageInput {
            width: 100%;
            padding: 1rem 1.25rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 0, 0, 0.3);
            border-radius: 12px;
            color: #ffffff;
            font-size: 1rem;
            resize: none;
            max-height: 150px;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        #messageInput:focus {
            outline: none;
            border-color: #ff0000;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.08);
        }

        #messageInput::placeholder {
            color: #666;
        }

        .send-btn {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #ff0000, #cc0000);
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 1.25rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.4);
            flex-shrink: 0;
        }

        .send-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(255, 0, 0, 0.6);
        }

        .send-btn:active {
            transform: scale(0.95);
        }

        .send-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                z-index: 1000;
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .chat-messages {
                padding: 1rem;
            }

            .input-area {
                padding: 1rem;
            }

            .suggestion-cards {
                grid-template-columns: 1fr;
            }

            .welcome-title {
                font-size: 2rem;
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.7);
                z-index: 999;
            }

            .overlay.active {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="overlay" id="overlay"></div>

    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo-section">
                    <div class="logo-icon">A</div>
                    <span class="logo-text">AION</span>
                </div>
                <button class="new-chat-btn" onclick="newChat()">
                    <span>➕</span>
                    <span>Chat Baru</span>
                </button>
            </div>

            <div class="chat-history" id="chatHistory">
                <div class="history-section">
                    <div class="history-title">Hari Ini</div>
                    <div id="todayChats"></div>
                </div>
                <div class="history-section">
                    <div class="history-title">Minggu Ini</div>
                    <div id="weekChats"></div>
                </div>
                <div class="history-section">
                    <div class="history-title">Bulan Ini</div>
                    <div id="monthChats"></div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="chat-header">
                <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
                <h1 class="chat-title">AION Assistant</h1>
                <div class="status-indicator">
                    <div class="status-dot"></div>
                    <span>Online</span>
                </div>
            </header>

            <div class="chat-messages" id="chatMessages">
                <div class="welcome-screen" id="welcomeScreen">
                    <div class="welcome-logo">A</div>
                    <h2 class="welcome-title">Halo! Saya AION</h2>
                    <p class="welcome-subtitle">Asisten AI untuk membantu Anda. Apa yang bisa saya bantu hari ini?</p>
                    <div class="suggestion-cards">
                        <div class="suggestion-card" onclick="useSuggestion('Bagaimana cara mengatur jadwal harian saya?')">
                            <div class="suggestion-icon">📅</div>
                            <div class="suggestion-text">Atur jadwal harian</div>
                        </div>
                        <div class="suggestion-card" onclick="useSuggestion('Berikan tips produktivitas untuk bekerja')">
                            <div class="suggestion-icon">⚡</div>
                            <div class="suggestion-text">Tips produktivitas</div>
                        </div>
                        <div class="suggestion-card" onclick="useSuggestion('Bagaimana cara mencapai tujuan dengan efektif?')">
                            <div class="suggestion-icon">🎯</div>
                            <div class="suggestion-text">Capai tujuan</div>
                        </div>
                        <div class="suggestion-card" onclick="useSuggestion('Analisis waktu saya yang terbuang')">
                            <div class="suggestion-icon">📊</div>
                            <div class="suggestion-text">Analisis waktu</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="input-area">
                <div class="input-container">
                    <div class="input-wrapper">
                        <textarea
                            id="messageInput"
                            placeholder="Ketik pesan Anda di sini..."
                            rows="1"
                            onkeydown="handleKeyPress(event)"
                        ></textarea>
                    </div>
                    <button class="send-btn" onclick="sendMessage()" id="sendBtn">
                        ➤
                    </button>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Konfigurasi N8N Webhook
        const N8N_WEBHOOK_URL = 'https://your-n8n-instance.com/webhook/your-webhook-id'; // Ganti dengan URL webhook N8N Anda

        let currentChatId = null;
        let chatHistoryData = JSON.parse(localStorage.getItem('aionChatHistory')) || [];

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            loadChatHistory();
            autoResizeTextarea();
        });

        // Auto-resize textarea
        function autoResizeTextarea() {
            const textarea = document.getElementById('messageInput');
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 150) + 'px';
            });
        }

        // Handle Enter key
        function handleKeyPress(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                sendMessage();
            }
        }

        // Toggle sidebar (mobile)
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        // Close sidebar when clicking overlay
        document.getElementById('overlay').addEventListener('click', toggleSidebar);

        // New chat
        function newChat() {
            currentChatId = Date.now().toString();
            document.getElementById('chatMessages').innerHTML = '';
            document.getElementById('welcomeScreen').style.display = 'flex';

            // Create new chat in history
            const newChatData = {
                id: currentChatId,
                title: 'Chat Baru',
                timestamp: new Date().toISOString(),
                messages: []
            };
            chatHistoryData.unshift(newChatData);
            saveChatHistory();
            loadChatHistory();
        }

        // Use suggestion
        function useSuggestion(text) {
            document.getElementById('messageInput').value = text;
            sendMessage();
        }

        // Send message to N8N
        async function sendMessage() {
            const input = document.getElementById('messageInput');
            const message = input.value.trim();

            if (!message) return;

            // Hide welcome screen
            document.getElementById('welcomeScreen').style.display = 'none';

            // Create chat if doesn't exist
            if (!currentChatId) {
                currentChatId = Date.now().toString();
                const newChatData = {
                    id: currentChatId,
                    title: message.substring(0, 50),
                    timestamp: new Date().toISOString(),
                    messages: []
                };
                chatHistoryData.unshift(newChatData);
            }

            // Display user message
            addMessage('user', message);
            input.value = '';
            input.style.height = 'auto';

            // Show typing indicator
            const typingId = showTypingIndicator();

            // Disable send button
            const sendBtn = document.getElementById('sendBtn');
            sendBtn.disabled = true;

            try {
                // Send to N8N webhook
                const response = await fetch(N8N_WEBHOOK_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        message: message,
                        chatId: currentChatId,
                        timestamp: new Date().toISOString()
                    })
                });

                const data = await response.json();

                // Remove typing indicator
                removeTypingIndicator(typingId);

                // Display AI response
                const aiResponse = data.response || data.message || 'Maaf, saya tidak dapat memproses permintaan Anda saat ini.';
                addMessage('ai', aiResponse);

                // Save to chat history
                saveChatMessage(message, aiResponse);

            } catch (error) {
                console.error('Error:', error);
                removeTypingIndicator(typingId);
                addMessage('ai', 'Maaf, terjadi kesalahan dalam menghubungi server. Pastikan webhook N8N Anda sudah dikonfigurasi dengan benar.');
            } finally {
                sendBtn.disabled = false;
            }
        }

        // Add message to chat
        function addMessage(type, text) {
            const messagesContainer = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${type}`;

            const time = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

            messageDiv.innerHTML = `
                <div class="message-avatar">${type === 'user' ? 'U' : 'A'}</div>
                <div class="message-content">
                    <div class="message-bubble">${text}</div>
                    <div class="message-time">${time}</div>
                </div>
            `;

            messagesContainer.appendChild(messageDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Show typing indicator
        function showTypingIndicator() {
            const messagesContainer = document.getElementById('chatMessages');
            const typingDiv = document.createElement('div');
            const typingId = 'typing-' + Date.now();
            typingDiv.id = typingId;
            typingDiv.className = 'message ai';
            typingDiv.innerHTML = `
                <div class="message-avatar">A</div>
                <div class="message-content">
                    <div class="message-bubble">
                        <div class="typing-indicator">
                            <div class="typing-dot"></div>
                            <div class="typing-dot"></div>
                            <div class="typing-dot"></div>
                        </div>
                    </div>
                </div>
            `;
            messagesContainer.appendChild(typingDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
            return typingId;
        }

        // Remove typing indicator
        function removeTypingIndicator(typingId) {
            const typingElement = document.getElementById(typingId);
            if (typingElement) {
                typingElement.remove();
            }
        }

        // Save chat message
        function saveChatMessage(userMessage, aiResponse) {
            const currentChat = chatHistoryData.find(chat => chat.id === currentChatId);
            if (currentChat) {
                currentChat.messages.push({
                    user: userMessage,
                    ai: aiResponse,
                    timestamp: new Date().toISOString()
                });

                // Update title if it's first message
                if (currentChat.messages.length === 1) {
                    currentChat.title = userMessage.substring(0, 50);
                }

                saveChatHistory();
                loadChatHistory();
            }
        }

        // Save to localStorage
        function saveChatHistory() {
            localStorage.setItem('aionChatHistory', JSON.stringify(chatHistoryData));
        }

        // Load chat history
        function loadChatHistory() {
            const today = new Date();
            const weekAgo = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);
            const monthAgo = new Date(today.getTime() - 30 * 24 * 60 * 60 * 1000);

            const todayChats = [];
            const weekChats = [];
            const monthChats = [];

            chatHistoryData.forEach(chat => {
                const chatDate = new Date(chat.timestamp);
                if (chatDate.toDateString() === today.toDateString()) {
                    todayChats.push(chat);
                } else if (chatDate > weekAgo) {
                    weekChats.push(chat);
                } else if (chatDate > monthAgo) {
                    monthChats.push(chat);
                }
            });

            renderHistorySection('todayChats', todayChats);
            renderHistorySection('weekChats', weekChats);
            renderHistorySection('monthChats', monthChats);
        }

        // Render history section
        function renderHistorySection(containerId, chats) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';

            chats.forEach(chat => {
                const historyItem = document.createElement('div');
                historyItem.className = `history-item ${chat.id === currentChatId ? 'active' : ''}`;
                historyItem.onclick = () => loadChat(chat.id);

                const time = new Date(chat.timestamp).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

                historyItem.innerHTML = `
                    <div class="history-item-title">${chat.title}</div>
                    <div class="history-item-time">${time}</div>
                    <button class="delete-btn" onclick="event.stopPropagation(); deleteChat('${chat.id}')">🗑️</button>
                `;

                container.appendChild(historyItem);
            });
        }

        // Load specific chat
        function loadChat(chatId) {
            currentChatId = chatId;
            const chat = chatHistoryData.find(c => c.id === chatId);

            if (!chat) return;

            const messagesContainer = document.getElementById('chatMessages');
            messagesContainer.innerHTML = '';
            document.getElementById('welcomeScreen').style.display = 'none';

            chat.messages.forEach(msg => {
                addMessage('user', msg.user);
                addMessage('ai', msg.ai);
            });

            loadChatHistory();

            // Close sidebar on mobile
            if (window.innerWidth <= 768) {
                toggleSidebar();
            }
        }

        // Delete chat
        function deleteChat(chatId) {
            if (confirm('Hapus percakapan ini?')) {
                chatHistoryData = chatHistoryData.filter(chat => chat.id !== chatId);
                saveChatHistory();
                loadChatHistory();

                if (currentChatId === chatId) {
                    newChat();
                }
            }
        }
    </script>
</body>
</html>
