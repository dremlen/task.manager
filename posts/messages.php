<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');
$login = $_SESSION['isAuth'];

$user = getUserData($login);
if ($user['Модерация'] == 1) {
    $smc = 'Вы сможете просматривать сообщения только после прохождения модерации! ';
} else {
    $messages = getAllMessages();
}
?>

<br><br><br>
<hr>
<div class="left-collum-index">
    <h3>Новые сообщения</h3>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/posts/newMessages.php');
    ?>
    <hr>
    <h3>Прочитанные сообщения</h3>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/posts/readMessages.php');
    ?>
    <?= ($smc ?? '') ?>
    <hr><br>
    <a href="/posts/add.php" style="color:red">Написать сообщение</a>
</div>
<hr><br><br>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php');
?>