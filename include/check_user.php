<?php

if(!isset($_SESSION['name'])) {
    if (!isset($_COOKIE['name'])) {
        header('Location: /index.html');
    }
}

?>
