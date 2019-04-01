<?php
$config = require_once 'config.php';

$pdo = new PDO('mysql:host='.$config['host'].';dbname='.$config['db_name'], $config['username'], $config['password']);

function query($pdo, $sql){
    $statement = $pdo->prepare($sql);
    $statement->execute();
}

function queryFetch($pdo, $sql){
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $result = $statement->fetch();
    return $result;
}

function queryFetchAssoc($pdo, $sql){
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function checkForEmpty($arr){
    foreach ($arr as $key => $value) {
        if(empty($value)) {
            echo "<h2><center>Ошибка ввода. Введите корректные данные.<br></h2></center>";
            echo "<h2><center><a href=" . $_SERVER['HTTP_REFERER'] . ">Назад</a></center></h2>";
        }
    }
}
?>
