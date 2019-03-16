<?php
$email = $_POST['email'];
$password = md5($_POST['password']);
$checkbox = $_POST['remember'];

$servername = "localhost";
$dbpass = "";
$dbname = "myBase";
$dbuser = "admin";

$link = mysqli_connect($servername, $dbuser, $dbpass, $dbname);
if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }
 ?>
