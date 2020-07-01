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
    // $koco_trinh_do = $action->getList('ung_vien', 'type', '1', 'id', 'desc', '', '', '');
    // $co_trinh_do = $action->getList('ung_vien', 'type', '0', 'id', 'desc', '', '', '');
    $count_trinhdo = $action->getCount('ung_vien', 'type', '0');//var_dump($count_trinhdo);
    $count_phothong = $action->getCount('ung_vien', 'type', '1');//var_dump($count_trinhdo);

    $kinhte = $action_ungvien->getList(0, 1);
    $kythuat = $action_ungvien->getList(0, 2);
    $dichvu = $action_ungvien->getList(0, 3);

    $viec_lam_moi = $action->getList_ajax('ung_vien', 'type', '0', 'time', 'desc', '1', '20', 'a');//var_dump($koco_trinh_do);var_dump($co_trinh_do);
?>
<style>
@media screen and (max-width: 991px) {
    .gb-page-sanpham_ruouvang-title {
        margin-bottom: 0 !important;
    }
}
</style>
<div class="gb-page-sanpham_ruouvang">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="gb-page-sanpham_ruouvang-title"><i class="fa icon-man-woman" aria-hidden="true" style="color: #000;"></i> Ứng viên ngành kinh tế</h2>
            </div>
            <div class="col-md-8">
                <p>
                    <marquee><b style="color: #19a05e;">Tuyển chọn nhân tài</b></marquee>
                </p>
            </div>
        </div>
        
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
            <?php 
            $d = 0;
            foreach ($kinhte as $item) { 
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
                                <div class="kinhnghiem-vieclam">Kinh nghiệm: <span><?= $action->getDetail('kinh_nghiem', 'id', $ho_so['experience'])['name'] ?></span></div>
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
        <div class="row">
            <div class="col-md-4">
                <h2 class="gb-page-sanpham_ruouvang-title"><i class="fa icon-man-woman" aria-hidden="true" style="color: #000;"></i> Ứng viên ngành kỹ thuật</h2>
            </div>
            <div class="col-md-8">
                <p>
                    <marquee><b style="color: #19a05e;">Tuyển chọn nhân tài</b></marquee>
                </p>
            </div>
        </div>
        
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
            <?php 
            $d = 0;
            foreach ($kythuat as $item) { 
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
                                <div class="kinhnghiem-vieclam">Kinh nghiệm: <span><?= $action->getDetail('kinh_nghiem', 'id', $ho_so['experience'])['name'] ?></span></div>
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
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="gb-page-sanpham_ruouvang-title"><i class="fa icon-man-woman" aria-hidden="true" style="color: #000;"></i> Ứng viên ngành dịch vụ</h2>
            </div>
            <div class="col-md-8">
                <p>
                    <marquee><b style="color: #19a05e;">Tuyển chọn nhân tài</b></marquee>
                </p>
            </div>
        </div>
        
        <div class="gb-tieubieu-product_ruouvang-body">
            <div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
            <?php 
            $d = 0;
            foreach ($dichvu as $item) { 
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
                                <div class="kinhnghiem-vieclam">Kinh nghiệm: <span><?= $action->getDetail('kinh_nghiem', 'id', $ho_so['experience'])['name'] ?></span></div>
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
    <!--BANNER-->
    <?php include DIR_BANNER."MS_BANNER_VIECLAM_0001.php";?>
    <!--gb-page-sanpham_ruouvang-vieclammoi-->
    <div class="gb-page-sanpham_ruouvang-vieclammoi hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-sm-8" id="ajax-ung-vien">
                    <h2 class="gb-page-sanpham_ruouvang-title" style="background-color: #2f5177; color: #fff;"><i class="fa fa-user-circle-o" aria-hidden="true" style="    color: #fff;"></i> Ứng viên mới</h2>
                    <div class="gb-page-sanpham_ruouvang-vieclammoi-scroll">
                        <?php 
                        foreach ($viec_lam_moi['data'] as $item) { 
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
                                        <div class="kinhnghiem-vieclam">Kinh nghiệm: <span><?= $action->getDetail('kinh_nghiem', 'id', $ho_so['experience'])['name'] ?></span></div>
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
                    <div>
                            <?= $viec_lam_moi['paging'] ?>
                        </div>
                </div>
                <div class="col-sm-4">
                    <?php include DIR_SIDEBAR."MS_SIDEBAR_VIECLAM_0004.php";?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include DIR_SEARCH."MS_SEARCH_VIECLAM_0008.php";?>

<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function (){
        $('.gb-tieubieu-product_ruouvang-slide').owlCarousel({
            loop:true,
            margin:10,
            // navSpeed:1000,
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

<script>
    function ajaxf (trang) {
        // alert(trang);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("ajax-ung-vien").innerHTML = this.responseText;
          }
        };
        xhttp.open("GET", "/functions/ajax/phan_trang.php?trang="+trang, true);
        xhttp.send();
    }
</script>