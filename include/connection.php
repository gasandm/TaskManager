<?php
$config = require_once 'config.php';

$pdo = new PDO('mysql:host='.$config['host'].';dbname='.$config['db_name'], $config['username'], $config['password']);

?>
