<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/functions/functions_db.php');

if (isset($_POST['registration'])) {
    if (!empty($_POST['fullName'])) {
        $fullName = htmlspecialchars(trim($_POST['fullName']));
    }
    if (!empty($_POST['login'])) {
        $login = htmlspecialchars(trim($_POST['login']));
    }
    if (!empty($_POST['phone'])) {
        $phone = htmlspecialchars(trim($_POST['phone']));
    }
    if (!empty($_POST['password'])) {
        $password = htmlspecialchars(trim($_POST['password']));
    }
    if (isset($_POST['is_notification'])) {
        $is_notification = $_POST['is_notification'];
    } else {
        $is_notification = 0;
    }
    if (isset($fullName) && isset($login) && isset($phone) && isset($password)) {
        if (addUser($fullName, $login, $phone, $password, $is_notification)) {
            header('Location:/index.php');
            exit();
        }
     } else {
        $smc = 'Заполните все поля!';
    }
}
?>
<h3>Регистраиця пользователя</h3>
<form method="post">
    <div>
        <label>
            <input type="text" name="fullName" value="<?= $fullName ?? '' ?>"> Фамилия Имя Отчество
        </label>
    </div><br>
    <div>
        <label>
            <input type="email" name="login" value="<?= $login ?? '' ?>"> Ваш email
        </label>
    </div><br>
    <div>
        <label>
            <input type="phone" name="phone" value="<?= $phone ?? '' ?>"> Номер телефона
        </label>
    </div><br>
    <div>
        <label>
            <input type="password" name="password" value="<?= $password ?? '' ?>"> Введите пароль
        </label>
    </div><br>
    <div>
        <label>
            <input type="checkbox" name="is_notification" value="1" checked> Получать уведомления на email
        </label>
    </div><br>
    <div>
        <label>
            <input type="submit" name="registration" value="Зарегистрировать">
        </label>
    </div>
</form>
<span style="color:red"><?= $smc ?? '' ?></span>