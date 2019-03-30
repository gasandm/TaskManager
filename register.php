<?php
require_once( "include/connection.php" );
require_once( "include/check_user.php" );

//Проверка на пустоту
foreach ($_POST as $key => $value) {
    if(empty($value)) {
        echo "<h2><center>Ошибка ввода. Введите корректные данные.</h2></center>";
        header( 'Refresh:4; URL=register-form.php' );
        exit;
    }
}
//Получение данных с формы
$email = $_POST['email'];
$password = md5($_POST['password']);
$username = $_POST['name'];

//Подготовка запроса
$sql = "INSERT INTO `users` (`id`, `name`, `login`, `password`) VALUES (NULL, '$username', '$email', '$password')";


//Проверка на существование
$check = $pdo->prepare("SELECT * FROM `users` WHERE `login` LIKE '$email'");
$check->execute();
$checkUser = $check->fetch();
if ($checkUser)
{
    echo "<h2><center>Такой Email-адрес уже используется, возможно вы уже проходили регистрацию. Попробуйте снова...</h2></center>
    ";
    header( 'Refresh:4; URL=register-form.php' );
    exit;
}
else {
    //Добавление в БД
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $result = $statement->fetch();
    echo "<h2><center>Вы успешно зарегистрированы!<br> Перевод на страницу авторизации...</center></h2>";
    header( 'Refresh:4; URL=index.php' );
}

?>
