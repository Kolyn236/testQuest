<?php
use library\dataBase;

$model = new dataBase();
$arItems = [];
#$model->insertRow("/images33/image.jpg", date("Ymd"));
$arItems = $model->readTable();
if(isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        $model->deleteRow($_GET["id"]);

    }
}
?>
<html>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">


</head>
<body>




<div class="container">
    <table class="table">
        <tr>
            <th>id</th>
            <th>Путь</th>
            <th>Дата</th>

            <th></th>

        </tr>
        <h3><?php foreach ($arItems as $a): ?></h3>
        <tr>
            <td><?= $a['id'] ?></td>
            <td><?= $a['path'] ?></td>
            <td><?= $a['date'] ?></td>
            <!--<td><a href="index.php?action=edit&id=><?/*= $a['id'] */?>">Редактировать</a></td>-->
            <td><a href="index.php?action=delete&id=<?= $a['id'] ?>">Удалить</a></td>

        </tr>
        <?php endforeach ?>
    </table>
</div>
<hr>
<h3>AJAX запрос</h3>
<input type="file" multiple="multiple" accept=".txt,image/*">
<a href="#" class="submit button">Загрузить файлы</a>
<div class="ajax-respond"></div>

<script>


    var files;

    // Вешаем функцию на событие
    // Получим данные файлов и добавим их в переменную

    $('input[type=file]').change(function () {
        files = this.files;
    });


    $('.submit.button').click(function (event) {
        event.stopPropagation(); // Остановка происходящего
        event.preventDefault();  // Полная остановка происходящего

        // Создадим данные формы и добавим в них данные файлов из files

        var data = new FormData();
        $.each(files, function (key, value) {
            data.append(key, value);
        });

        // Отправляем запрос

        $.ajax({
            url: '../library/submit.php?uploadfiles',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Не обрабатываем файлы (Don't process the files)
            contentType: false, // Так jQuery скажет серверу что это строковой запрос
            success: function (respond, textStatus, jqXHR) {

                // Если все ОК

                if (typeof respond.error === 'undefined') {
                    // Файлы успешно загружены, делаем что нибудь здесь


                    // выведем пути к загруженным файлам в блок '.ajax-respond'

                    var files_path = respond.files;
                    var html = '';
                    $.each(files_path, function (key, val) {
                        html += val + '<br>';
                    })
                    $('.ajax-respond').html(html);
                }
                else {
                    console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('ОШИБКИ AJAX запроса: ' + textStatus);
            }
        });

    });

</script>


</body>
</html>