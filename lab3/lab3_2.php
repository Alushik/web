<?php

declare(strict_types=1);
/*
	ЗАДАНИЕ 1
	- Присвойте переменной $now значение метки времени актуальной даты(сегодня)
	- Присвойте переменной $birthday значение метки времени Вашего дня рождения
	- Создайте переменную $hour
	- С помощью функции getdate() присвойте переменной $hour текущий час
	*/


function DateTime(): array
{
    $now = time();

    $currentYear = (int)date('Y');
    $birthday = mktime(13, 55, 00, 1, 4, $currentYear);

    if ($birthday < $now) {
        $birthday = mktime(13, 55, 00, 1, 4, date('Y') + 1);
    }

    $Date = getdate();
    $hour = $Date['hours'];

    return [
        'now' => $now,
        'birthday' => $birthday,
        'hour' => $hour
    ];
}

function getMessage(int $hour): string
{
    if ($hour >= 0 && $hour < 6) {
        return 'Доброй ночи';
    } elseif ($hour >= 6 && $hour < 12) {
        return 'Доброе утро';
    } elseif ($hour >= 12 && $hour < 18) {
        return 'Добрый день';
    } elseif ($hour >= 18 && $hour <= 23) {
        return 'Добрый вечер';
    } else {
        return 'Доброй ночи';
    }
}

function formatRussianDate(int $timestamp): string
{
    $months = [
        1 => 'января',
        2 => 'февраля',
        3 => 'марта',
        4 => 'апреля',
        5 => 'мая',
        6 => 'июня',
        7 => 'июля',
        8 => 'августа',
        9 => 'сентября',
        10 => 'октября',
        11 => 'ноября',
        12 => 'декабря'
    ];

    $daysOfWeek = [
        'воскресенье',
        'понедельник',
        'вторник',
        'среда',
        'четверг',
        'пятница',
        'суббота'
    ];

    $date = getdate($timestamp);
    $day = $date['mday'];
    $month = $months[$date['mon']];
    $year = $date['year'];
    $dayOfWeek = $daysOfWeek[$date['wday']];
    $time = date('H:i:s', $timestamp);

    return "Сегодня $day $month $year года, $dayOfWeek $time";
}

function getBirthday(int $now, int $birthday): array
{
    $secondsLeft = $birthday - $now;

    $days = floor($secondsLeft / (60 * 60 * 24));
    $hours = floor(($secondsLeft % (60 * 60 * 24)) / (60 * 60));
    $minutes = floor(($secondsLeft % (60 * 60)) / 60);
    $seconds = $secondsLeft % 60;

    return [
        'days' => $days,
        'hours' => $hours,
        'minutes' => $minutes,
        'seconds' => $seconds
    ];
}

$data = DateTime();
$now = $data['now'];
$birthday = $data['birthday'];
$hour = $data['hour'];

$welcome = getMessage($hour);

// Форматирование даты
$formattedDate = formatRussianDate($now);

$timeUntilBirthday = getBirthday($now, $birthday);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Использование функций даты и времени</title>
</head>

<body>
    <h1>Использование функций даты и времени</h1>

    <?php
    /*
	ЗАДАНИЕ 2
	- Используя управляющую конструкцию if – elseif - else присвойте 
	  переменной $welcome значение, изходя из следующих условий
	  если число в переменной $hour попадает в диапазон:
	  * от 0 до 6 - 'Доброй ночи'
	  * от 6 (включительно) до 12 - 'Доброе утро'
	  * от 12 (включительно) до 18 - 'Добрый день'
	  * от 18 (включительно) до 23 - 'Добрый вечер'
	  * Если число в переменной $hour не попадает ни в один из вышеперечисленных
	    диапазонов, то присвойте переменной $welcome значение 'Доброй ночи'
	- Выведите $welcome на отдельной строке
	- Установите локаль ru_RU.UTF-8
	- С помощью функции datefmt_format() на отдельной строке выведите 
	  текущую дату, месяц, год, день недели и время,
	  например, "Сегодня 1 сентября 2018 года, суббота 09:30:00" 
	- На отдельной строке выведите фразу "До моего дня рождения осталось "
	- Выведите количество дней, часов, минут и секунд оставшееся до Вашего дня рождения
	*/
    ?>
<h1><?= $welcome ?></h1>

<p>
    <b>Текущая дата и время:</b><br>
    <?= $formattedDate ?>
</p>

<p>
    <b>До моего дня рождения осталось:</b><br>
    <?= $timeUntilBirthday['days'] ?> дней,
    <?= $timeUntilBirthday['hours'] ?> часов,
    <?= $timeUntilBirthday['minutes'] ?> минут,
    <?= $timeUntilBirthday['seconds'] ?> секунд
</p>
</body>

</html>