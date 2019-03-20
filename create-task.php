<?php
session_start();
//Получение данных с формы
$taskname = $_POST['taskname'];
$taskdesc = $_POST['description'];
$filename = $_FILES['filename']['name'];

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
$query = "INSERT INTO `tasks` (`taskname`, `task`, `filename`) VALUES ('$taskname', '$taskdesc', '$filename')";

//Добавление в БД и перенос изображения
$sql = mysqli_query($link, $query);
$tmpfile = $_FILES['filename']['tmp_name'];
$moveimage = move_uploaded_file($tmpfile, "img/".basename($filename));
echo "<h2><center>Задача успешно добавлена!<br></center></h2>";
mysqli_close($link);
header( 'Refresh:6; URL=list.php' );
?>
