<?php
session_start();
$taskid = $_GET['id'];

$pdo = new PDO('mysql:host=localhost;dbname=myBase', 'admin', '');

//Запрос в БД
$sql = 'DELETE from tasks where id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([
    ':id' => $taskid
]);

header('Location: /list.php');




 ?>
