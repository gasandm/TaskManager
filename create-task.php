<?php
session_start();
require_once( "include/connection.php" );

if(!isset($_SESSION['name'])) {
    if (!isset($_COOKIE['name'])) {
        header('Location: /index.html');
    }
}
//Получение данных и проверка на пустоту
foreach ($_POST as $key => $value) {
    if(empty($value)) {
        echo "<h2><center>Ошибка ввода. Введите корректные данные.</h2></center>";
        header( 'Refresh:4; URL=register-form.html' );
        exit;
    }
}
$taskname = $_POST['taskname'];
$taskdesc = $_POST['description'];
$filename = $_FILES['filename']['name'];
$tmpfile = $_FILES['filename']['tmp_name'];
$userid = $_SESSION['name'];

//Подготовка запроса
$sql = "INSERT INTO `tasks` (`id`, `user_id`, `taskname`, `task`, `filename`) VALUES (NULL, '$userid', '$taskname', '$taskdesc', '$filename')";

//Добавление в БД и перенос изображения
$statement = $pdo->prepare($sql);
$statement->execute();

$moveimage = move_uploaded_file($tmpfile, "img/".basename($filename));
echo "<h2><center>Задача успешно добавлена!<br></center></h2>";
header( 'Refresh:1; URL=list.php' );
?>
