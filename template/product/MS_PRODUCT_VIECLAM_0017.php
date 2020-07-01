<?php 
    // $rows = $action->getList_hoso('ho_so','','','ho_so.id','desc',$trang,21, $_GET['page']);

    // $co_trinh_do = array();
    // $koco_trinh_do = array();
    // foreach ($rows['data'] as $item) {
    //     // var_dump($item);die;
    //     $info_uv = $action->getDetail('ung_vien', 'id', $item['ung_vien_id']);
    //     if ($info_uv['type'] == 1) {
    //         $koco_trinh_do[] = $item;
    //     } else {
    //         $co_trinh_do[] = $item;
    //     }
    // }
    /////////////
    // if ($_GET['level']==0) {
    //     $co_trinh_do = $action->getList_hoso('ho_so','type','0','ho_so.id','desc','','72', '');
    //     $koco_trinh_do =$action->getList_hoso('ho_so','type','1','ho_so.id','desc','','72', '');
    // } else {
    //     if ($_GET['level'] == 1) {
    //         $co_trinh_do = array();
    //         $koco_trinh_do = $action->getList_hoso('ho_so','','','ho_so.id','desc','','72', '');
    //     } else {
    //         $co_trinh_do = $action->getList_hoso('ho_so','','','ho_so.id','desc','','72', '');
    //         $koco_trinh_do = array();
    //     }
    // }
    /////////////////////////
    $koco_trinh_do = $action->getList_hoso('ho_so','type','1','ho_so.id','desc','','72', '');
    $koco_trinh_do_1 = $action->getList_hoso_1('ho_so','type','1','ho_so.id','desc','','72', '');
    $koco_trinh_do_2 = $action->getList_hoso_2('ho_so','type','1','ho_so.id','desc','','72', '');
    $koco_trinh_do_3 = $action->getList_hoso_3('ho_so','type','1','ho_so.id','desc','','72', '');
    $co_trinh_do = array();
    $viec_lam_moi = $action->getList('ung_vien', 'type', '0', 'id', 'desc', '', '15', '');//var_dump($koco_trinh_do);var_dump($co_trinh_do);
