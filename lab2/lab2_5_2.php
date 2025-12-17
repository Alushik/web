<?php

declare(strict_types=1);

/**
 * Функция map применяет callback-функцию ко всем элементам массива и возвращает новый массив
 * 
 * @param array $array Исходный массив для обработки
 * @param callable $callback Функция, применяемая к каждому элементу массива
 * @return array Новый массив с результатами применения callback-функции
 */
function map(array $array, callable $callback): array
{
    $result = [];
    foreach ($array as $value) {
        $result[] = $callback($value);
    }
    return $result;
}

$vars = [1, 2, 3, 4, 5];

/**
 * Функция fn возводит число в квадрат
 * 
 * @param int|float $var Число для возведения в квадрат
 * @return int|float Взвращает квадрат числа
 */
$squaredvars = map($vars, fn($num) => $num ** 2);

print_r($squaredvars);