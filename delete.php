<?php
session_start();
require_once( "include/connection.php" );
require_once( "include/check_user.php" );

$taskid = $_GET['id'];
$imgName = $_GET['img_name'];

//Запрос в БД
$sql = 'DELETE from tasks where id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([
    ':id' => $taskid
]);

$delfilename = "img/".basename($imgName);
unlink($delfilename);

header('Location: /list.php');




 ?>
