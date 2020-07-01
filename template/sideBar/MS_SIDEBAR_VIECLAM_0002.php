<?php 
    $siderbar_viecnhanh = $action->getList('thong_tin_tuyen_dung', '', '', 'id', 'desc', '', '10', '');
?>
<div class="gb-tuydungnhanh-sidebar-ruouvang widget-sidebar">
    <aside class="widget">
        <h3 class="widget-title-sidebar-ruouvang">TUYỂN DỤNG NHANH</h3>
        <div class="widget-content">
            <?php 
            foreach ($siderbar_viecnhanh as $item) { 
                $info_nha = $action->getDetail('nha_tuyen_dung', 'id', $item['nha_tuyen_dung_id']);
            ?>
            <div class="gb-product_ruouvang-item">
                <div class="gb-product_ruouvang-item-img">
                    <a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><img src="/images/<?= $info_nha['image']!='' ? $info_nha['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                </div>
                <div class="gb-product_ruouvang-item-text">
                    <h2><a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><?= $item['position'] ?></a></h2>
                    <p><?= $info_nha['company'] ?></p>
                    <!--PRICE-->
                    <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0002.php";?>
                </div>
            </div>
            <?php } ?>
        </div>
    </aside>
</div>