<ul>
    <?php
    foreach ($messages as $message) :
        if ($message['status'] == NULL) : ?>
            <li><a href="/posts/reading_message.php?id=<?= $message['Заголовок'] ?>"><?= $message['Заголовок'] . ', ' . $message['Название'] ?></a></li>
        <?php endif ?>
    <?php endforeach ?>
</ul>