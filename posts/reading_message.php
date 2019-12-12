<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');

$name = $_GET['id'] ?? null;

$message = getMessage($name);
$status_id = $message['id'];
if ($message['status'] == NULL) {
    changeStatusMessage($status_id);
}
?>
<div><br><br>
    <h3 class="left-collum-index">Сообщение</h3>
</div>
<div class="left-collum-index">
    <p><?= $message['header'] ?></p>
    <p><?= $message['created_at'] ?></p>
    <p><?= $message['user_sender'] ?></p>
    <p><?= $message['text'] ?></p>
</div>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php');
?>