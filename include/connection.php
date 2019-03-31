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
?>
