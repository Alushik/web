<?php
declare(strict_types=1);

function getTable(int $cols = 5, int $rows = 5, string $color = 'greenyellow'): int
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
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица умножения</title>
    <style>
        table {
            border: 2px solid black;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid black;
            text-align: center;
        }

        th {
            font-weight: bold;
        }
    </style>
</head>
<body> 
    <h1>Таблица умножения</h1>
    <?php

    $count1 = getTable();

    $count2 = getTable(3);

    $count3 = getTable(4, 6);

    $count4 = getTable(7, 8, 'lightblue');
 
    echo "<p><strong>Общее количество вызовов функции getTable(): $count4</strong></p>";
    ?> 
</body>

</html>