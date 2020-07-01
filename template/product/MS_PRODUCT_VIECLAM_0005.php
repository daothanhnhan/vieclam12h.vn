<?php 
    $ungvien_cungnganh = $action_ungvien->cung_nganh($ung_vien['type'], $dang[0], 12);//var_dump($ungvien_cungnganh);
?>
<div class="gb-home-product-relate">
    <div class="gb-home-product-relate-title">
        <h4>Ứng viên cùng nhóm ngành</h4>
    </div>
    <div class="row">
        <?php 
        foreach ($ungvien_cungnganh as $item) { 
            $ho_so = $action->getDetail('ho_so', 'ung_vien_id', $item['id']);
        ?>
        <div class="col-md-6">
            <div class="gb-product_ruouvang-item">
                <div class="gb-product_ruouvang-item-img">
                    <a href="/thong-tin-ung-tuyen/<?= $item['id'] ?>"><img src="/images/<?= $item['image']!='' ? $item['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                </div>
                <div class="gb-product_ruouvang-item-text">
                    <h2><a href="/thong-tin-ung-tuyen/<?= $item['id'] ?>"><?= $ho_so['position'] ?></a></h2>
                    <p><?= $item['name'] ?></p>
                    <!--PRICE-->
                    <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0002_1.php";?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
