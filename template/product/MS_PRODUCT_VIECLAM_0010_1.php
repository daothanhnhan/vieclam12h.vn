<?php 
    // $rows = $action->getList('ung_vien', '', '', 'id', 'desc', $trang, 24, $_GET['page'], $_GET['page']);//var_dump($ung_vien);

    // $co_trinh_do = array();
    // $koco_trinh_do = array();
    // foreach ($rows['data'] as $item) {
    //     // var_dump($item);die;
    //     if ($item['type'] == 1) {
    //         $koco_trinh_do[] = $item;
    //     } else {
    //         $co_trinh_do[] = $item;
    //     }
    // }
    $koco_trinh_do = $action->getList('ung_vien', 'type', '1', 'id', 'desc', '', '', '');
    $co_trinh_do = $action->getList('ung_vien', 'type', '0', 'id', 'desc', '', '', '');
    $count_trinhdo = $action->getCount('ung_vien', 'type', '0');//var_dump($count_trinhdo);
    $count_phothong = $action->getCount('ung_vien', 'type', '1');//var_dump($count_trinhdo);

    $viec_lam_moi = $action->getList('ung_vien', 'type', '0', 'id', 'desc', '', '15', '');//var_dump($koco_trinh_do);var_dump($co_trinh_do);
?>
<div class="gb-page-sanpham_ruouvang">
    <div class="container">
        <h2 class="gb-page-sanpham_ruouvang-title"><img src="/images/icons/vieclam12h.jpg" width="31"> Lao động có bằng cấp</h2>
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
            <?php 
            $d = 0;
            foreach ($co_trinh_do as $item) { 
                $d++;
                $ho_so = $action->getDetail('ho_so', 'ung_vien_id', $item['id']);
            ?>
            <!-- <div class="col-sm-4"> -->
                <div class="gb-product_ruouvang-item">
                    <div class="gb-product_ruouvang-item-img">
                        <a href="/thong-tin-ung-tuyen/<?= $item['id'] ?>"><img src="/images/<?= $item['image']!='' ? $item['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                    </div>
                    <div class="gb-product_ruouvang-item-text">
                        <h2><a href="/thong-tin-ung-tuyen/<?= $item['id'] ?>"><?= $ho_so['position'] ?></a></h2>
                        <p><?= $item['name'] ?></p>
                        <ul class="info-address-calendar-map kn-date-map">
                            <li>
                                <div class="kinhnghiem-vieclam">Kinh nghiệm: <span><?= $experience[$ho_so['experience']] ?></span></div>
                            </li>
                            <!-- <li>
                                <p class="ngaynophoso-sp">
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?= date('d/m/Y', strtotime($ho_so['created_at'])) ?>
                                </p>
                            </li> -->
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
    <!--BANNER-->
    <?php include DIR_BANNER."MS_BANNER_VIECLAM_0001.php";?>
    <div class="container">
        <h2 class="gb-page-sanpham_ruouvang-title"><img src="/images/icons/vieclam12h.jpg" width="31"> Lao động phổ thông</h2>
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
            <?php 
            $d = 0;
            foreach ($koco_trinh_do as $item) { 
                $d++;
                $ho_so = $action->getDetail('ho_so', 'ung_vien_id', $item['id']);
            ?>
            <!-- <div class="col-sm-4"> -->
                <div class="gb-product_ruouvang-item">
                    <div class="gb-product_ruouvang-item-img">
                        <a href="/thong-tin-ung-tuyen/<?= $item['id'] ?>"><img src="/images/<?= $item['image']!='' ? $item['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                    </div>
                    <div class="gb-product_ruouvang-item-text">
                        <h2><a href="/thong-tin-ung-tuyen/<?= $item['id'] ?>"><?= $ho_so['position'] ?></a></h2>
                        <p><?= $item['name'] ?></p>
                        <ul class="info-address-calendar-map kn-date-map">
                            <li>
                                <div class="kinhnghiem-vieclam">Kinh nghiệm: <span><?= $experience[$ho_so['experience']] ?></span></div>
                            </li>
                            <!-- <li>
                                <p class="ngaynophoso-sp">
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?= date('d/m/Y', strtotime($ho_so['created_at'])) ?>
                                </p>
                            </li> -->
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
        // if ($count_trinhdo > $count_phothong) {
        //     echo $co_trinh_do['paging'];
        // } else {
        //     echo $koco_trinh_do['paging'];
        // }
        ?>
    </div>
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