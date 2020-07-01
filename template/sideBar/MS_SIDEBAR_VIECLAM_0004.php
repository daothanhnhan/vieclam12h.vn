<?php 
    $sidebar_nhanh = $action->getList('career', '', '', 'id', 'asc', '', '', '');
?>
<div class="gb-page-sanpham_ruouvang-vieclammoi-ngangnghe">
    <h3 class="widget-title-sidebar-ruouvang">VIỆC LÀM THEO NGÀNH NGHỀ</h3>
    <ul>
        <?php foreach ($sidebar_nhanh as $item) { ?>
        <li><a href="/index.php?page=tim-kiem&title=&career=<?= $item['id'] ?>"><?= $item['name'] ?></a></li>
        <?php } ?>
    </ul>
</div>