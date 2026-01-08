<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход - Медицинский поиск</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-title {
            color: #2c6ca3;
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .city-name {
            color: #666;
            font-size: 16px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }
        
        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .login-btn {
            width: 100%;
            background-color: #2c6ca3;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        
        .login-btn:hover {
            background-color: #1f5a8e;
        }
        
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #2c6ca3;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="login-title">Медицинский поиск</div>
            <div class="city-name">Орёл</div>
        </div>
        
        <form action="#" method="POST">
            <div class="form-group">
                <label class="form-label">Логин или email</label>
                <input type="text" class="form-input" name="username" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Пароль</label>
                <input type="password" class="form-input" name="password" required>
            </div>
            
            <button type="submit" class="login-btn">Войти</button>
        </form>
        
        <a href="index.php" class="back-link">← Вернуться на главную</a>
    </div>
</body>
</html>