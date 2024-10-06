<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            direction: rtl; /* لتحديد اتجاه النص إلى اليمين */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px; /* تحديد عرض الحاوية */
            text-align: center;
        }

        .login-container h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
            text-align: right;
        }

        input[type="email"],
        input[type="password"],
        button {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box; /* لتجنب زيادة العرض */
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #218838;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
            display: none; /* سيتم عرضها فقط في حال وجود خطأ */
        }

        .login-container .forgot-password {
            display: block;
            margin-top: -10px;
            margin-bottom: 20px;
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .login-container .forgot-password:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>تسجيل الدخول</h2>
        <form id="loginForm" action="{{ route('login') }}" method="post">
            @csrf
            <div class="error-message" id="errorMessage">يرجى إدخال البريد الإلكتروني وكلمة المرور.</div>

            <label for="email">البريد الإلكتروني:</label>
            <input type="email" id="email" name="email" placeholder="أدخل بريدك الإلكتروني" required>

            <label for="password">كلمة المرور:</label>
            <input type="password" id="password" name="password" placeholder="أدخل كلمة المرور" required>


            <button type="submit">تسجيل الدخول</button>
        </form>
    </div>

    

</body>
</html>
