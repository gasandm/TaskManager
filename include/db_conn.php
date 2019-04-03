<?php
$config = require_once 'config.php';

$pdo = new PDO('mysql:host='.$config['host'].';dbname='.$config['db_name'], $config['username'], $config['password']);

function query($pdo, $sql, $params = []) {
    $statement = $pdo->prepare($sql);
    if(!empty($params)) {
        foreach ($params as $key => $val) {
            $statement->bindValue($key, $val);
        }
    }
    $statement->execute();
    return $statement;
}

function queryFetch($pdo, $sql, $params = []) {
    $statement = $pdo->prepare($sql);
    if(!empty($params)) {
        foreach ($params as $key => $val) {
            $statement->bindValue($key, $val);
        }
    }
    $statement->execute();
    $result = $statement->fetch();
    return $result;
}

function queryFetchAssoc($pdo, $sql, $params = []) {
    $statement = $pdo->prepare($sql);
    if(!empty($params)) {
        foreach ($params as $key => $val) {
            $statement->bindValue($key, $val);
        }
    }
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
