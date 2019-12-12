<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/functions/functions_db.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/functions/functions.php');


?>
<td class="right-collum-index">

    <div class="project-folders-menu">
        <ul class="project-folders-v">
            <li class="project-folders-v-active"><?php include($_SERVER['DOCUMENT_ROOT'] . '/template/buttonAuthorization.php') ?></li>
            <li><a href="/template/registration.php">Регистрация</a></li>
            <li><a href="#">Забыли пароль?</a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <?php
    if (isset($_GET['login']) && $_GET['login'] == 'yes') {
        makeCookie();
        include($_SERVER['DOCUMENT_ROOT'] . '/template/form.php');
    }
    makeAuthorization()
    ?>
</td>