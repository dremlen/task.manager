<?php
echo (isset($_SESSION['isAuth'])) ? '<a href="/template/buttonExit.php">Выйти</a>' : '<a href="/index.php?login=yes">Авторизация</a>';
