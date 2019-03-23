<?php
session_start();
$email = $_POST['email'];
$password = md5($_POST['password']);
$checkbox = $_POST['remember'];

$servername = "localhost";
$dbpass = "";
$dbname = "myBase";
$dbuser = "admin";

//Соединение с проверкой к БД
$link = mysqli_connect($servername, $dbuser, $dbpass, $dbname);
if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      session_destroy();
      exit;
    }
//Проверка на соответствие
$result = $link->query("SELECT * FROM `users` WHERE `login` LIKE '$email' and `password` LIKE '$password'");
if ($result->num_rows == 1)
{  //Создание сессии и куки(по желанию)
    $_SESSION['name'] = $_POST['email'];
    mysqli_close($link);
    if($_POST['remember']) {
        setcookie("user", $email, time() + 604800);
    }
    header( 'Refresh:0; URL=list.php' );
    exit;
}
else {
    echo "<h2><center>Неверный логин или пароль. Попробуйте еще раз.</center></h2>";
    mysqli_close($link);
    session_destroy();
    header( 'Refresh:4; URL=index.html' );
}
 ?>
