<?php 
    $arr_home1_viec_tuyen1 = array(
        array('level', '!=', 1),
        array('home', '=', 1)
    );
    $arr_home1_viec_tuyen2 = array(
        array('level', '=', 1),
        array('home', '=', 1)
    );
    $home_cotrinhdo = $action->getList_diff('thong_tin_tuyen_dung', 'level', 1, 'time', 'desc', '', '30', '');
    $home_phothong = $action->getList('thong_tin_tuyen_dung', 'level', 1, 'time', 'desc', '', '30', '');
?>
<div class="gb-danhmuc-sanpham-cotrinhdo-phpthong  hidden-sm hidden-xs" style="padding-left: 0%;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="gb-tieubieu-product_ruouvang-title">
                    <h3>CẬP NHẬT VIỆC LÀM CÓ BẰNG CẤP</h3>
                </div>
                <div class="gb-danhmuc-sanpham-cotrinhdo-phpthong-item">
                    <?php 
                    foreach ($home_cotrinhdo as $item) { 
                        $info_nha = $action->getDetail('nha_tuyen_dung', 'id', $item['nha_tuyen_dung_id']);
                    ?>
                    <div class="gb-product_ruouvang-item">
                        <div class="gb-product_ruouvang-item-img">
                            <a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><img src="/images/<?= $info_nha['image']!='' ? $info_nha['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                        </div>
                        <div class="gb-product_ruouvang-item-text">
                            <h2><a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><?= $item['position'] ?></a></h2>
                            <p><?= $info_nha['company'] ?></p>
                            <ul class="info-address-calendar-map">
                                <li>
                                    <!--PRICE-->
                                    <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0002.php";?>
                                </li>
                                <li>
                                    <p class="ngaynophoso-sp">
                                        <i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?= date('d/m/Y', strtotime($item['ngay'])) ?>
                                    </p>
                                </li>
                                <li>
                                    <p class="diadiemnophoso-sp">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i> <?php 
                                        $diadiem = json_decode($item['location']);
                                        echo $action->getDetail('location', 'id', $diadiem[0])['name']; 
                                        ?>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="gb-tieubieu-product_ruouvang-title">
                    <h3>CẬP NHẬT VIỆC LÀM PHỔ THÔNG</h3>
                </div>
                <div class="gb-danhmuc-sanpham-cotrinhdo-phpthong-item">
                    <?php 
                    foreach ($home_phothong as $item) { 
                        $info_nha = $action->getDetail('nha_tuyen_dung', 'id', $item['nha_tuyen_dung_id']);
                    ?>
                    <div class="gb-product_ruouvang-item">
                        <div class="gb-product_ruouvang-item-img">
                            <a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><img src="/images/<?= $info_nha['image']!='' ? $info_nha['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                        </div>
                        <div class="gb-product_ruouvang-item-text">
                            <h2><a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><?= $item['position'] ?></a></h2>
                            <p><?= $info_nha['company'] ?></p>
                            <ul class="info-address-calendar-map">
                                <li>
                                    <!--PRICE-->
                                    <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0002.php";?>
                                </li>
                                <li>
                                    <p class="ngaynophoso-sp">
                                        <i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?= date('d/m/Y', strtotime($item['ngay'])) ?>
                                    </p>
                                </li>
                                <li>
                                    <p class="diadiemnophoso-sp">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i> <?php 
                                        $diadiem = json_decode($item['location']);
                                        echo $action->getDetail('location', 'id', $diadiem[0])['name']; 
                                        ?>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>