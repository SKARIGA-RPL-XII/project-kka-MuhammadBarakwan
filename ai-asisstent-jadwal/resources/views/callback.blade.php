<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abang AI - Authenticating</title>
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
            background: linear-gradient(135deg, #E31E24 0%, #C41E3A 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .loading-container {
            text-align: center;
            max-width: 400px;
            padding: 2rem;
        }

        .logo-box {
            width: 100px;
            height: 100px;
            background: #ffffff;
            border-radius: 20px;
            margin: 0 auto 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: #E31E24;
            font-size: 3rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .logo-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
        }

        .loading-text {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        .spinner {
            width: 60px;
            height: 60px;
            margin: 0 auto;
            border: 4px solid rgba(255, 255, 255, 0.2);
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .error-message {
            background: rgba(255, 255, 255, 0.95);
            color: #E31E24;
            margin-top: 2rem;
            padding: 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            line-height: 1.6;
        }

        .error-title {
            font-weight: 800;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .logo-title {
                font-size: 2rem;
            }

            .logo-box {
                width: 80px;
                height: 80px;
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="loading-container">
        <div class="logo-box">AI</div>
        <div class="logo-title">Abang AI</div>
        <div class="loading-text" id="loadingText">Authenticating...</div>
        <div class="spinner"></div>
        <div class="error-message" id="errorMessage" style="display: none;">
            <div class="error-title">Authentication Failed</div>
            <div id="errorText"></div>
        </div>
    </div>

    <script>
        // Get URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const token = urlParams.get('token');
        const error = urlParams.get('message');

        if (error) {
            // Show error
            document.getElementById('loadingText').textContent = 'Authentication Failed';
            document.getElementById('errorText').textContent = error;
            document.getElementById('errorMessage').style.display = 'block';
            document.querySelector('.spinner').style.display = 'none';

            // Redirect back to login after 3 seconds
            setTimeout(() => {
                window.location.href = '/login';
            }, 3000);

        } else if (token) {
            // Success - save token and redirect
            localStorage.setItem('auth_token', token);

            // Fetch user data
            fetch('http://localhost:8000/api/user', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    localStorage.setItem('user', JSON.stringify(data.data));
                    document.getElementById('loadingText').textContent = 'Success! Redirecting...';

                    // Redirect to chat
                    setTimeout(() => {
                        window.location.href = '/chat';
                    }, 1000);
                } else {
                    throw new Error('Failed to fetch user data');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('loadingText').textContent = 'Authentication Failed';
                document.getElementById('errorText').textContent = 'Failed to retrieve user information';
                document.getElementById('errorMessage').style.display = 'block';
                document.querySelector('.spinner').style.display = 'none';

                setTimeout(() => {
                    window.location.href = '/login';
                }, 3000);
            });
            z
        } else {
            // No token or error - redirect to login
            document.getElementById('loadingText').textContent = 'Invalid authentication';
            setTimeout(() => {
                window.location.href = '/login';
            }, 2000);
        }
    </script>
</body>
</html>
