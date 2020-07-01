
<!--CONTENT-->
<div class="Content-Main">
    <?php include DIR_SEARCH."MS_SEARCH_VIECLAM_0005.php";?>
    
    <?php //include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0006.php";?>
    <?php //include DIR_REGISTER."MS_REGISTER_VIECLAM_0001.php";?>
    <!--SLIDESHOW-->
    <?php include DIR_SLIDESHOW."MS_SLIDESHOW_VIECLAM_0001.php";?>

    <?php include DIR_CONTACT."MS_CONTACT_VIECLAM_0006.php"; ?>
    

    <!--SẢN PHẨM TIÊU BIỂU 0007-->
    <?php //include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0012.php";?>

    <!--SẢN PHẨM TIÊU BIỂU-->
    <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0001.php";?>

    <!--BANNER-->
    <?php include DIR_BANNER."MS_BANNER_VIECLAM_0001.php";?>



<?php                                                                        
    $arr_viec_tuyen1 = array(
        array('level', '!=', 1),
        array('trang_tuyen', '=', 1)
    );
    $arr_viec_tuyen2 = array(
        array('level', '=', 1),
        array('trang_tuyen', '=', 1)
    );
    $koco_trinh_do = $action->getList_arr('thong_tin_tuyen_dung',$arr_viec_tuyen2,'id','desc','','', '');
    $co_trinh_do = $action->getList_arr('thong_tin_tuyen_dung',$arr_viec_tuyen1,'id','desc','','', '');
    $count_trinhdo = $action->getCount_diff('thong_tin_tuyen_dung', 'level', '1');
    $count_phothong = $action->getCount('thong_tin_tuyen_dung', 'level', '1');
    $viec_lam_moi = $action->getList('thong_tin_tuyen_dung', '', '', 'time', 'desc', '', '30', '');
?>
    <!--gb-page-sanpham_ruouvang-vieclammoi-->
    <div class="gb-page-sanpham_ruouvang-vieclammoi">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 vh-cap-nhat-vl">
                    <h2 class="gb-page-sanpham_ruouvang-title" style="color: #fff;background-color: #19a05e;">Cập nhật việc làm mới</h2>
                    <div class="gb-page-sanpham_ruouvang-vieclammoi-scroll">
                        <?php 
                        foreach ($viec_lam_moi as $item) { 
                            $info_nha = $action->getDetail('nha_tuyen_dung', 'id', $item['nha_tuyen_dung_id']);
                        ?>
                        <div class="gb-product_ruouvang-item">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="gb-product_ruouvang-item-img">
                                        <a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><img src="/images/<?= $info_nha['image']!='' ? $info_nha['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                                    </div>
                                    <div class="gb-product_ruouvang-item-text">
                                        <h2><a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><?= $item['position'] ?></a></h2>
                                        <p><?= $info_nha['company'] ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4 clear-padding">
                                            <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0002.php";?>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="ngaynophoso-sp">
                                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?= date('d/m/Y', strtotime($item['ngay'])) ?>
                                            </p>
                                        </div>
                                        <div class="col-sm-4 clear-padding-left">
                                            <div class="gb-product_ruouvang-item-address" style="text-align: right;">
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
                </div>
                <div class="col-sm-4 hidden-xs hidden-sm">
                    <?php include DIR_SIDEBAR."MS_SIDEBAR_VIECLAM_0004.php";?>
                </div>
            </div>
        </div>
    </div>
</div>


    <?php include DIR_SEARCH."MS_SEARCH_VIECLAM_0006.php";?>


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

