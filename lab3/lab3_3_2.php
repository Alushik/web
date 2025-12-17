<?php
echo "<h1>Загруженные модули</h1>\n";

$extensions = get_loaded_extensions();
$total_functions = 0;

foreach ($extensions as $extension) {
    echo "<h2>$extension</h2>\n";
    echo "<pre>\n";
    
    $functions = get_extension_funcs($extension);
    
    if ($functions && count($functions) > 0) {
        echo " Array ( ";
        foreach ($functions as $index => $function) {
            echo " [$index] => $function";
        }
        echo " ) \n";
        
        $total_functions += count($functions);
    }
    
    echo "<pre>\n";
}

echo "Общее количество функций: $total_functions\n";
?>