<?php

declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загрузка файла на сервер</title>
</head>

<body>
    <div>
        <?php
        /*
ЗАДАНИЕ
- Проверьте, отправлялся ли файл на сервер
- В случае, если файл был отправлен, выведите: имя файла, размер, имя временного файла, тип, код ошибки
- Для проверки типа файла используйте функцию mime_content_type() из модуля Fileinfo
- Если загружен файл типа "image/jpeg", то с помощью функции move_uploaded_file() переместите его в каталог upload. В качестве имени файла используйте его MD5-хеш.

*/

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fupload'])) {
            $file = $_FILES['fupload'];

            echo 'Имя файла: ' . htmlspecialchars($file['name']) . "<br>";
            echo 'Размер файла: ' . $file['size'] . " байт<br>";
            echo 'Имя временного файла: ' . htmlspecialchars($file['tmp_name']) . "<br>";
            echo 'Тип файла: ' . htmlspecialchars($file['type']) . "<br>";
            echo 'Код ошибки: ' . $file['error'] . "<br>";

            if ($file['error'] === UPLOAD_ERR_OK) {
                $tempFilePath = $file['tmp_name'];

                if (mime_content_type($tempFilePath) === 'image/jpeg') {
                    $uploadDir = 'upload/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $newFileName = md5_file($tempFilePath) . '.jpg';
                    $uploadFilePath = $uploadDir . $newFileName;

                    if (move_uploaded_file($tempFilePath, $uploadFilePath)) {
                        echo 'Файл успешно загружен в директорию: ' . htmlspecialchars($uploadFilePath);
                    } else
                        echo 'Ошибка при перемещении файла.';
                } else
                    echo 'Неверный тип файла.';

            } else
                echo 'Ошибка загрузки файла. Код ошибки: ' . $file['error'];

        }
        ?>

    </div>
    <form enctype="multipart/form-data"
        action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
            <input type="file" name="fupload"><br>
            <button type="submit">Загрузить</button>
        </p>
    </form>
</body>

</html>