<?php
declare(strict_types=1);

namespace MyProject\Classes;

/**
 * Класс обычного пользователя.
 */
class User
{
    /** @var string Имя */
    /** @var string Логин */
    /** @var string Пароль */
    public string $name;
    public string $login;
    private string $password;
/**
* Конструктор User.
*
* @param string $name Имя пользователя
* @param string $login Логин
* @param string $password Пароль
*/
    public function __construct(string $name, string $login, string $password)
    {
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
    }
/**
* Вывод информации.
*/
    public function showInfo(): void
    {
        echo "<p>Имя: {$this->name}<br>Логин: {$this->login}</p>";
    }
/**
* Деструктор.
*/
    public function __destruct()
    {
        echo "<p>Пользователь {$this->login} удален.</p>";
    }
}

