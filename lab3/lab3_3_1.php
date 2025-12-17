<?php

declare(strict_types=1);
echo "<h1>Список констант PHP</h1>\n";
echo "<pre>\n";

$constants = get_defined_constants();
ksort($constants);

echo "\nВсего: " . count($constants) . " констант\n";
echo "<pre>\n";

foreach ($constants as $name => $value) {
    echo str_pad($name, 40) . " = ";

    if (is_bool($value)) {
        echo $value ? 'true' : 'false';
    } elseif (is_null($value)) {
        echo 'null';
    } elseif (is_array($value)) {
        echo 'Array';
    } else {
        echo $value;
    }

    echo "<pre>\n";
}