<?php
include($_SERVER['DOCUMENT_ROOT'] . '/config/main_menu.php');
include($_SERVER['DOCUMENT_ROOT'] . '/functions/functions.php');
include($_SERVER['DOCUMENT_ROOT'] . '/functions/functions_db.php');

makeCookie()
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/styles.css" rel="stylesheet">
    <title>Project - ведение списков</title>
</head>

<body>

    <div class="header">
        <div class="logo"><img src="/i/logo.png" width="68" height="23" alt="Project"></div>
        <div class="clearfix"></div>
    </div>
    <div class="clear">
        <?php showMenu($itemsMenu, 'asc', 'headerFont', 'main-menu'); ?>
    </div>
