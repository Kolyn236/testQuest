<?php
/**
 * Created by PhpStorm.
 * User: usver
 * Date: 14.02.2017
 * Time: 22:37
 */
spl_autoload_register(function ($class) {
    include $class . '.php';
});


# когда создаю обьект да да да

$app = new \app\App();

$app->showView('index');