<?php

declare(strict_types=1);

/*
ЗАДАНИЕ 1
- Инициализируйте переменную для подсчета количества посещений
- Если соответствующие данные передавались через куки
  сохраняйте их в эту переменную 
- Нарастите счетчик посещений
- Инициализируйте переменную для хранения значения последнего посещения страницы
- Если соответствующие данные передавались из куки, отфильтруйте их и сохраните в эту переменную.
  Для фильтрации используйте функции trim(), htmlspecialchars()
- С помощью функции setcookie() установите соответствующие куки.  Задайте время хранения куки 1 сутки. 
  Для задания времени последнего посещения страницы используйте функцию date()
*/

$vis_count = 0;

function getVisitCountFromCookie(): int
{
    if (isset($_COOKIE['visit_count'])) {
        return (int)trim(htmlspecialchars($_COOKIE['visit_count']));
    }
    return 0;
}

function getLastVisitFromCookie(): string
{
    if (isset($_COOKIE['last_visit'])) {
        return trim(htmlspecialchars($_COOKIE['last_visit']));
    }
    return '';
}

$vis_count = getVisitCountFromCookie();
$lastvisit = getLastVisitFromCookie();

$vis_count++;

$currentDateTime = date('d-m-Y H:i:s');

setcookie('visit_count', (string)$vis_count, time() + 86400);
setcookie('last_visit', $currentDateTime, time() + 86400);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Последний визит</title>
</head>

<body>

    <h1>Последний визит</h1>

    <?php
    /*
ЗАДАНИЕ 2
- Выводите информацию о количестве посещений и дате последнего посещения
*/

    function displayInfo(int $vis_count, string $lastvisit): void
    {
        if ($vis_count === 1) {
            echo "<p>Добро пожаловать!</p>";
        } else {
            echo "<p>Вы зашли на страницу {$vis_count} раз</p>";
            if (!empty($lastvisit)) {
                echo "<p>Последнее посещение: {$lastvisit}</p>";
            }
        }
    }

    displayInfo($vis_count, $lastvisit);
    ?>

</body>

</html>