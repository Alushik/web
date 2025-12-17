<?php
declare(strict_types=1);

function swap(&$a, &$b): void
{
    $temp = $a;
    $a = $b;
    $b = $temp;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Демонстрация функции swap</title>
</head>
<body>
    <h1>Демонстрация функции swap</h1>
    <?php
    $a = 5;
    $b = 8;
    echo "До swap: a = $a, b = $b<br>";
    swap($a, $b);
    echo "После swap: a = $a, b = $b<br>";
    echo "5 === \$b: " . (5 === $b ? 'true' : 'false') . "<br>";
    echo "8 === \$a: " . (8 === $a ? 'true' : 'false') . "<br><br>";

    echo var_dump(5 === $b) . "<br>";
	echo var_dump(8 === $a);
    ?> 
</body>
</html>