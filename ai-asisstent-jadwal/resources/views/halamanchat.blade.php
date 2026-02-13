<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abang AI - Penjadwalan Otomatis (FIXED)</title>
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
            white-space: pre-wrap;
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

        /* Debug Panel */
        .debug-panel {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #1a1a1a;
            color: #00ff00;
            padding: 1rem;
            border-radius: 8px;
            font-family: monospace;
            font-size: 0.8rem;
            max-width: 400px;
            max-height: 300px;
            overflow-y: auto;
            z-index: 9999;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .debug-panel::-webkit-scrollbar {
            width: 6px;
        }

        .debug-panel::-webkit-scrollbar-thumb {
            background: #666;
            border-radius: 3px;
        }

        .debug-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #333;
        }

        .debug-title {
            font-weight: bold;
            color: #00ff00;
        }

        .debug-close {
            background: none;
            border: none;
            color: #ff0000;
            cursor: pointer;
            font-size: 1.2rem;
        }

        .debug-log {
            margin-top: 0.5rem;
            color: #00ff00;
        }

        .debug-error {
            color: #ff0000;
        }

        .debug-success {
            color: #00ff00;
        }

        .debug-info {
            color: #00bfff;
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

            .debug-panel {
                max-width: calc(100vw - 40px);
                font-size: 0.7rem;
            }
        }
    </style>
