<?php

namespace library;
/**
 * Created by PhpStorm.
 * User: usver
 * Date: 16.02.2017
 * Time: 20:52
 */
class dataBase
{
    public  $mysqliOb;
    function __construct()
    {
        $db_host = "localhost";
        $db_user = "root"; // Логин БД
        $db_password = ""; // Пароль БД
        $db_table = "mytable"; // Имя Таблицы БД

        // Подключение к базе данных
        $mysqli = new \mysqli($db_host, $db_user, $db_password, $db_table);
        if ($mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            die('Ошибка подключения');
        }
        $this->mysqliOb = $mysqli;
    }
    public function insertTable(){
        if($this->mysqliOb->query("CREATE TABLE IF NOT EXISTS pops (id INT , path VARCHAR (45), date DATE)")){
            echo "Запись в БД произведена успешно";
        }else{
            die('Ошибка, не удаётся создать таблицу, либо она уже существует');
        }
    }
    public function insertRow($path,$date){
        $t = "INSERT INTO pops (path,date) VALUES('%s','%s')";
        $query = sprintf($t,$path,$date);
        if($this->mysqliOb->query($query)){
            echo 'Запись успешно произведена';
        }else die('произошла ошибка');

    }
}