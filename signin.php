<?php
session_start();
require_once( "include/db_conn.php" );

$email = $_POST['email'];
$password = md5($_POST['password']);
$checkbox = $_POST['remember'];

$sql = "SELECT * FROM `users` WHERE `login` LIKE :login and `password` LIKE :password";

$params = [
    ':login' => $email,
    ':password' => $password,
];
//Проверка на соответствие
$result = queryFetch($pdo, $sql, $params);
if ($result)
{  //Создание сессии и куки(по желанию)
    $_SESSION['name'] = $_POST['email'];
    require_once( "include/check_user.php" );
    if($_POST['remember']) {
        setcookie("user", $email, time() + 604800);
    }
    header( 'Refresh:0; URL=list.php' );
    exit;
}
else {
    echo "<h2><center>Неверный логин или пароль. Попробуйте еще раз.</center></h2>";
    session_destroy();
    header( 'Refresh:4; URL=index.php' );
}
 ?>
