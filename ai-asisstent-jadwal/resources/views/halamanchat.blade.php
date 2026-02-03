<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abang AI - Chat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f9fafb;
            color: #1a1a1a;
            overflow: hidden;
            height: 100vh;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 300px;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            padding: 1.25rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .logo-box {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #E31E24, #C41E3A);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: #ffffff;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .logo-text {
            font-size: 1.3rem;
            font-weight: 800;
            color: #1a1a1a;
            letter-spacing: -0.02em;
        }

        /* User Info Section */
        .user-info {
            background: linear-gradient(135deg, #E31E24, #C41E3A);
            color: #ffffff;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        .user-info-header {
            font-size: 0.75rem;
            font-weight: 600;
            opacity: 0.9;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .user-name {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .user-email {
            font-size: 0.85rem;
            opacity: 0.9;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .new-chat-btn {
            width: 100%;
            padding: 0.875rem;
            background: #E31E24;
            border: none;
            border-radius: 10px;
            color: #ffffff;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .new-chat-btn:hover {
            background: #C41E3A;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(227, 30, 36, 0.3);
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
            background: #f9fafb;
        }

        .chat-history::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 3px;
        }

        .history-section {
            margin-bottom: 1.5rem;
        }

        .history-title {
            font-size: 0.75rem;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.75rem;
            padding: 0 0.5rem;
        }

        .history-item {
            padding: 0.75rem;
            margin-bottom: 0.5rem;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .history-item:hover {
            background: #ffffff;
            border-color: #E31E24;
            transform: translateX(2px);
        }

        .history-item.active {
            background: #FEE2E2;
            border-color: #E31E24;
        }

        .history-item-title {
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #1a1a1a;
        }

        .history-item-time {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        .delete-btn {
            position: absolute;
            right: 0.5rem;
            top: 50%;
            transform: translateY(-50%);
            background: #ffffff;
            border: 1px solid #e5e7eb;
            width: 24px;
            height: 24px;
            border-radius: 6px;
            color: #E31E24;
            cursor: pointer;
            opacity: 0;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .history-item:hover .delete-btn {
            opacity: 1;
        }

        .delete-btn:hover {
            background: #FEE2E2;
        }

        .logout-btn {
            margin-top: auto;
            padding: 0.875rem 1.25rem;
            background: transparent;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            color: #666;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s;
            margin: 1rem 1.25rem;
        }

        .logout-btn:hover {
            border-color: #E31E24;
            color: #E31E24;
            background: #FEE2E2;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #ffffff;
        }

        .chat-header {
            padding: 1rem 2rem;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }

        .menu-toggle {
            display: none;
            background: #E31E24;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            color: #ffffff;
            cursor: pointer;
            font-size: 1.2rem;
        }

        .chat-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1a1a1a;
            letter-spacing: -0.02em;
        }

        .status-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            font-weight: 500;
            color: #10b981;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
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
            background: #f9fafb;
        }

        .chat-messages::-webkit-scrollbar {
            width: 8px;
        }

        .chat-messages::-webkit-scrollbar-track {
            background: #f9fafb;
        }

        .chat-messages::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }

        .message {
            display: flex;
            gap: 0.875rem;
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
            font-weight: 700;
            font-size: 0.95rem;
            flex-shrink: 0;
        }

        .message.user .message-avatar {
            background: linear-gradient(135deg, #E31E24, #C41E3A);
            color: #ffffff;
        }

        .message.ai .message-avatar {
            background: #f3f4f6;
            color: #E31E24;
        }

        .message-content {
            flex: 1;
        }

        .message-bubble {
            padding: 1rem 1.25rem;
            border-radius: 16px;
            line-height: 1.6;
            word-wrap: break-word;
            font-size: 0.95rem;
        }

        .message.user .message-bubble {
            background: linear-gradient(135deg, #E31E24, #C41E3A);
            color: #ffffff;
        }

        .message.ai .message-bubble {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            color: #1a1a1a;
        }

        .message-time {
            font-size: 0.75rem;
            color: #9ca3af;
            margin-top: 0.5rem;
        }

        .typing-indicator {
            display: flex;
            gap: 0.4rem;
            padding: 0.75rem;
        }

        .typing-dot {
            width: 8px;
            height: 8px;
            background: #E31E24;
            border-radius: 50%;
            animation: typing 1.4s ease-in-out infinite;
        }

        .typing-dot:nth-child(2) { animation-delay: 0.2s; }
        .typing-dot:nth-child(3) { animation-delay: 0.4s; }

        @keyframes typing {
            0%, 60%, 100% { transform: translateY(0); opacity: 0.5; }
            30% { transform: translateY(-8px); opacity: 1; }
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
            background: linear-gradient(135deg, #E31E24, #C41E3A);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 40px rgba(227, 30, 36, 0.3);
        }

        .welcome-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
            color: #1a1a1a;
            letter-spacing: -0.02em;
        }

        .welcome-subtitle {
            font-size: 1rem;
            color: #666;
            margin-bottom: 2.5rem;
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
            background: #ffffff;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .suggestion-card:hover {
            border-color: #E31E24;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(227, 30, 36, 0.1);
        }

        .suggestion-icon {
            font-size: 2rem;
            margin-bottom: 0.75rem;
        }

        .suggestion-text {
            font-size: 0.9rem;
            font-weight: 500;
            color: #1a1a1a;
        }

        /* Input Area */
        .input-area {
            padding: 1.5rem 2rem;
            background: #ffffff;
            border-top: 1px solid #e5e7eb;
        }

        .input-container {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            gap: 0.875rem;
            align-items: flex-end;
        }

        .input-wrapper {
            flex: 1;
        }

        #messageInput {
            width: 100%;
            padding: 0.875rem 1rem;
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            color: #1a1a1a;
            font-size: 0.95rem;
            resize: none;
            max-height: 150px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s;
        }

        #messageInput:focus {
            outline: none;
            border-color: #E31E24;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(227, 30, 36, 0.1);
        }

        #messageInput::placeholder {
            color: #9ca3af;
        }

        .send-btn {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #E31E24, #C41E3A);
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(227, 30, 36, 0.3);
        }

        .send-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(227, 30, 36, 0.4);
        }

        .send-btn:active {
            transform: translateY(0);
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
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
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

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
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
                    <div class="logo-box">AI</div>
                    <span class="logo-text">Abang AI</span>
                </div>

                <!-- User Info -->
                <div class="user-info" id="userInfo">
                    <div class="user-info-header">Login Sebagai</div>
                    <div class="user-name" id="userName">User</div>
                    <div class="user-email" id="userEmail">user@email.com</div>
                </div>

                <button class="new-chat-btn" onclick="newChat()">
                    <span>+</span>
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

            <button class="logout-btn" onclick="logout()">Keluar</button>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="chat-header">
                <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
                <h1 class="chat-title">Abang AI Assistant</h1>
                <div class="status-indicator">
                    <div class="status-dot"></div>
                    <span>Online</span>
                </div>
            </header>

            <div class="chat-messages" id="chatMessages">
                <div class="welcome-screen" id="welcomeScreen">
                    <div class="welcome-logo">🤖</div>
                    <h2 class="welcome-title">Halo! Saya Abang AI</h2>
                    <p class="welcome-subtitle">Asisten AI Anda siap membantu. Apa yang bisa saya bantu hari ini?</p>
                    <div class="suggestion-cards">
                        <div class="suggestion-card" onclick="useSuggestion('Bagaimana cara mengatur jadwal harian saya?')">
                            <div class="suggestion-icon">📅</div>
                            <div class="suggestion-text">Atur Jadwal</div>
                        </div>
                        <div class="suggestion-card" onclick="useSuggestion('Berikan tips produktivitas')">
                            <div class="suggestion-icon">⚡</div>
                            <div class="suggestion-text">Tips Produktivitas</div>
                        </div>
                        <div class="suggestion-card" onclick="useSuggestion('Bagaimana cara mencapai tujuan dengan efektif?')">
                            <div class="suggestion-icon">🎯</div>
                            <div class="suggestion-text">Capai Tujuan</div>
                        </div>
                        <div class="suggestion-card" onclick="useSuggestion('Analisis waktu saya')">
                            <div class="suggestion-icon">📊</div>
                            <div class="suggestion-text">Analisis Waktu</div>
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
        // N8N Webhook Configuration
        const N8N_WEBHOOK_URL = 'https://your-n8n-instance.com/webhook/your-webhook-id';

        let currentChatId = null;
        let chatHistoryData = JSON.parse(localStorage.getItem('abangAIChatHistory')) || [];
        let currentUser = null;

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            checkAuth();
            loadChatHistory();
            autoResizeTextarea();
        });

        // Check authentication and load user data
        function checkAuth() {
            const token = localStorage.getItem('auth_token');
            const userStr = localStorage.getItem('user');

            if (!token || !userStr) {
                window.location.href = '/login.html';
                return;
            }

            try {
                currentUser = JSON.parse(userStr);
                document.getElementById('userName').textContent = currentUser.name || 'User';
                document.getElementById('userEmail').textContent = currentUser.email || 'user@email.com';
            } catch (error) {
                console.error('Error parsing user data:', error);
                window.location.href = '/login.html';
            }
        }

        // Logout function
        function logout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                localStorage.removeItem('auth_token');
                localStorage.removeItem('user');
                window.location.href = '/login.html';
            }
        }

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

        // Get user initials for avatar
        function getUserInitial() {
            if (currentUser && currentUser.name) {
                return currentUser.name.charAt(0).toUpperCase();
            }
            return 'U';
        }

        // Send message to N8N
        async function sendMessage() {
            const input = document.getElementById('messageInput');
            const message = input.value.trim();

            if (!message) return;

            document.getElementById('welcomeScreen').style.display = 'none';

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

            addMessage('user', message);
            input.value = '';
            input.style.height = 'auto';

            const typingId = showTypingIndicator();
            const sendBtn = document.getElementById('sendBtn');
            sendBtn.disabled = true;

            try {
                const response = await fetch(N8N_WEBHOOK_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        message: message,
                        chatId: currentChatId,
                        userId: currentUser ? currentUser.id : null,
                        userName: currentUser ? currentUser.name : null,
                        timestamp: new Date().toISOString()
                    })
                });

                const data = await response.json();
                removeTypingIndicator(typingId);

                const aiResponse = data.response || data.message || 'Maaf, saya tidak dapat memproses permintaan Anda saat ini.';
                addMessage('ai', aiResponse);
                saveChatMessage(message, aiResponse);

            } catch (error) {
                console.error('Error:', error);
                removeTypingIndicator(typingId);
                addMessage('ai', 'Maaf, terjadi kesalahan. Pastikan webhook N8N sudah dikonfigurasi dengan benar.');
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
            const initial = type === 'user' ? getUserInitial() : 'AI';

            messageDiv.innerHTML = `
                <div class="message-avatar">${initial}</div>
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
                <div class="message-avatar">AI</div>
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

                if (currentChat.messages.length === 1) {
                    currentChat.title = userMessage.substring(0, 50);
                }

                saveChatHistory();
                loadChatHistory();
            }
        }

        // Save to localStorage
        function saveChatHistory() {
            localStorage.setItem('abangAIChatHistory', JSON.stringify(chatHistoryData));
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
                    <button class="delete-btn" onclick="event.stopPropagation(); deleteChat('${chat.id}')">×</button>
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
