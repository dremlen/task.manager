<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');


/** проверяет логин и пароли из БД
 * @param string $login;
 * @param string $password;
 * @return возвращаем совпадает или нет
 */
function userAuthorization($login, $password)
{
    $connect = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
    if (mysqli_connect_errno()) {
        return mysqli_connect_error();
    } else {
        $query = sprintf("SELECT * FROM users WHERE email = '%s'",
        mysqli_real_escape_string($connect, $login));
        $result = mysqli_query($connect, $query);
        $arroy = mysqli_fetch_assoc($result);
        $hash = $arroy['cod'];
        $pass = password_verify($password, $hash);
        mysqli_close($connect);
        if ($password == $pass) {
            return true;
        } else {
            return false;
        }
    }
}

/** выбирает данные из таблиц users
 * @param string $login;
 * @return массив с данными пользователя 
 */
function getUserData($login)
{
    $connect = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
    if (mysqli_connect_errno()) {
        return mysqli_connect_error();
    } else {
        $query = sprintf("SELECT block_user as 'Модерация', fullname as 'ФИО', email as 'Логин', phone as 'Телефон', is_notification as 'Уведомление email'
        FROM  users WHERE email = '%s'",
        mysqli_real_escape_string($connect, $login));
        $result = mysqli_query($connect, $query);
        mysqli_close($connect);
        return (mysqli_fetch_assoc($result));
    } 
}

/** выбирает данные из таблиц users и groups
 * @param string $login;
 * @return массив с группами пользователя из таблиц
 */
function getUserGroups($login)
{
    $connect = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
    if (mysqli_connect_errno()) {
        return mysqli_connect_error();
    } else {
        $query = sprintf("SELECT groups.name as 'Группы' FROM users
        JOIN group_user on users.id = group_user.user_id
        JOIN groups on groups.id = group_user.group_id
         WHERE email = '%s'",
        mysqli_real_escape_string($connect, $login)); 
        $result = mysqli_query($connect, $query);
        mysqli_close($connect);
        return(mysqli_fetch_all($result, MYSQLI_ASSOC));
    }
}

/** регистрирует пользователя
 * @param string $fullname;
 * @param string $email;
 * @param integer $phone;
 * @param string $password;
 * @param boolean $is_notification;
 * @return возвращает true или false
 */
function addUser($fullName, $email, $phone, $password, $is_notification)
{
    $connect = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
    if (mysqli_connect_errno()) {
        return mysqli_connect_error();
    } else {
        $fullName = mysqli_real_escape_string($connect, $fullName);
        $email = mysqli_real_escape_string($connect, $email);
        $phone = mysqli_real_escape_string($connect, "$phone");
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (block_user, fullname, email, phone, cod, is_notification) 
        value('1', '$fullName', '$email', '$phone', '$pass', '$is_notification')";
        $result = mysqli_query($connect, $query);
        mysqli_close($connect);
        return $result;
    }
}

/** выбирает все пользователей  из таблицы пользователей
 * @return двумерный массив пользователей
 */
function getAllUsers()
{
    $connect = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
    if (mysqli_connect_errno()) {
        return mysqli_connect_error();
    } else {
        $query = "SELECT id, block_user, email FROM users";
        $result = mysqli_query($connect, $query);
        mysqli_close($connect);
        return (mysqli_fetch_all($result, MYSQLI_ASSOC));
    }
}

/** выбирает все разделы из таблицы
 * @return двумерный массив разделов
 */
function getAllSections()
{
    $connect = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
    if (mysqli_connect_errno()) {
        return mysqli_connect_error();
    } else {
        $query = "SELECT id, `name` as 'разделы' FROM sections";
        $result = mysqli_query($connect, $query);
        mysqli_close($connect);
        return (mysqli_fetch_all($result, MYSQLI_ASSOC));
    }
}

/** выбирает все цвета из таблицы
 * @return двумерный массив цветов
 */
function getAllColors()
{
    $connect = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
    if (mysqli_connect_errno()) {
        return mysqli_connect_error();
    } else {
        $query = "SELECT id, color FROM colors";
        $result = mysqli_query($connect, $query);
        mysqli_close($connect);
        return (mysqli_fetch_all($result, MYSQLI_ASSOC));
    }
}

/** создает сообщение
 * @param передает введенные данные 
 * @return результат добавления сообщения
 */
function addMessage($header,$text, $user, $section, $color)
{
    $connect = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
    if (mysqli_connect_errno()) {
        return mysqli_connect_error();
    } else {
        $header = mysqli_real_escape_string($connect, $header);
        $text = mysqli_real_escape_string($connect, $text);
        $user_recipient = mysqli_real_escape_string($connect, $user);
        $user_sender = $_SESSION['isAuth'];
        $color = mysqli_real_escape_string($connect, $color);
        $query = "INSERT INTO messages (header, `text`, user_sender, user_recipient, section_id, color)
         value ('$header', '$text', '$user_sender', '$user_recipient', '$section', '$color')";
        $result = mysqli_query($connect, $query);
        mysqli_close($connect);
        return $result;  
    }
}

/** выбирает все сообщения
 * @return массив с сообщениями
 */
function getAllMessages()
{
    $connect = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
    if (mysqli_connect_errno()) {
        return mysqli_connect_error();
    } else {
        $user_recipient = $_SESSION['isAuth'];
        $query = "SELECT header as 'Заголовок', `status`, sections.name as 'Название' FROM messages
        JOIN sections ON messages.section_id = sections.id 
        JOIN users ON messages.user_recipient = users.id WHERE user_recipient = users.id";
        $result = mysqli_query($connect, $query);
        mysqli_close($connect);
        return (mysqli_fetch_all($result, MYSQLI_ASSOC));
    }
}

/** выбирает одно сообщение
 * 
 */
function getMessage($name)
{
    $connect = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
    if (mysqli_connect_errno()) {
        return mysqli_connect_error();
    } else {
        $name = mysqli_real_escape_string($connect, $name);
        $query = "SELECT * FROM messages WHERE header='$name'";
        $result = mysqli_query($connect, $query);
        mysqli_close($connect);
        return (mysqli_fetch_assoc($result));
    } 
}

function changeStatusMessage($status_id)
{
    $connect = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
    if (mysqli_connect_errno()) {
        return mysqli_connect_error();
    } else {
        $status_id = mysqli_real_escape_string($connect, $status_id);
        $query = "UPDATE messages SET `status`='1' WHERE id='$status_id'";
        $result = mysqli_query($connect, $query);
        mysqli_close($connect);
        return $result;
    }
}