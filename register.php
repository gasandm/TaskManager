<?php
$email = $_POST['email'];
$password = md5($_POST['password']);
$username = $_POST['name'];

$servername = "localhost";
$dbpass = "";
$dbname = "myBase";
$dbuser = "admin";

$link = mysqli_connect($servername, $dbuser, $dbpass, $dbname);

if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }

$query = "INSERT INTO `users` (`id`, `name`, `login`, `password`) VALUES (NULL, '$username', '$email', '$password')";

$result = $link->query("SELECT * FROM `users` WHERE `login` LIKE '$email'");
if ($result->num_rows > 0) {
    echo "<h1><center>Такой Email-адрес уже используется, возможно вы уже проходили регистрацию. Попробуйте снова...</h1></center>
    ";
    header( 'Refresh:6; URL=register-form.html' );

} else {
    $sql = mysqli_query($link, $query);
    echo "<h1><center>Вы успешно зарегистрированы!<br> Перевод на страницу авторизации...</center></h1>";
    mysqli_close($mysqli);
    header( 'Refresh:4; URL=index.html' );

}

?>
