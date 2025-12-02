<?php
define('My_const', 'Моя константы');
?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Константы</title>
</head>

<body>
	<h1>Константы</h1>
	<?php
	if (defined('My_const')) {
		echo "Значение константы: " . My_const . "<br>";
	} else {
		echo "Константа CONST не определена.<br>";
	}

	echo "Текущая версия PHP: " . PHP_VERSION . "<br>";
	echo "Директория скрипта: " . __DIR__ . "<br>";
	?>
</body>

</html>