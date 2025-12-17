<?php
declare(strict_types=1);

use MyProject\Classes\User;
use MyProject\Classes\SuperUser;


spl_autoload_register(function ($class) {


    $prefix = 'MyProject\\';

    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }


    $relative = substr($class, strlen($prefix)); 

    // Преобразуем namespace
    $file = __DIR__ . '/' . str_replace('\\', '/', $relative) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});


$user1 = new User("Иван", "ivan123", "pass1");
$user1->showInfo();

$admin = new SuperUser("Админ", "root", "pass", "administrator");
$admin->showInfo();