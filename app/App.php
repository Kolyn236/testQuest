<?php
/**
 * Created by PhpStorm.
 * User: usver
 * Date: 13.02.2017
 * Time: 12:50
 */

namespace app;


class App
{
    public static function connectDB(){
        $db_host = "localhost";
        $db_user = "root"; // Логин БД
        $db_password = ""; // Пароль БД
        $db_table = "mytable"; // Имя Таблицы БД

        // Подключение к базе данных
        $mysqli = new \mysqli($db_host,$db_user,$db_password, $db_table);
        if ($mysqli->connect_errno){
            echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            die('Ошибка подключения');
        }
        return $mysqli;
    }
    public function showView($view){
        include_once 'view/'.$view.'.php';
    }



}