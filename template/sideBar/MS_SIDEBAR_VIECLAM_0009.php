<?php 
    $siderbar_viecnhanh = $action->getList('ung_vien', '', '', 'id', 'desc', '', '10', '');
?>
<div class="gb-tuydungnhanh-sidebar-ruouvang widget-sidebar">
    <aside class="widget">
        <h3 class="widget-title-sidebar-ruouvang">ỨNG VIÊN NHANH</h3>
        <div class="widget-content">
            <?php 
            foreach ($siderbar_viecnhanh as $item) { 
                $info_hoso = $action->getDetail('ho_so', 'ung_vien_id', $item['id']);
                $ho_so['salary'] = $info_hoso['salary'];
            ?>
            <div class="gb-product_ruouvang-item">
                <div class="gb-product_ruouvang-item-img">
                    <a href="/thong-tin-ung-tuyen/<?= $item['id'] ?>"><img src="/images/<?= $item['image']!='' ? $item['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                </div>
                <div class="gb-product_ruouvang-item-text">
                    <h2><a href="/thong-tin-ung-tuyen/<?= $item['id'] ?>"><?= $info_hoso['position'] ?></a></h2>
                    <p><?= $item['name'] ?></p>
                    <!--PRICE-->
                    <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0002_1.php";?>
                </div>
            </div>
            <?php } ?>
        </div>
    </aside>
</div>