<?php
session_start();

if(isset($_SESSION['name'])) {
    $_SESSION['name'] = NULL;
    unset($_COOKIE['name']);
} else {
    unset($_COOKIE['name']);
}

session_destroy();
header('Location: /index.html');

 ?>
