<?php
session_start();

if(isset($_SESSION['name'])) {
    $_SESSION['name'] = NULL;
    setcookie("user", $email, time() - 1);
} else {
    setcookie("user", $email, time() - 1);
}

session_destroy();
header('Location: /index.html');

 ?>
