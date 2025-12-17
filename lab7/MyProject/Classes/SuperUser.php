<?php
declare(strict_types=1);

namespace MyProject\Classes;


/**
 * Класс расширенного пользователя с правами администратора.
 */
class SuperUser extends User
{
/** @var string Уровень прав */
    public string $role;
/**
 * Конструктор SuperUser.
 *
 * @param string $name Имя пользователя
 * @param string $login Логин
 * @param string $email Электронная почта
 * @param string $role Уровень прав
*/
    public function __construct(string $name, string $login, string $password, string $role)
    {
        parent::__construct($name, $login, $password);
        $this->role = $role;
    }
/**
 * Вывод информации.
*/
    public function showInfo(): void
    {
        echo "<p>Имя: {$this->name}<br>Логин: {$this->login}<br>Роль: {$this->role}</p>";
    }
}

