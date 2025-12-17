<?php

declare(strict_types=1);

/**
 * Функция построения таблицы умножения
 * 
 * @param int $cols Количество столбцов 
 * @param int $rows Количество строк 
 * @param string $color Цвет фона заголовков 
 * @return int Количество вызовов функции
 */
function getTable(int $cols = 10, int $rows = 10, string $color = 'yellow'): int
{
	static $count = 0;
	$count++;

	echo "<table>";

	echo "<tr>";
	for ($j = 1; $j <= $cols; $j++) {
		echo "<th style='background-color: $color; text-align: center; font-weight: bold;'>" . $j . "</th>";
	}
	echo "</tr>";

	for ($i = 2; $i <= $rows; $i++) {
		echo "<tr>";
		echo "<th style='background-color: $color; text-align: center; font-weight: bold;'>" . $i . "</th>";

		for ($j = 2; $j <= $cols; $j++) {
			echo "<td>" . ($i * $j) . "</td>";
		}
		echo "</tr>";
	}

	echo "</table>";

	return $count;
}

function getMenu($menu, $vertical = true) {
    if (!$vertical) {
        $style = "display: inline-block; margin-right: 10px;";
    } else {
        $style = "";
    }
    
    echo "<ul>";
    foreach ($menu as $item) {
        echo "<li style='$style'><a href='{$item['href']}'>{$item['link']}</a></li>";
    }
    echo "</ul>";
}
?>