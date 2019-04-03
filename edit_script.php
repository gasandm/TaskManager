<?php
session_start();
require_once( "include/db_conn.php" );
require_once( "include/check_user.php" );

//Получение данных с формы
$taskname = $_POST['taskname'];
$taskid = $_POST['task_id'];
$taskdesc = $_POST['description'];
$filename = $_FILES['filename']['name'];
$tmpfile = $_FILES['filename']['tmp_name'];
$userid = $_SESSION['name'];
$oldImg = $_POST['old_img'];

if(empty($taskname) or empty($taskdesc)) {
    echo "<h2><center>Заполните все поля!<br></center></h2>";
    echo "<h2><center><a href=" . $_SERVER['HTTP_REFERER'] . ">Назад</a></center></h2>";
    exit;
};

//Проверка на изменение картинки
if($filename == "") {
    $filename = $_POST['old_img'];
} else {
    $delfilename = "img/".basename($oldImg);
    unlink($delfilename);
}

//Запрос в БД
$sql = "UPDATE `tasks` SET `user_id`=:user_id, `taskname`=:taskname, `task`=:task, `filename`=:filename WHERE `id`=:id";

$params = [
    ':user_id' => $userid,
    ':taskname' => $taskname,
    ':task' => $taskdesc,
    ':filename' => $filename,
    ':id' => $taskid,
];

query($pdo, $sql, $params);

//Перенос картинки
$moveimage = move_uploaded_file($tmpfile, "img/".basename($filename));
echo "<h2><center>Редактирование прошло успешно!<br></center></h2>";
header( 'Refresh:1; URL=list.php' );
?>
