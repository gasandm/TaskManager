<?php
require_once( "include/db_conn.php" );

//Проверка на пустоту
foreach ($_POST as $key => $value) {
    if(empty($value)) {
        echo "<h2><center>Ошибка ввода. Введите корректные данные.</h2></center>";
        header( 'Refresh:3; URL=register-form.php' );
        exit;
    }
}
//Получение данных с формы
$email = $_POST['email'];
$password = md5($_POST['password']);
$username = $_POST['name'];

//Подготовка запроса
$sqlCompare = "SELECT * FROM `users` WHERE `login` LIKE :login";

$paramsCompare = [
    ':login' => $email,
];
//Проверка на существование
$checkUser = queryFetch($pdo, $sqlCompare, $paramsCompare);
if ($checkUser)
{
    echo "<h2><center>Такой Email-адрес уже используется, возможно вы уже проходили регистрацию. Попробуйте снова...</h2></center>
    ";
    header( 'Refresh:4; URL=register-form.php' );
    exit;
}
else {
    $params = [
        ':name' => $username,
        ':login' => $email,
        ':password' => $password,
    ];
    //Добавление в БД
    $sql = "INSERT INTO `users` (`name`, `login`, `password`) VALUES (:name, :login, :password)";
    query($pdo, $sql, $params);
    echo "<h2><center>Вы успешно зарегистрированы!<br> Перевод на страницу авторизации...</center></h2>";
    header( 'Refresh:3; URL=index.php' );
}

?>
