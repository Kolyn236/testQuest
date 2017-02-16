<?php



use library\dataBase;



if (isset($_GET['uploadfiles'])) {
    $error = false;
    $files = array();
    $uploaddir = "../images/"; // . - текущая папка где находится submit.php

   # $mysqli = new dataBase();

    // Создадим папку если её нет

    if (!is_dir($uploaddir)) mkdir($uploaddir, 0777);

    // переместим файлы из временной директории в указанную
    foreach ($_FILES as $file) {
        if (move_uploaded_file($file['tmp_name'], $uploaddir . basename($file['name']))) {
            $files[] = realpath($uploaddir . $file['name']);
            $ffile = realpath($uploaddir . $file['name']);
        #   $mysqli->insertRow($ffile, date("His"));
        } else {
            $error = true;
        }
    }

    $data = $error ? array('error' => 'Ошибка загрузки файлов.') : array('files' => $files);

    echo json_encode($data);
}
