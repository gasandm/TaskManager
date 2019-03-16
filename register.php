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
    echo "Такой Email-адрес уже используется, возможно вы уже проходили регистрацию.";
} else {
    $sql = mysqli_query($link, $query);
    echo "Вы успешно зарегистрированы!";
}






mysqli_close($mysqli);

 ?>
