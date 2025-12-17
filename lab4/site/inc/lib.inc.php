<?php
declare(strict_types=1);

function getTable($rows = 5, $cols = 5, $color = 'lightblue') {
    drawTable($rows, $cols, $color);
}

function drawTable(int $cols = 5, int $rows = 5, string $color = 'yellow'): int
{
    static $count = 0;
    $count++;
    
    $html = "<h3>Таблица {$rows}×{$cols} (цвет: $color)</h3>";
    $html .= '<table>';
    for ($i = 1; $i <= $rows; $i++) {
        $html .= '<tr>';
        for ($j = 1; $j <= $cols; $j++) {
            if ($i === 1 || $j === 1) {
                $html .= "<th style='background-color: $color;'>" . ($i * $j) . "</th>";
            } else {
                $html .= "<td>" . ($i * $j) . "</td>";
            }
        }
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    echo $html;
    
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