</head>
<body>
    <!-- Debug Panel -->
    <div class="debug-panel" id="debugPanel">
        <div class="debug-header">
            <span class="debug-title">🔍 Debug Console</span>
            <button class="debug-close" onclick="toggleDebug()">×</button>
        </div>
        <div id="debugLog">Menunggu aktivitas...</div>
    </div>

    <div class="overlay" id="overlay"></div>

    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo-section">
                    <div class="logo-box">📅</div>
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
                <h1 class="chat-title">Abang AI - Penjadwalan Otomatis</h1>
                <div class="status-indicator">
                    <div class="status-dot"></div>
                    <span>Online</span>
                </div>
            </header>

            <div class="chat-messages" id="chatMessages">
                <div class="welcome-screen" id="welcomeScreen">
                    <div class="welcome-logo">📅</div>
                    <h2 class="welcome-title">Selamat Datang di Abang AI</h2>
                    <p class="welcome-subtitle">Asisten Penjadwalan Otomatis Anda. Kelola jadwal dengan mudah!</p>
                    <div class="suggestion-cards">
                        <div class="suggestion-card" onclick="useSuggestion('Buatkan jadwal meeting besok jam 10 sampai 12')">
                            <div class="suggestion-icon">➕</div>
                            <div class="suggestion-text">Buat Jadwal Baru</div>
                        </div>
                        <div class="suggestion-card" onclick="useSuggestion('Tampilkan jadwal minggu ini')">
                            <div class="suggestion-icon">📋</div>
                            <div class="suggestion-text">Lihat Jadwal</div>
                        </div>
                        <div class="suggestion-card" onclick="useSuggestion('Update jadwal meeting jadi jam 2 siang')">
                            <div class="suggestion-icon">✏️</div>
                            <div class="suggestion-text">Update Jadwal</div>
                        </div>
                        <div class="suggestion-card" onclick="useSuggestion('Hapus jadwal meeting hari ini')">
                            <div class="suggestion-icon">🗑️</div>
                            <div class="suggestion-text">Hapus Jadwal</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="input-area">
                <div class="input-container">
                    <div class="input-wrapper">
                        <textarea
                            id="messageInput"
                            placeholder="Contoh: 'Buatkan jadwal meeting besok jam 10' atau 'Apa kabar?'"
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
        // ==========================================
        // CONFIGURATION
        // ==========================================
        const N8N_WEBHOOK_URL = 'https://mamaddolla.app.n8n.cloud/webhook/abang-ai-scheduler';

        // ==========================================
        // DEBUG FUNCTIONS
        // ==========================================
        function debugLog(message, type = 'info') {
            const debugLog = document.getElementById('debugLog');
            const timestamp = new Date().toLocaleTimeString('id-ID');
            const className = type === 'error' ? 'debug-error' : type === 'success' ? 'debug-success' : 'debug-info';

            const logEntry = document.createElement('div');
            logEntry.className = `debug-log ${className}`;
            logEntry.textContent = `[${timestamp}] ${message}`;

            debugLog.appendChild(logEntry);
            debugLog.scrollTop = debugLog.scrollHeight;

            console.log(`[${timestamp}] ${message}`);
        }

        function toggleDebug() {
            const panel = document.getElementById('debugPanel');
            panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
        }

        // ==========================================
        // GLOBAL VARIABLES
        // ==========================================
        let currentChatId = null;
        let chatHistoryData = JSON.parse(localStorage.getItem('abangAIChatHistory')) || [];
        let currentUser = null;

        // ==========================================
        // INITIALIZATION
        // ==========================================
        document.addEventListener('DOMContentLoaded', () => {
            debugLog('🚀 Aplikasi dimulai', 'success');
            debugLog(`📡 Webhook URL: ${N8N_WEBHOOK_URL}`, 'info');
            checkAuth();
            loadChatHistory();
            autoResizeTextarea();
        });

        // ==========================================
        // AUTHENTICATION
        // ==========================================
        function checkAuth() {
            const token = localStorage.getItem('auth_token');
            const userStr = localStorage.getItem('user');

            if (!token || !userStr) {
                currentUser = {
                    id: 'demo-user-' + Date.now(),
                    name: 'Demo User',
                    email: 'demo@abangai.com'
                };
                localStorage.setItem('user', JSON.stringify(currentUser));
                localStorage.setItem('auth_token', 'demo-token-' + Date.now());
                debugLog('👤 User baru dibuat: ' + currentUser.name, 'success');
            } else {
                try {
                    currentUser = JSON.parse(userStr);
                    debugLog('👤 User login: ' + currentUser.name, 'success');
                } catch (error) {
                    debugLog('❌ Error parsing user data: ' + error.message, 'error');
                    currentUser = {
                        id: 'demo-user-' + Date.now(),
                        name: 'Demo User',
                        email: 'demo@abangai.com'
                    };
                }
            }

            document.getElementById('userName').textContent = currentUser.name || 'User';
            document.getElementById('userEmail').textContent = currentUser.email || 'user@email.com';
        }

        // ==========================================
        // LOGOUT
        // ==========================================
        function logout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                localStorage.removeItem('auth_token');
                localStorage.removeItem('user');
                localStorage.removeItem('abangAIChatHistory');
                debugLog('👋 User logout', 'info');
                window.location.reload();
            }
        }

        // ==========================================
        // TEXTAREA AUTO-RESIZE
        // ==========================================
        function autoResizeTextarea() {
            const textarea = document.getElementById('messageInput');
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 150) + 'px';
            });
        }

        // ==========================================
        // KEYBOARD HANDLER
        // ==========================================
        function handleKeyPress(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                sendMessage();
            }
        }

        // ==========================================
        // SIDEBAR TOGGLE (Mobile)
        // ==========================================
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        document.getElementById('overlay').addEventListener('click', toggleSidebar);

        // ==========================================
        // NEW CHAT
        // ==========================================
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
            debugLog('💬 Chat baru dibuat: ' + currentChatId, 'success');
        }

        // ==========================================
        // USE SUGGESTION
        // ==========================================
        function useSuggestion(text) {
            document.getElementById('messageInput').value = text;
            sendMessage();
        }

        // ==========================================
        // GET USER INITIAL
        // ==========================================
        function getUserInitial() {
            if (currentUser && currentUser.name) {
                return currentUser.name.charAt(0).toUpperCase();
            }
            return 'U';
        }

        // ==========================================
        // SEND MESSAGE TO N8N - FIXED VERSION
        // ==========================================
        async function sendMessage() {
            const input = document.getElementById('messageInput');
            const message = input.value.trim();

            if (!message) {
                debugLog('⚠️ Pesan kosong, tidak dikirim', 'error');
                return;
            }

            debugLog('📤 Mengirim pesan: ' + message, 'info');

            // Hide welcome screen
            document.getElementById('welcomeScreen').style.display = 'none';

            // Create new chat if needed
            if (!currentChatId) {
                currentChatId = Date.now().toString();
                const newChatData = {
                    id: currentChatId,
                    title: message.substring(0, 50),
                    timestamp: new Date().toISOString(),
                    messages: []
                };
                chatHistoryData.unshift(newChatData);
                debugLog('💬 Chat ID: ' + currentChatId, 'info');
            }

            // Add user message
            addMessage('user', message);
            input.value = '';
            input.style.height = 'auto';

            // Show typing indicator
            const typingId = showTypingIndicator();
            const sendBtn = document.getElementById('sendBtn');
            sendBtn.disabled = true;

            // Prepare payload
            const payload = {
                message: message,
                chatId: currentChatId,
                userId: currentUser.id,
                userName: currentUser.name,
                timestamp: new Date().toISOString()
            };

            debugLog('📦 Payload: ' + JSON.stringify(payload), 'info');

            try {
                debugLog('🌐 Menghubungi webhook...', 'info');

                const response = await fetch(N8N_WEBHOOK_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                debugLog(`📡 Status: ${response.status} ${response.statusText}`, 'info');

                if (!response.ok) {
                    const errorText = await response.text();
                    debugLog(`❌ Response Error: ${errorText}`, 'error');
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }

                const contentType = response.headers.get('content-type');
                debugLog(`📄 Content-Type: ${contentType}`, 'info');

                let data;
                if (contentType && contentType.includes('application/json')) {
                    data = await response.json();
                    debugLog('✅ Response JSON: ' + JSON.stringify(data), 'success');
                } else {
                    const textData = await response.text();
                    debugLog('📝 Response Text: ' + textData, 'info');
                    data = { response: textData };
                }

                removeTypingIndicator(typingId);

                // Extract AI response with multiple fallbacks
                let aiResponse = '';
                if (data.response) {
                    aiResponse = data.response;
                } else if (data.output) {
                    aiResponse = data.output;
                } else if (data.message) {
                    aiResponse = data.message;
                } else if (data.text) {
                    aiResponse = data.text;
                } else if (typeof data === 'string') {
                    aiResponse = data;
                } else {
                    aiResponse = 'Pesan diterima! ✅\n\nData: ' + JSON.stringify(data, null, 2);
                }

                debugLog('✅ AI Response: ' + aiResponse, 'success');

                // Add AI message
                addMessage('ai', aiResponse);
                saveChatMessage(message, aiResponse);

            } catch (error) {
                debugLog('❌ Error: ' + error.message, 'error');
                debugLog('❌ Stack: ' + error.stack, 'error');

                removeTypingIndicator(typingId);

                let errorMessage = '❌ Terjadi kesalahan saat menghubungi server.\n\n';
                errorMessage += '🔍 **Detail Error:**\n';
                errorMessage += `- ${error.message}\n\n`;
                errorMessage += '📋 **Checklist Debug:**\n';
                errorMessage += `1. ✓ URL Webhook: ${N8N_WEBHOOK_URL}\n`;
                errorMessage += '2. ? Workflow N8N sudah aktif?\n';
                errorMessage += '3. ? Webhook node dikonfigurasi POST?\n';
                errorMessage += '4. ? Path webhook benar: /webhook/abang-ai-scheduler\n';
                errorMessage += '5. ? Response mode: "Respond to Webhook"\n';
                errorMessage += '6. ? Internet connection OK?\n\n';
                errorMessage += '💡 **Solusi:**\n';
                errorMessage += '- Buka N8N → Executions → Lihat error\n';
                errorMessage += '- Test webhook dengan Postman/curl\n';
                errorMessage += '- Cek browser console (F12) untuk detail\n';
                errorMessage += '- Pastikan CORS diaktifkan jika perlu';

                addMessage('ai', errorMessage);
            } finally {
                sendBtn.disabled = false;
            }
        }

        // ==========================================
        // ADD MESSAGE TO CHAT
        // ==========================================
        function addMessage(type, text) {
            const messagesContainer = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${type}`;

            const time = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            const initial = type === 'user' ? getUserInitial() : '📅';

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

        // ==========================================
        // TYPING INDICATOR
        // ==========================================
        function showTypingIndicator() {
            const messagesContainer = document.getElementById('chatMessages');
            const typingDiv = document.createElement('div');
            const typingId = 'typing-' + Date.now();
            typingDiv.id = typingId;
            typingDiv.className = 'message ai';
            typingDiv.innerHTML = `
                <div class="message-avatar">📅</div>
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

        function removeTypingIndicator(typingId) {
            const typingElement = document.getElementById(typingId);
            if (typingElement) {
                typingElement.remove();
            }
        }

        // ==========================================
        // SAVE CHAT MESSAGE
        // ==========================================
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

        // ==========================================
        // SAVE TO LOCALSTORAGE
        // ==========================================
        function saveChatHistory() {
            localStorage.setItem('abangAIChatHistory', JSON.stringify(chatHistoryData));
            debugLog('💾 Chat history disimpan', 'success');
        }

        // ==========================================
        // LOAD CHAT HISTORY
        // ==========================================
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

        // ==========================================
        // RENDER HISTORY SECTION
        // ==========================================
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

        // ==========================================
        // LOAD SPECIFIC CHAT
        // ==========================================
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
            debugLog('📖 Chat dimuat: ' + chatId, 'info');

            if (window.innerWidth <= 768) {
                toggleSidebar();
            }
        }

        // ==========================================
        // DELETE CHAT
        // ==========================================
        function deleteChat(chatId) {
            if (confirm('Hapus percakapan ini?')) {
                chatHistoryData = chatHistoryData.filter(chat => chat.id !== chatId);
                saveChatHistory();
                loadChatHistory();
                debugLog('🗑️ Chat dihapus: ' + chatId, 'info');

                if (currentChatId === chatId) {
                    newChat();
                }
            }
        }
    </script>
</body>
</html>
