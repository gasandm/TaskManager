<?php
//Получение данных с формы
$email = $_POST['email'];
$password = md5($_POST['password']);
$username = $_POST['name'];

//Проверка на пустоту
foreach ($_POST as $key => $value) {
    if(empty($value)) {
        echo "<h2><center>Ошибка ввода. Введите корректные данные.</h2></center>";
        header( 'Refresh:4; URL=register-form.html' );
        exit;
    }
}

$servername = "localhost";
$dbpass = "";
$dbname = "myBase";
$dbuser = "admin";

//Соединение с проверкой к БД
$link = mysqli_connect($servername, $dbuser, $dbpass, $dbname);
if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }

//Подготовка запроса
$query = "INSERT INTO `users` (`id`, `name`, `login`, `password`) VALUES (NULL, '$username', '$email', '$password')";

//Проверка на существование
$result = $link->query("SELECT * FROM `users` WHERE `login` LIKE '$email'");
if ($result->num_rows > 0)
{
    echo "<h2><center>Такой Email-адрес уже используется, возможно вы уже проходили регистрацию. Попробуйте снова...</h2></center>
    ";
    header( 'Refresh:6; URL=register-form.html' );
    exit;
}
else {
    //Добавление в БД
    $sql = mysqli_query($link, $query);
    echo "<h2><center>Вы успешно зарегистрированы!<br> Перевод на страницу авторизации...</center></h2>";
    mysqli_close($link);
    header( 'Refresh:4; URL=index.html' );
}

?>
