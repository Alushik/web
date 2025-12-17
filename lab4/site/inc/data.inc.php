<?php
declare(strict_types=1);

$cols = $_GET['cols'] ?? 5;
$rows = $_GET['rows'] ?? 7;
$color =  $_SESSION['color'] ??  'lightgreen';

$menu = [
    ['href' => 'index.php', 'link' => 'Домой'],
    ['href' => 'index.php?id=about', 'link' => 'О нас'],
    ['href' => 'index.php?id=contact', 'link' => 'Контакты'],
    ['href' => 'index.php?id=table', 'link' => 'Таблица умножения'],
    ['href' => 'index.php?id=calc', 'link' => 'Калькулятор']
];
?>