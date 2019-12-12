<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');
$login = $_SESSION['isAuth'];

$user = getUserData($login);
if ($user['Модерация'] == 1) {
    $user['Модерация'] = 'Вы не прошли модерацию';
} else {
    $user['Модерация'] = 'Модерация пройдена';
}
if ($user['Уведомление email'] == 1) {
    $user['Уведомление email'] = 'Отправлять уведомление';
} else {
    $user['Уведомление email'] = 'Не отправлять уведомления';
}

$groups = getUserGroups($login);
?> <div><br><br>
    <h2 class="left-collum-index">Личный кабинет</h2>
</div>
<div class="left-collum-index">
    <p>Ваши данные:</p>
    <ul>
        <?php
        foreach ($user as $k => $v) : ?>
            <li><?= $k . ': ' . $v ?></li>
        <?php endforeach ?>
    </ul>

    <p>Ваши группы:</p>
    <ul>
        <?php
        foreach ($groups as $value) :
            foreach ($value as $k => $v) : ?>
                <li><?= $k . ': ' . $v ?></li>
            <?php endforeach ?>
        <?php endforeach ?>
    </ul>
    <p>Просмотр сообщений <a href="/posts/messages.php">Перейти</a></p>
</div>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php');
?>