<?php
session_start();
$email = $_POST['email'];
$password = md5($_POST['password']);
$checkbox = $_POST['remember'];

//Соединение с БД
$link = mysqli_connect("localhost", "admin", "", "myBase");

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
