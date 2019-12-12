<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/functions/functions_db.php');
$login = $_SESSION['isAuth'];

$users = getAllUsers();
$sections = getAllSections();
$colors = getAllColors();
$user = getUserData($login);
if ($user['Модерация'] == 1) {
    $smc = 'Вы не прошли модерацию';
} else {
    if (isset($_POST['messages'])) {
        if (!empty($_POST['header'])) {
            $header = htmlspecialchars(trim($_POST['header']));
        }
        if (!empty($_POST['text'])) {
            $text = htmlspecialchars(trim($_POST['text']));
        }
        if (!empty($_POST['users'])) {
            $user = htmlspecialchars(trim($_POST['users']));
        }
        if (!empty($_POST['sections'])) {
            $section = htmlspecialchars(trim($_POST['sections']));
        }
        if (!empty($_POST['colors'])) {
            $color = htmlspecialchars(trim($_POST['colors']));
        }
        if (isset($header) && isset($text) && isset($user) && isset($section) && isset($color)) {
            if (addMessage($header, $text, $user, $section, $color)) {
                header('Location:/posts/messages.php');
                exit();
            }
        } else {
            $smc = 'Заполните все поля!';
        }
    }
}


?>

<div>
    <h3>Написать сообщение</h3>
</div>
<form method="post">
    <div>
        <label>
            <input type="text" name="header" value="<?= $header ?? '' ?>"> Заголовок
        </label>
    </div><br>
    <div>
        <label>
            <textarea name="text" cols="30" rows="10"></textarea>
        </label>
    </div><br>
    <div>
        <span>Выберите пользователя:</span><br>
        <select name="users">
            <?php
            foreach ($users as $user) : 
                if ($user['block_user'] === '0') : ?>
                    <option value="<?= $user['id'] ?>"><?= $user['email'] ?></option>
                <?php endif ?>
            <?php endforeach ?>
        </select>
    </div><br>
    <div>
        <span>Выберите раздел:</span><br>
        <select name="sections">
            <?php
            foreach ($sections as $value) : ?>
                    <option value="<?= $value['id'] ?>"><?= $value['разделы'] ?></option>
            <?php endforeach ?>
        </select>
    </div><br>
    <div>
        <span>Выберите цвет:</span><br>
        <select name="colors">
            <?php
            foreach ($colors as $value) : ?>
                    <option value="<?= $value['color'] ?>"><?= $value['color'] ?></option>
            <?php endforeach ?>
        </select>
    </div><br>
    <div>
        <label>
            <input type="submit" name="messages" value="отправить">
        </label>
    </div>
</form>
<span style="color:red"><?= $smc ?? '' ?></span>