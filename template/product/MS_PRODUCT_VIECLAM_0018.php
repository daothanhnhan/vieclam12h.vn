<?php                                                                        
    // $rows = $action->getList_dontuyen('thong_tin_tuyen_dung','level','1','id','desc',$trang,21, $_GET['page']);
    
    // $_SESSION['sidebar'] = 'productCat';
    // $co_trinh_do = array();
    // $koco_trinh_do = array();
    // foreach ($rows['data'] as $item) {
    //     if ($item['level'] == 1) {
    //         $koco_trinh_do[] = $item;
    //     } else {
    //         $co_trinh_do[] = $item;
    //     }
    // }
    /////////////////
    if ($_GET['level'] == 0) {
        $koco_trinh_do = $action->getList_dontuyen('thong_tin_tuyen_dung','level','1','id','desc','','72','');
        $co_trinh_do = $action->getList_dontuyen_diff('thong_tin_tuyen_dung','level','1','id','desc','','72', '');
    } else {
        if ($_GET['level'] == 6 || $_GET['level']==7 || $_GET['level']==8 || $_GET['level']==9) {
            $koco_trinh_do = $action->getList_dontuyen('thong_tin_tuyen_dung','level','1','id','desc','','72','');
            $co_trinh_do = array();
        } else {
            $koco_trinh_do = array();
            $co_trinh_do = $action->getList_dontuyen_diff('thong_tin_tuyen_dung','level',$_GET['level'],'id','desc','','72', '');
        }
    }
    

    $viec_lam_moi = $action->getList('thong_tin_tuyen_dung', '', '', 'id', 'desc', '', '15', '');
?>
<?php include DIR_SEARCH."MS_SEARCH_VIECLAM_0005.php";?>
<div class="gb-page-sanpham_ruouvang">
    <div class="container">
        
        <h2 class="gb-page-sanpham_ruouvang-title">Việc làm có trình độ</h2>
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
            <?php 
            $d = 0;
            foreach ($co_trinh_do as $item) { 
                // var_dump($item);
                $d++;
                $info_nha = $action->getDetail('nha_tuyen_dung', 'id', $item['nha_tuyen_dung_id']);
            ?>
            <!-- <div class="col-sm-4"> -->
                <div class="gb-product_ruouvang-item">
                    <div class="gb-product_ruouvang-item-img">
                        <a href="/thong-tin-tuyen-dung/<?= $item[0] ?>"><img src="/images/<?= $info_nha['image']!='' ? $info_nha['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                    </div>
                    <div class="gb-product_ruouvang-item-text">
                        <h2><a href="/thong-tin-tuyen-dung/<?= $item[0] ?>"><?= $item['position'] ?></a></h2>
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
        <h2 class="gb-page-sanpham_ruouvang-title">Việc làm lao động phổ thông</h2>
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
            <?php 
            $d = 0;
            foreach ($koco_trinh_do as $item) { 
                $d++;
                $info_nha = $action->getDetail('nha_tuyen_dung', 'id', $item['nha_tuyen_dung_id']);
            ?>
            <!-- <div class="col-sm-4"> -->
                <div class="gb-product_ruouvang-item">
                    <div class="gb-product_ruouvang-item-img">
                        <a href="/thong-tin-tuyen-dung/<?= $item[0] ?>"><img src="/images/<?= $info_nha['image']!='' ? $info_nha['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                    </div>
                    <div class="gb-product_ruouvang-item-text">
                        <h2><a href="/thong-tin-tuyen-dung/<?= $item[0] ?>"><?= $item['position'] ?></a></h2>
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
        // echo $co_trinh_do['count'];
        // if ($co_trinh_do['count'] > $koco_trinh_do['count']) {
        //     echo $co_trinh_do['paging'];
        // } else {
        //     echo $koco_trinh_do['paging'];
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
                    <h2 class="gb-page-sanpham_ruouvang-title">Việc làm mới</h2>
                    <?php 
                    foreach ($viec_lam_moi as $item) { 
                        $info_nha = $action->getDetail('nha_tuyen_dung', 'id', $item['nha_tuyen_dung_id']);
                    ?>
                    <div class="gb-product_ruouvang-item">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="gb-product_ruouvang-item-img">
                                    <a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><img src="/images/<?= $info_nha['image']!='' ? $info_nha['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                                </div>
                                <div class="gb-product_ruouvang-item-text">
                                    <h2><a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><?= $item['position'] ?></a></h2>
                                    <p><?= $info_nha['company'] ?></p>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="row">
                                    <div class="col-sm-7 clear-padding">
                                        <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0002.php";?>
                                    </div>
                                    <div class="col-sm-5 clear-padding-left">
                                        <div class="gb-product_ruouvang-item-address">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i> <?php 
                                            $diadiem = json_decode($item['location']);
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
                <div class="col-sm-4 hidden-xs hidden-sm">
                    <?php include DIR_SIDEBAR."MS_SIDEBAR_VIECLAM_0004.php";?>
                </div>
            </div>
        </div>
    </div>
</div>
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