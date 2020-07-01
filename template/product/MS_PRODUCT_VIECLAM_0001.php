<?php 
    $now = date('Y-m-d H:i:s');//echo $now;
    $arr_home_viec_tuyen1 = array(
        array('level', 'in', '(1,2,3,4,5)', 0),
        array('home', '=', 1, 0),
        array('home_time', '>=', "$now", 1)
    );
    $arr_home_viec_tuyen2 = array(
        array('level', 'in', '(6,7,8,9)', 0),
        array('home', '=', 1, 0),
        array('home_time', '>=', "$now", 1)
    );
    // $home_viec_tuyendung_1 = $action->getList_diff('thong_tin_tuyen_dung', 'level', '1', 'id', 'desc', '', '30', '');
    $home_viec_tuyendung_1 = $action->getList_arr('thong_tin_tuyen_dung', $arr_home_viec_tuyen1, 'time', 'desc', '', '180', '');
    // $home_viec_tuyendung_1 = $action->getList_home_1('thong_tin_tuyen_dung', '', '', 'thong_tin_tuyen_dung.time', 'desc', '', '72', '');
    $count_viec_tuyendung_1 = count($home_viec_tuyendung_1);
    // $home_viec_tuyendung_2 = $action->getList('thong_tin_tuyen_dung', 'level', '1', 'id', 'desc', '', '30', '');
    $home_viec_tuyendung_2 = $action->getList_arr('thong_tin_tuyen_dung', $arr_home_viec_tuyen2, 'time', 'desc', '', '180', '');
    // $home_viec_tuyendung_2 = $action->getList_home_2('thong_tin_tuyen_dung', '', '', 'thong_tin_tuyen_dung.time', 'desc', '', '72', '');
    $count_viec_tuyendung_2 = count($home_viec_tuyendung_2);
?>
<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<style>
@media screen and (max-width: 991px) {
    .gb-tieubieu-product_ruouvang .gb-tieubieu-product_ruouvang-title {
        margin-bottom: 0;
    }
}
.icon-chiec-cap:before {
    content: "\e83a";
}
</style>
<div class="gb-tieubieu-product_ruouvang">
    <div class="container">
        <div class="gb-tieubieu-product_ruouvang-title row">
            <div class="col-md-5">
                <h3><i class="fa icon-chiec-cap" aria-hidden="true" style="color:#000;font-size: 20px;"></i> VIỆC LÀM CHUYÊN MÔN - QUẢN LÝ</h3>
            </div>
            <div class="col-md-7">
                <p>
                    <marquee><b style="color: red;">Tìm việc làm hiệu quả</b></marquee>
                </p>
            </div>
            
            
        </div>
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
                    <?php
                    $d = 0; 
                    foreach ($home_viec_tuyendung_1 as $item) { 
                        $d++;
                        $info_nha = $action->getDetail('nha_tuyen_dung', 'id', $item['nha_tuyen_dung_id']);
                    ?>
                    <div class="gb-product_ruouvang-item">
                        <div class="gb-product_ruouvang-item-img">
                            <a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><img src="/images/<?= $info_nha['image']!='' ? $info_nha['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                        </div>
                        <div class="gb-product_ruouvang-item-text">
                            <h2><a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><?= $item['position'] ?> <?= $item['hot']==1 ? '<span class="hot">Hot</span>' : '' ?></a></h2>
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
                    <?php 
                    if ($d%6==0) {
                        if ($d != $count_viec_tuyendung_1) {
                            echo '</div><div class="item">';
                        }
                    }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="gb-tieubieu-product_ruouvang-title row">
            <div class="col-md-3">
                <h3><i class="fa icon-chiec-cap" aria-hidden="true" style="color:#000;font-size: 20px;"></i> VIỆC LÀM PHỔ THÔNG</h3>
            </div>
            <div class="col-md-9">
                <p>
                    <marquee><b style="color: red;">Tìm việc làm hiểu quả</b></marquee>
                </p>
            </div>

        </div>
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
                    <?php
                    $d = 0; 
                    foreach ($home_viec_tuyendung_2 as $item) { 
                        $d++;
                        $info_nha = $action->getDetail('nha_tuyen_dung', 'id', $item['nha_tuyen_dung_id']);
                    ?>
                    <div class="gb-product_ruouvang-item">
                        <div class="gb-product_ruouvang-item-img">
                            <a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><img src="/images/<?= $info_nha['image']!='' ? $info_nha['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                        </div>
                        <div class="gb-product_ruouvang-item-text">
                            <h2><a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><?= $item['position'] ?> <?= $item['hot']==1 ? '<span class="hot">Hot</span>' : '' ?></a></h2>
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
                    <?php 
                    if ($d%6==0) {
                        if ($d != $count_viec_tuyendung_2) {
                            echo '</div><div class="item">';
                        }
                    }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function (){
        $('.gb-tieubieu-product_ruouvang-slide').owlCarousel({
            loop:true,
            margin:10,
            // navSpeed:500,
            autoplayTimeout:30000,
            nav:true,
            dots: true,
            autoplay: true,
            rewind: true,
            navText:[],
            responsive:{
                0:{
                    items:1,
                    nav: true
                },
                992:{
                    items: 3,
                    slideBy: 2,
                    nav:true
                }
            }
        });
    });
</script>