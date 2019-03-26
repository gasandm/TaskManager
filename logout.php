<?php
session_start();

if(isset($_SESSION['name'])) {
    $_SESSION['name'] = NULL;
}
session_destroy();
header('Location: /index.html');

 ?>
