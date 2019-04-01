<?php
session_start();
require_once( "include/db_conn.php" );
require_once( "include/check_user.php" );

$taskid = $_GET['id'];
$imgName = $_GET['img_name'];

//Запрос в БД
$sql = "DELETE from tasks where id=$taskid";

query($pdo, $sql);

$delfilename = "img/".basename($imgName);
unlink($delfilename);

header('Location: /list.php');




 ?>
