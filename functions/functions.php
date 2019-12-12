<?php

/** функция сортирует и добавляет классы в список ссылок
 * @param принимает массив меню
 * @param принимает вид сортировки по возрастанию ('asc') и по убыванию ('desc')
 * @param принимает класс ссылки по размеру шрифта
 * @param принимает класс списка
 * @return возвращает подключение списков меню из массива
 */
function showMenu($array, $sortBy, $font, $ulClass = 'main-menu')
{
        uasort($array, $sortBy == 'asc'? 'functionSortAsc': 'functionSortDesc');
        return include($_SERVER['DOCUMENT_ROOT'] . '/template/menu.php');
}
function functionSortAsc($a, $b)
{
    return ($a['sort'] > $b['sort']);
}

function functionSortDesc($a, $b)
{
    return ($a['sort'] < $b['sort']);
}



/** Функция проверяет длину строки и если длинна больше заданной то обрезает
 * @param Строка для проверки
 * @return возвращает строку после проверки
 */
function getTrimmetString($string, $length = 12)
{
    if (mb_strlen($string) >= $length) {
        return mb_substr($string, 0, $length) . '... ';
    } else {
        return $string;
    }
}

/** функция ищет на какой ссылке находиться
 * @param Передает массив 
 * @return возвращает название страницы
 */
function determineTitle($array)
{
    foreach ($array as $id => $item) {
        if (isCurrentUrl($array[$id]['path'])) {
            return $array[$id]['title'];
        }
    }
    return 'Возможности проекта';
}

function isCurrentUrl($url)
{
    return $url == parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}



/** делает авторизацию
 * @return файл с сообщением
 */
function makeAuthorization()
{
    if (isset($_POST['send'])) {
        if (isset($_COOKIE['login'])) {
            $_POST['login'] = $_COOKIE['login'];
            $login = $_POST['login'];
            $password = $_POST['password'];
            if (userAuthorization($login, $password)) {
                if (!isset($_SESSION['isAuth'])) {
                    $_SESSION['isAuth'] = $login;
                }
                return (include($_SERVER['DOCUMENT_ROOT'] . '/template/success.php'));
            } else {
                return (include($_SERVER['DOCUMENT_ROOT'] . '/template/error.php'));
            }
        }
    }
}

/** создает куки
 */
function makeCookie()
{
    if (isset($_POST['login'])) {
        if (!isset($_COOKIE['login'])) {
            setcookie('login', $_POST['login'], time() + 3600 * 24 * 30, '/');
        }
    }
}


