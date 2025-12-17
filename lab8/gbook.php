<?php

declare(strict_types=1);
/* ЗАДАНИЕ 1
- Создайте файл config.php и определите в нём константы DB_NAME, DB_USER, DB_PASSWORD, DB_HOST, DB_CHARSET
- С помощью require_once подключите config.php 
- Подключитесь к серверу MySQL, выберите базу данных
- Установите кодировку по умолчанию для текущего соединения
- 
- Проверьте, была ли корректным образом отправлена форма
- Если она была отправлена: отфильтруйте полученные данные 
  с помощью функций trim(), htmlspecialchars() и mysqli_real_escape_string(),
  сформируйте SQL-оператор на вставку данных в таблицу msgs и выполните его с помощью функции mysqli_query(). 
  После этого с помощью функции header() выполните перезапрос страницы, 
  чтобы избавиться от информации, переданной через форму
*/

/*
ЗАДАНИЕ 3
- Проверьте, был ли запрос методом GET на удаление записи
- Если он был: отфильтруйте полученные данные,
  сформируйте SQL-оператор на удаление записи и выполните его.
  После этого выполните перезапрос страницы, чтобы избавиться от информации, переданной методом GET
*/


require_once 'config.php';

function connectToDb(): mysqli
{
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if ($connection->connect_error) {
        die("Ошибка подключения к базе данных: " . $connection->connect_error);
    }

    $connection->set_charset(DB_CHARSET);

    return $connection;
}

function filterInput(mysqli $connection, string $data): string
{
    $data = trim($data);
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $data = $connection->real_escape_string($data);
    return $data;
}

$connection = connectToDb();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['email'], $_POST['msg'])) {
    $name = filterInput($connection, $_POST['name']);
    $email = filterInput($connection, $_POST['email']);
    $msg = filterInput($connection, $_POST['msg']);

    if (!empty($name) && !empty($email) && !empty($msg)) {
        $sql = "INSERT INTO msgs (name, email, msg) 
                VALUES ('$name', '$email', '$msg')";

        if ($connection->query($sql)) {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "<p style='color: red;'>Ошибка при добавлении сообщения: " . $connection->error . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Все поля должны быть заполнены!</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $deleteId = (int)$_GET['delete_id'];

    if ($deleteId > 0) {
        $sql = "DELETE FROM msgs WHERE id = $deleteId";

        if ($connection->query($sql)) {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "<p style='color: red;'>Ошибка при удалении сообщения: " . $connection->error . "</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гостевая книга</title>
</head>

<body>

    <h1>Гостевая книга</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        Ваше имя:<br>
        <input type="text" name="name"><br>
        Ваш E-mail:<br>
        <input type="email" name="email"><br>
        Сообщение:<br>
        <textarea name="msg" cols="50" rows="5"></textarea><br>
        <br>
        <input type="submit" value="Добавить!">

    </form>

    <?php
    /*
ЗАДАНИЕ 2
- Сформируйте SQL-оператор на выборку всех данных из таблицы
  msgs в обратном порядке и выполните его. Результат выборки
  сохраните в переменной.
- Закройте соединение с БД
-	С помощью функции mysqli_num_rows() получите количество рядов результата выборки и выведите его на экран
- В цикле функцией mysqli_fetch_assoc() получите очередной ряд результата выборки в виде ассоциативного массива.
  Таким образом, используя этот цикл, выведите на экран все сообщения, а также информацию
  об авторе каждого сообщения. После каждого сообщения сформируйте ссылку для удаления этой
  записи. Информацию об идентификаторе удаляемого сообщения передавайте методом GET. 
  Добавьте в обработчик onclick запрос на подверждение удаления записи.
*/
    function displayMessage(mysqli $connection): void
    {
        $sql = "SELECT * FROM msgs ORDER BY id DESC";
        $result = $connection->query($sql);

        if (!$result) {
            echo "<p style='color: red;'>Ошибка при получении сообщений: " . $connection->error . "</p>";
            return;
        }

        $messageCount = $result->num_rows;
        echo "Записей в гостевой книге ($messageCount):";

        if ($messageCount > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='message'>";
                echo "<div class='message-info'>";
                echo "<a href='mailto:" . htmlspecialchars($row['email']) . "'>";
                echo htmlspecialchars($row['name']);
                echo "</a>";
                echo "</div>";
                echo "<div class='message-text'>";
                echo nl2br(htmlspecialchars($row['msg']));
                echo "</div>";
                echo "<a class='delete-link' href='" . htmlspecialchars($_SERVER['PHP_SELF']) .
                    "?delete_id=" . $row['id'] . "' onclick=\"return confirm('Вы уверены, что хотите удалить это сообщение?')\">Удалить</a>";
                echo "</div>";
            }
        } else {
            echo "<p>Пока нет сообщений в гостевой книге.</p>";
        }

        $result->free();
    }

    displayMessage($connection);

    $connection->close();
    ?>

</body>

</html>