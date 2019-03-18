<?php
session_start();
//Получение данных с формы
$taskname = $_POST['taskname'];
$taskdesc = $_POST['description'];
$filepath = $_POST['filepath'];

//Проверка на пустоту
foreach ($_POST as $key => $value) {
    if(empty($value)) {
        echo "<h2><center>Ошибка ввода. Введите корректные данные.</h2></center>";
        header( 'Refresh:4; URL=register-form.html' );
        exit;
    }
}

$servername = "localhost";
$dbpass = "";
$dbname = "myBase";
$dbuser = "admin";

//Соединение с проверкой к БД
$link = mysqli_connect($servername, $dbuser, $dbpass, $dbname);
if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }

//Подготовка запроса
$query = "INSERT INTO `tasks` (`taskname`, `task`, `filepath`) VALUES ('$taskname', '$taskdesc', '$filepath')";

//Добавление в БД
$sql = mysqli_query($link, $query);
echo "<h2><center>Задача успешно добавлена!</center></h2>";
mysqli_close($link);
header( 'Refresh:2; URL=list.php' );
?>
