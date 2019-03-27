<?php
session_start();
$taskid = $_GET['id'];
$imgName = $_GET['img_name'];
$pdo = new PDO('mysql:host=localhost;dbname=myBase', 'admin', '');

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
