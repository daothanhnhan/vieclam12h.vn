<?php                                                                        
    $rows_vl = $action->getList('thong_tin_tuyen_dung','level','1','id','desc','','', '');
    $rows_uv = $action->getList('ung_vien', 'type', '1', 'id', 'desc', '', '', '');
    $count_vl = $action->getCount('thong_tin_tuyen_dung', 'level', '1');
    $count_uv = $action->getCount('ung_vien', 'type', '1');
    
    $_SESSION['sidebar'] = 'productCat';
    // $co_trinh_do = array();
    // $koco_trinh_do = array();
    // foreach ($rows['data'] as $item) {
    //     if ($item['level'] == 1) {
    //         $koco_trinh_do[] = $item;
    //     } else {
    //         $co_trinh_do[] = $item;
    //     }
    // }

    $viec_lam_moi = $action->getList('ung_vien', 'type', '1', 'id', 'desc', '', '15', '');
?>
<div class="gb-page-sanpham_ruouvang">
    
    <div class="container">
        <h2 class="gb-page-sanpham_ruouvang-title"><img src="/images/icons/vieclam12h.jpg" width="31"> Tuyển dụng lao động phổ thông</h2>
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
            <?php 
            $d = 0;
            foreach ($rows_vl as $item) { 
                $d++;
                $info_nha = $action->getDetail('nha_tuyen_dung', 'id', $item['nha_tuyen_dung_id']);
            ?>
            <!-- <div class="col-sm-4"> -->
                <div class="gb-product_ruouvang-item">
                    <div class="gb-product_ruouvang-item-img">
                        <a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><img src="/images/<?= $info_nha['image']!='' ? $info_nha['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                    </div>
                    <div class="gb-product_ruouvang-item-text">
                        <h2><a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><?= $item['position'] ?></a></h2>
                        <p><?= $info_nha['company'] ?></p>
                        <!--PRICE-->
                        <?php //include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0002.php";?>
                        <ul class="info-address-calendar-map   kn-date-map-3">
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
            <!-- </div> -->
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
        <h2 class="gb-page-sanpham_ruouvang-title"><img src="/images/icons/vieclam12h.jpg" width="31"> Ứng viên lao động phổ thông</h2>
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
            <?php 
            $d = 0;
            foreach ($rows_uv as $item) { 
                $d++;
                $ho_so = $action->getDetail('ho_so', 'ung_vien_id', $item['id']);//echo $ho_so['salary'];
                $item['salary'] = $ho_so['salary'];
            ?>
            <!-- <div class="col-sm-4"> -->
                <div class="gb-product_ruouvang-item">
                    <div class="gb-product_ruouvang-item-img">
                        <a href="/thong-tin-ung-tuyen/<?= $item['id'] ?>"><img src="/images/<?= $item['image']!='' ? $item['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                    </div>
                    <div class="gb-product_ruouvang-item-text">
                        <h2><a href="/thong-tin-ung-tuyen/<?= $item['id'] ?>"><?= $ho_so['position'] ?></a></h2>
                        <p><?= $item['name'] ?></p>
                        
                        <ul class="info-address-calendar-map   kn-date-map-2">
                            <!-- <li>

                                <?php //include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0002.php";?>
                            </li>
                            <li>
                                <p class="ngaynophoso-sp">
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?= date('d/m/Y', strtotime($item['ngay'])) ?>
                                </p>
                            </li> -->
                            <li><div class="kinhnghiem-vieclam">Kinh nghiệm: <span><?= $experience[$ho_so['experience']] ?></span></div> </li>
                            <li>
                                <p class="diadiemnophoso-sp">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i> <?php 
                                    $diadiem = json_decode($ho_so['dia_diem']);
                                    echo $action->getDetail('location', 'id', $diadiem[0])['name']; 
                                    ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            <!-- </div> -->
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
        // if ($count_vl > $count_uv) {
        //     echo $rows_vl['paging'];
        // } else {
        //     echo $rows_uv['paging'];
        // }
        ?>
    </div>
    <!--BANNER-->
    <?php include DIR_BANNER."MS_BANNER_VIECLAM_0001.php";?>

    <!--gb-page-sanpham_ruouvang-vieclammoi-->
    <div class="gb-page-sanpham_ruouvang-vieclammoi">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="gb-page-sanpham_ruouvang-title"><img src="/images/icons/vieclam12h.jpg" width="31"> Ứng viên mới</h2>
                    <div class="gb-page-sanpham_ruouvang-vieclammoi-scroll">
                        <?php 
                        foreach ($viec_lam_moi as $item) { 
                            $ho_so = $action->getDetail('ho_so', 'ung_vien_id', $item['id']);
                        ?>
                        <div class="gb-product_ruouvang-item">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="gb-product_ruouvang-item-img">
                                        <a href="/thong-tin-ung-tuyen/<?= $item['id'] ?>"><img src="/images/<?= $item['image']!='' ? $item['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                                    </div>
                                    <div class="gb-product_ruouvang-item-text">
                                        <h2><a href="/thong-tin-ung-tuyen/<?= $item['id'] ?>"><?= $ho_so['position'] ?></a></h2>
                                        <p><?= $item['name'] ?></p>
                                        <div class="kinhnghiem-vieclam">Kinh nghiệm: <span><?= $experience[$ho_so['experience']] ?></span></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4 clear-padding">
                                            <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0002_1.php";?>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="ngaynophoso-sp">
                                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?= date('d/m/Y', strtotime($ho_so['created_at'])) ?>
                                            </p>
                                        </div>
                                        <div class="col-sm-4 clear-padding-left">
                                            <div class="gb-product_ruouvang-item-address" style="text-align: right;">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i> <?php 
                                                $diadiem = json_decode($ho_so['dia_diem']);
                                                echo $action->getDetail('location', 'id', $diadiem[0])['name'] 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <?php include DIR_SIDEBAR."MS_SIDEBAR_VIECLAM_0004.php";?>
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
            navSpeed:500,
            nav:true,
            dots: true,
            autoplay: false,
            rewind: true,
            navText:[],
            responsive:{
                0:{
                    items:1,
                    nav: false
                },
                992:{
                    items: 3,
                    nav:true
                }
            }
        });
    });
</script>