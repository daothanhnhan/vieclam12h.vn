<div class="gb-category-hot-vieclam">
    <div class="container">
        <?php 
                $list_menu = $menu->getListMainMenu_byOrderASC();
                $menu->showMenu_byMultiLevel_mainMenuTraiCam($list_menu,0,$lang,0);
            ?>
    </div>
</div>