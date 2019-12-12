<ul class="<?= $ulClass; ?>">
    <?php
    foreach ($array as $id => $item) :
        ?>
    <li><a class="<?= $font;?> <?= isCurrentUrl($array[$id]['path'])?' active':'' ?>" href="<?= $array[$id]['path']; ?>"><?= getTrimmetString($array[$id]['title']); ?>
            </a>
        </li>
    <?php endforeach ?>
</ul>