?>
<?php include DIR_SEARCH."MS_SEARCH_VIECLAM_0004_2.php";?>
<div class="gb-page-sanpham_ruouvang">
    <div class="container">
        
        <h2 class="gb-page-sanpham_ruouvang-title"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Ứng viên ngành kinh tế</h2>
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
            <?php 
            $d = 0;
            foreach ($koco_trinh_do_1 as $item) { 
                $d++;
                $ung_vien = $action->getDetail('ung_vien', 'id', $item['ung_vien_id']);
            ?>
            <!-- <div class="col-sm-4"> -->
                <div class="gb-product_ruouvang-item">
                    <div class="gb-product_ruouvang-item-img">
                        <a href="/thong-tin-ung-tuyen/<?= $ung_vien['id'] ?>"><img src="/images/<?= $ung_vien['image']!='' ? $ung_vien['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                    </div>
                    <div class="gb-product_ruouvang-item-text">
                        <h2><a href="/thong-tin-ung-tuyen/<?= $ung_vien['id'] ?>"><?= $item['position'] ?></a></h2>
                        <p><?= $ung_vien['name'] ?></p>
                        <div class="kinhnghiem-vieclam">Kinh nghiệp: <span><?= $action->getDetail('kinh_nghiem', 'id', $item['experience'])['name'] ?></span></div>
                        <ul class="info-address-calendar-map">
                            <li>
                                
                            </li>
                            <li>
                                <p class="ngaynophoso-sp">
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?= date('d/m/Y', strtotime($item['created_at'])) ?>
                                </p>
                            </li>
                            <li>
                                <p class="diadiemnophoso-sp">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i> <?php 
                                    $diadiem = json_decode($item['dia_diem']);
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
    <!--BANNER-->
    <?php include DIR_BANNER."MS_BANNER_VIECLAM_0001.php";?>
    <div class="container">
        <h2 class="gb-page-sanpham_ruouvang-title"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Ứng viên ngành kỹ thuật</h2>
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
            <?php 
            $d = 0;
            foreach ($koco_trinh_do_2 as $item) { 
                $d++;
                $ung_vien = $action->getDetail('ung_vien', 'id', $item['ung_vien_id']);
            ?>
            <!-- <div class="col-sm-4"> -->
                <div class="gb-product_ruouvang-item">
                    <div class="gb-product_ruouvang-item-img">
                        <a href="/thong-tin-ung-tuyen/<?= $ung_vien['id'] ?>"><img src="/images/<?= $ung_vien['image']!='' ? $ung_vien['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                    </div>
                    <div class="gb-product_ruouvang-item-text">
                        <h2><a href="/thong-tin-ung-tuyen/<?= $ung_vien['id'] ?>"><?= $item['position'] ?></a></h2>
                        <p><?= $ung_vien['name'] ?></p>
                        <div class="kinhnghiem-vieclam">Kinh nghiệp: <span><?= $action->getDetail('kinh_nghiem', 'id', $item['experience'])['name'] ?></span></div>
                        <ul class="info-address-calendar-map">
                            <li>
                                
                            </li>
                            <li>
                                <p class="ngaynophoso-sp">
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?= date('d/m/Y', strtotime($item['created_at'])) ?>
                                </p>
                            </li>
                            <li>
                                <p class="diadiemnophoso-sp">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i> <?php 
                                    $diadiem = json_decode($item['dia_diem']);
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
        <h2 class="gb-page-sanpham_ruouvang-title"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Ứng viên ngành dịch vụ</h2>
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
            <?php 
            $d = 0;
            foreach ($koco_trinh_do_3 as $item) { 
                $d++;
                $ung_vien = $action->getDetail('ung_vien', 'id', $item['ung_vien_id']);
            ?>
            <!-- <div class="col-sm-4"> -->
                <div class="gb-product_ruouvang-item">
                    <div class="gb-product_ruouvang-item-img">
                        <a href="/thong-tin-ung-tuyen/<?= $ung_vien['id'] ?>"><img src="/images/<?= $ung_vien['image']!='' ? $ung_vien['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                    </div>
                    <div class="gb-product_ruouvang-item-text">
                        <h2><a href="/thong-tin-ung-tuyen/<?= $ung_vien['id'] ?>"><?= $item['position'] ?></a></h2>
                        <p><?= $ung_vien['name'] ?></p>
                        <div class="kinhnghiem-vieclam">Kinh nghiệp: <span><?= $action->getDetail('kinh_nghiem', 'id', $item['experience'])['name'] ?></span></div>
                        <ul class="info-address-calendar-map">
                            <li>
                                
                            </li>
                            <li>
                                <p class="ngaynophoso-sp">
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?= date('d/m/Y', strtotime($item['created_at'])) ?>
                                </p>
                            </li>
                            <li>
                                <p class="diadiemnophoso-sp">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i> <?php 
                                    $diadiem = json_decode($item['dia_diem']);
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
        <?= $rows['paging'] ?>
    </div>
    <!--gb-page-sanpham_ruouvang-vieclammoi-->
    <div class="gb-page-sanpham_ruouvang-vieclammoi">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="gb-page-sanpham_ruouvang-title">Ứng viên mới</h2>
                    <?php 
                    foreach ($viec_lam_moi as $item) { 
                        $ho_so = $action->getDetail('ho_so', 'ung_vien_id', $item['id']);
                    ?>
                    <div class="gb-product_ruouvang-item">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="gb-product_ruouvang-item-img">
                                    <a href="/thong-tin-ung-tuyen/<?= $item['id'] ?>"><img src="/images/<?= $item['image']!='' ? $item['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                                </div>
                                <div class="gb-product_ruouvang-item-text">
                                    <h2><a href="/thong-tin-ung-tuyen/<?= $item['id'] ?>"><?= $ho_so['position'] ?></a></h2>
                                    <p><?= $item['name'] ?></p>
                                    <div class="kinhnghiem-vieclam">Kinh nghiệp: <span><?= $action->getDetail('kinh_nghiem', 'id', $ho_so['experience'])['name'] ?></span></div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="row">
                                    <div class="col-sm-7 clear-padding">
                                        <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0002_1.php";?>
                                    </div>
                                    <div class="col-sm-5 clear-padding-left">
                                        <div class="gb-product_ruouvang-item-address">
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
            navSpeed:30000,
            autoplayTimeout:30000,
            nav:true,
            dots: true,
            autoplay: true,
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