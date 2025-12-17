<?php
declare(strict_types=1);

// Код для всех страниц - сохранение информации о посещенных страницах


/*
ЗАДАНИЕ 1
- Создайте в сессии либо 
	- массив для хранения всех посещенных страниц и сохраните в качестве его очередного элемента путь к текущей странице. 
	- строку с уникальным разделителем и последовательно её дополняйте

*/

function saveVisitedPage(string $pagePath): void {
    if (!isset($_SESSION['visited_pages'])) {
        $_SESSION['visited_pages'] = [];
    }
    
    $_SESSION['visited_pages'][] = $pagePath;
}

$currentPage = $_SERVER['PHP_SELF'];
saveVisitedPage($currentPage);
?>