<?php
session_start();
require_once( "include/connection.php" );
require_once( "include/check_user.php" );

//Получение данных и проверка на пустоту
foreach ($_POST as $key => $value) {
    if(empty($value)) {
        echo "<h2><center>Ошибка ввода. Введите корректные данные.</h2></center>";
        header( 'Refresh:4; URL=register-form.php' );
        exit;
    }
}
$taskname = $_POST['taskname'];
$taskdesc = $_POST['description'];
$filename = $_FILES['filename']['name'];
$tmpfile = $_FILES['filename']['tmp_name'];
$userid = $_SESSION['name'];

//Добавление в БД и перенос изображения
$sql = "INSERT INTO `tasks` (`id`, `user_id`, `taskname`, `task`, `filename`) VALUES (NULL, '$userid', '$taskname', '$taskdesc', '$filename')";

query($pdo, $sql);

$moveimage = move_uploaded_file($tmpfile, "img/".basename($filename));
echo "<h2><center>Задача успешно добавлена!<br></center></h2>";
header( 'Refresh:1; URL=list.php' );
?>
