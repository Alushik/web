<?php

namespace MyProject\Classes;

class User
{
    public $name;
    public $login;
    private $password;

    /**
     * Конструктор 
     */
    public function __construct(string $name, string $login, string $password)
    {
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        echo "Пользователь с именем {$this->login} создан<br>";
    }

    /**
     * Выводит информацию о пользователе
     */
    public function showInfo(): void
    {
        echo "<div style='padding: 10px'>";
        echo "<h3>Информация о пользователе:</h3>";
        echo "<p><strong>Имя:</strong> {$this->name}</p>";
        echo "<p><strong>Логин:</strong> {$this->login}</p>";
        echo "<p><strong>Пароль:</strong> ******</p>";
        echo "</div>";
    }

    /**
     * Деструктор 
     */
    public function __destruct()
    {
        echo "Пользователь {$this->login} удален<br>";
    }
}