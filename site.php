<?php
// Включить отображение ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$db_host = 'localhost:3306';
$db_user = 'root';
$db_pass = '12345678';
$db_name = 'lab1';

echo "<h1>Тестирование SQL редактора</h1>";

// Простая проверка подключения
$conn = @new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("<p style='color: red; font-weight: bold;'>Не удалось подключиться к базе данных: " . $conn->connect_error . "</p>");
} else {
    echo "<p style='color: green; font-weight: bold;'>✅ Успешное подключение к базе данных '$db_name'!</p>";
    $conn->set_charset("utf8mb4");
}

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sql_query'])) {
    $query = trim($_POST['sql_query']);
    
    if (!empty($query)) {
        $result = $conn->query($query);
        
        if ($result === false) {
            echo "<div style='background: #ffcccc; padding: 10px; border: 1px solid red;'>
                    <strong>Ошибка SQL:</strong> " . $conn->error . "
                  </div>";
        } elseif ($result === true) {
            echo "<div style='background: #ccffcc; padding: 10px; border: 1px solid green;'>
                    <strong>Успешно!</strong> Затронуто строк: " . $conn->affected_rows . "
                  </div>";
        } else {
            // SELECT запрос
            echo "<p>Найдено строк: " . $result->num_rows . "</p>";
            
            if ($result->num_rows > 0) {
                echo "<table border='1' cellpadding='5'>";
                
                // Заголовки
                echo "<tr>";
                while ($field = $result->fetch_field()) {
                    echo "<th>" . htmlspecialchars($field->name) . "</th>";
                }
                echo "</tr>";
                
                // Данные
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . htmlspecialchars($value ?? 'NULL') . "</td>";
                    }
                    echo "</tr>";
                }
                
                echo "</table>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>SQL Editor</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        textarea { width: 100%; height: 100px; margin: 10px 0; }
        button { padding: 10px 20px; background: blue; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <form method="POST">
        <label for="sql_query">Введите SQL запрос:</label><br>
        <textarea name="sql_query" id="sql_query" placeholder="Пример: SHOW TABLES"></textarea><br>
        <button type="submit">Выполнить</button>
    </form>
</body>
</html>