<?php
declare(strict_types=1);

// Код для всех страниц - вывод информации о посещенных страницах

/*
ЗАДАНИЕ 2
- В случае сохранения данных 
	- в массив, проверьте, существует ли он в сессии
	- в строку, преобразуйте её в массив
- Выводите в цикле список всех посещённых пользователем страниц

*/

function displayVisitedPages(): void {
    if (isset($_SESSION['visited_pages']) && !empty($_SESSION['visited_pages'])) {
        echo "<h3>Список посещённых страниц:</h3>";
        echo "<ul>";
        
        foreach ($_SESSION['visited_pages'] as $index => $page) {
            $pageName = basename($page); 
            echo "<li>" . ($index + 1) . ". $pageName</li>";
        }
        
        echo "</ul>";
    } else {
        echo "<p>Вы еще не посещали другие страницы.</p>";
    }
}

displayVisitedPages();
?>