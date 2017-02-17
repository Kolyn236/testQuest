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
    public $mysqliOb;

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
        #При создании обьекта сразу создаём таблицу, 
        $this->insertTable();
    }

    public function insertTable()
    {
        if ($this->mysqliOb->query("CREATE TABLE IF NOT EXISTS pops (
        ID int NOT NULL AUTO_INCREMENT ,
        path VARCHAR (45),
        date DATE,
        PRIMARY KEY (ID))")
        ) {
            echo "Таблица в БД создана успешно, либо таблица уже существует";
        } else {
            die('Ошибка, не удаётся создать таблицу');
        }
    }

    public function insertRow($path, $date)
    {
        $t = "INSERT INTO pops (path,date) VALUES('%s','%s')";
        $query = sprintf($t, $path, $date);
        if ($this->mysqliOb->query($query)) {
            echo 'Запись успешно произведена';
        } else die('произошла ошибка');

    }

    public function readTable()
    {
        $sql = "SELECT id, path, date FROM pops";
        $result = $this->mysqliOb->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"] . " - Path: " . $row["path"] . " " . $row["date"] . "<br>";
            }
        } else {
            echo "0 results";
        }
    }

    public function deleteRow($id)
    {
        $sql = "DELETE FROM pops WHERE id=%d";
        $query = sprintf($sql, $id);
        if ($this->mysqliOb->query($query)) {
            echo "Запрос выполнен успешно";
        } else {
            echo "Запрос не выполнен";
        }
    }
}