<nav>
    <a href="./">Accueil</a> |
    <?php
    foreach(PAGE_MENU as $item):
    ?>
    <a href="?p=<?=$item?>"><?=$item?></a> |
    <?php
    endforeach;
    ?>
</nav>
