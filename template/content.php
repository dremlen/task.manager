 <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="left-collum-index">
                <?php $lengthTitle = determineTitle($itemsMenu); ?>
                <h1><?= determineTitle($itemsMenu); ?></h1>
                <p>Вести свои личные списки, например покупки в магазине, цели, задачи и многое другое. Делится списками с друзьями и просматривать списки друзей.</p>

            </td>
            <?php
            include($_SERVER['DOCUMENT_ROOT'] . '/template/authorization.php');
            ?>
        </tr>
    </table>
