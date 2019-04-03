<?php
session_start();
require_once( "include/db_conn.php" );
require_once( "include/check_user.php" );

//Получение данных и проверка на пустоту
$taskname = $_POST['taskname'];
$taskdesc = $_POST['description'];
$filename = $_FILES['filename']['name'];
$tmpfile = $_FILES['filename']['tmp_name'];
$userid = $_SESSION['name'];

checkForEmpty($_POST);

//Добавление в БД и перенос изображения
$sql = "INSERT INTO `tasks` (`user_id`, `taskname`, `task`, `filename`) VALUES (:user_id, :taskname, :task, :filename)";

$params = [
    ':user_id' => $userid,
    ':taskname' => $taskname,
    ':task' => $taskdesc,
    ':filename' => $filename,
];

if(query($pdo, $sql, $params)) {
    echo "<h2><center>Задача успешно добавлена!<br></center></h2>";
    $moveimage = move_uploaded_file($tmpfile, "img/".basename($filename));
    header( 'Refresh:1; URL=list.php' );
} else {
    echo "Запрос не выполнен";
}

?>
