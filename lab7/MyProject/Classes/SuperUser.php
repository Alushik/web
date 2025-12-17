<?php

namespace MyProject\Classes;

class SuperUser extends User
{
    public $role;

    public function __construct(string $name, string $login, string $password, string $role)
    {
        parent::__construct($name, $login, $password);
        $this->role = $role;
    }

    /**
     * Выводит информацию о суперпользователе
     */
    public function showInfo(): void
    {
        echo "<div style='padding: 10px'>";
        echo "<h3>Информация о суперпользователе:</h3>";
        echo "<p><strong>Имя:</strong> {$this->name}</p>";
        echo "<p><strong>Логин:</strong> {$this->login}</p>";
        echo "<p><strong>Пароль:</strong> ******</p>";
        echo "<p><strong>Роль:</strong> {$this->role}</p>";
        echo "</div>";
    }
}
