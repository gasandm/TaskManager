<?php
session_start();
require_once( "include/connection.php" );
require_once( "include/check_user.php" );

$email = $_POST['email'];
$password = md5($_POST['password']);
$checkbox = $_POST['remember'];

$sql = "SELECT * FROM `users` WHERE `login` LIKE '$email' and `password` LIKE '$password'";

$statement = $pdo->prepare($sql);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);

//Проверка на соответствие
if ($result)
{  //Создание сессии и куки(по желанию)
    $_SESSION['name'] = $_POST['email'];
    //mysqli_close($link);
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
