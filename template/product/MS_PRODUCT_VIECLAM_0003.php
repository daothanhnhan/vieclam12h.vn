<?php
    $now = date('Y-m-d H:i:s');//echo $now                                                                        
    $arr_viec_tuyen1 = array(
        array('level', 'in', '(1,2,3,4,5)', 0),
        array('trang_tuyen', '=', 1, 0),
        array('home_time', '>=', "$now", 1)
    );
    $arr_viec_tuyen2 = array(
        array('level', 'in', '(6,7,8,9)', 0),
        array('trang_tuyen', '=', 1, 0),
        array('home_time', '>=', "$now", 1)
    );
    $koco_trinh_do = $action->getList_arr('thong_tin_tuyen_dung',$arr_viec_tuyen2,'time','desc','','180', '');
    // $co_trinh_do = $action->getList_tuyen_1('thong_tin_tuyen_dung', '', '', 'thong_tin_tuyen_dung.time', 'desc', '', '180', '');
    $co_trinh_do = $action->getList_arr('thong_tin_tuyen_dung',$arr_viec_tuyen1,'time','desc','','180', '');
    // $koco_trinh_do = $action->getList_tuyen_2('thong_tin_tuyen_dung', '', '', 'thong_tin_tuyen_dung.time', 'desc', '', '180', '');
    $count_trinhdo = $action->getCount_diff('thong_tin_tuyen_dung', 'level', '1');
    $count_phothong = $action->getCount('thong_tin_tuyen_dung', 'level', '1');
    $viec_lam_moi = $action->getList('thong_tin_tuyen_dung', '', '', 'id', 'desc', '', '15', '');
?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<style>
@media screen and (max-width: 991px) {
    .gb-page-sanpham_ruouvang-title {
        margin-bottom: 0;
        padding: 0;
    }
    .text-tuyen-marquee {
        padding: 0 !important;
    }
}
.icon-chiec-cap:before {
    content: "\e83a";
}
</style>
<div class="gb-page-sanpham_ruouvang">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h2 class="gb-page-sanpham_ruouvang-title"><i class="fa icon-chiec-cap" aria-hidden="true" style="color:#000;font-size: 20px;"></i> VIỆC LÀM CHUYÊN MÔN - QUẢN LÝ</h2>
            </div>
            <div class="col-md-7">
                <p style="padding: 15px;" class="text-tuyen-marquee">
                    <marquee><b style="color: red;">Tìm việc làm hiêu quả</b></marquee>
                </p>
            </div>
        </div>
        
        
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
                    <?php
                    $d = 0; 
                    foreach ($co_trinh_do as $item) { 
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
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="gb-page-sanpham_ruouvang-title"><i class="fa icon-chiec-cap" aria-hidden="true" style="color:#000;font-size: 20px;"></i> VIỆC LÀM PHỔ THÔNG</h2>
            </div>
            <div class="col-md-9">
                <p style="padding: 15px;" class="text-tuyen-marquee">
                    <marquee><b style="color: red;">Tìm việc làm hiệu quả</b></marquee>
                </p>
            </div>
        </div>
        
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
                    <?php
                    $d = 0; 
                    foreach ($koco_trinh_do as $item) { 
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
        <?php 
        ?>
    </div>
    <!--BANNER-->
    <?php include DIR_BANNER."MS_BANNER_VIECLAM_0001.php";?>

    <!-- cập nhật việc làm -->
    <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0008.php";?>

    <?php include DIR_SEARCH."MS_SEARCH_VIECLAM_0007.php";?>
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