<?php
session_start();
if (!empty($_SESSION['isAuth'])) {
    unset($_SESSION['isAuth']);
    header('Location:/index.php');
    exit();
}
