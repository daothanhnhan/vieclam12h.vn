<?php 
    $arr_home_viec_tuyen1 = array(
        // array('level', '!=', 1),
        array('home', '=', 1)
    );
    $arr_home_viec_tuyen2 = array(
        // array('level', '=', 1),
        array('trang_tuyen', '=', 1)
    );
    // $home_viec_tuyendung_1 = $action->getList_diff('thong_tin_tuyen_dung', 'level', '1', 'id', 'desc', '', '30', '');
    $home_viec_tuyendung_1 = $action->getList_arr('thong_tin_tuyen_dung', $arr_home_viec_tuyen1, 'time', 'desc', '', '22', '');
    $count_viec_tuyendung_1 = count($home_viec_tuyendung_1);
    // $home_viec_tuyendung_2 = $action->getList('thong_tin_tuyen_dung', 'level', '1', 'id', 'desc', '', '30', '');
    $home_viec_tuyendung_2 = $action->getList_arr('thong_tin_tuyen_dung', $arr_home_viec_tuyen2, 'time', 'desc', '', '22', '');
    $count_viec_tuyendung_2 = count($home_viec_tuyendung_2);
    //////////////////
    $ntd_arr_1 = array();
    foreach ($home_viec_tuyendung_1 as $item) { 
        if (!in_array($item['nha_tuyen_dung_id'], $ntd_arr_1)) {
            $ntd_arr_1[] = $item['nha_tuyen_dung_id'];
        }
    }
    // var_dump($ntd_arr_1);
    $ntd_arr_count_1 = count($ntd_arr_1);

    $ntd_arr_2 = array();
    foreach ($home_viec_tuyendung_2 as $item) { 
        if (!in_array($item['nha_tuyen_dung_id'], $ntd_arr_2)) {
            $ntd_arr_2[] = $item['nha_tuyen_dung_id'];
        }
    }
    // var_dump($ntd_arr_1);
    $ntd_arr_count_2 = count($ntd_arr_2);
    /////////////////////
    $bang_gia_3 = $action->getList('bang_gia_3', '', '', 'id', 'asc', '', '', '');
    $bang_gia_4 = $action->getList('bang_gia_4', '', '', 'id', 'asc', '', '', '');
    $goi_diem = $action->getList('goi_diem', '', '', 'id', 'asc', '', '', '');
?>
<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<style>
.free {
	background: #2196F3;
    border: 0;
    color: #fff;
    width: 36%;
    font-size: 29px;
    border-radius: 20px;
}
.cac-bo-loc .gb-search-filter-vieclam {
	padding-left: 0;
}
.cac-bo-loc .gb-search-filter-vieclam .container {
	padding: 0; width: 98%;
}
.owl-prev, .owl-next {
    background: #fff !important;
    padding: 8px 20px !important;
}
i.fa-angle-left, i.fa-angle-right {
    background: #14c3ea;
    padding: 0 17px;
    font-size: 36px;
}
@media screen and (max-width: 991px) {
    .mua-tin-title, .free {
        width: 100% !important;
    }
}
</style>
<div class="container">
    <div style="margin-top: 28px;margin-bottom: 20px;">
        <h1 class="mua-tin-title" style="text-align: center;font-size: 2em;text-transform: uppercase;background: #848688;color: #fff;border-radius: 20px;width: 51%;margin-right: auto;margin-left: auto;">Doanh nghiệp sử dụng dịch vụ</h1>
    </div>
    
	<div class="row">
		<div class="col-md-6 gb-tieubieu-product_ruouvang-body">
			<div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
                    <?php
                    $d = 0; 
                    foreach ($home_viec_tuyendung_1 as $item) { 
                        $d++;
                        $info_nha = $action->getDetail('nha_tuyen_dung', 'id', $item['nha_tuyen_dung_id']);
                    ?>
                    <div class="gb-product_ruouvang-item" style="background: #d55c58;border-radius: 9px;">
                        <div class="gb-product_ruouvang-item-img" style="width: 110px;height: 110px;">
                            <a><img src="/images/<?= $info_nha['image']!='' ? $info_nha['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                        </div>
                        <div class="gb-product_ruouvang-item-text">
                            
                            <h2><a style="font-size: 20px;color: #fff;text-transform: uppercase;"><?= $info_nha['company'] ?></a></h2>
                            <p style="color: #ffce45;"><?= $item['position'] ?></p>
                            <p style="color: #fff;"><strong>Nơi làm việc: </strong><?php
                            $thong_tin_diadiem = json_decode($item['location']);//echo $item['location'];
                            $d = 0;
                            foreach ($thong_tin_diadiem as $item1) {
                                $d++;
                                if ($d==1) {
                                    echo $action->getDetail('location', 'id', $item1)['name'];
                                } else {
                                    echo ', '.$action->getDetail('location', 'id', $item1)['name'];
                                }
                            }
                            $item['salary'] = $item['salary'];
                            ?></p>
                            <p style="color: #fff;"><strong>Mức lương:</strong> <span style="color: #ffce45;"><?= $action->getDetail('luong', 'id', $item['salary'])['name']; ?></span></p>
                            <p style="color: #fff;"><strong>Hạn nộp hồ sơ:</strong> <?= date('d/m/Y', strtotime($item['ngay'])) ?></p>
                            
                        </div>
                    </div>
                    <?php 
                    if ($d%1==0) {
                        // if ($d != $count_viec_tuyendung_1) {
                            echo '</div><div class="item">';
                        // }
                    }
                    }
                    ?>
                </div>
            </div>
		</div>
		<div class="col-md-6">
			<div class="gb-tieubieu-product_ruouvang-slide owl-carousel owl-theme">
                <div class="item">
                    <?php
                    $d = 0; 
                    foreach ($home_viec_tuyendung_2 as $item) { 
                        $d++;
                        $info_nha = $action->getDetail('nha_tuyen_dung', 'id', $item['nha_tuyen_dung_id']);
                    ?>
                    <div class="gb-product_ruouvang-item" style="background: #1b91d1;border-radius: 9px;">
                        <div class="gb-product_ruouvang-item-img" style="width: 110px;height: 110px;">
                            <a><img src="/images/<?= $info_nha['image']!='' ? $info_nha['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                        </div>
                        <div class="gb-product_ruouvang-item-text">
                            <h2><a style="font-size: 20px;color: #fff;text-transform: uppercase;"><?= $info_nha['company'] ?></a></h2>
                            <p style="color: #ffce45;"><?= $item['position'] ?></p>
                            <p style="color: #fff;"><strong>Nơi làm việc: </strong><?php
                            $thong_tin_diadiem = json_decode($item['location']);//echo $item['location'];
                            $d = 0;
                            foreach ($thong_tin_diadiem as $item1) {
                                $d++;
                                if ($d==1) {
                                    echo $action->getDetail('location', 'id', $item1)['name'];
                                } else {
                                    echo ', '.$action->getDetail('location', 'id', $item1)['name'];
                                }
                            }
                            $item['salary'] = $item['salary'];
                            ?></p>
                            <p style="color: #fff;"><strong>Mức lương:</strong> <span style="color: #ffce45;"><?= $action->getDetail('luong', 'id', $item['salary'])['name']; ?></span></p>
                            <p style="color: #fff;"><strong>Hạn nộp hồ sơ:</strong> <?= date('d/m/Y', strtotime($item['ngay'])) ?></p>
                            
                        </div>
                    </div>
                    <?php 
                    if ($d%1==0) {
                        // if ($d != $ntd_arr_count_2) {
                            echo '</div><div class="item">';
                        // }
                    }
                    }
                    ?>
                </div>
            </div>
		</div>
	</div>
	<div style="margin-top: 20px;">
        <img src="/images/<?= $rowConfig['banner5'] ?>" alt="" style="width: 100%;">
    </div>

	<div style="text-align: center;margin-top: 50px;">
		<button style="" class="free"><a href="/dang-ky-nha-tuyen-dung" style="color: #fff;text-transform: uppercase;" >Tạo hồ sơ tuyển dụng</a></button>
	</div>

    <div style="background: #c3bfb9; padding: 16px;margin-top: 20px;">
        <h2 style="font-weight: 700;color: #fff;font-size: 18px;margin-top: -5px;text-transform: uppercase;">Bảng giá gói mua điểm lọc hồ sơ</h2>
        <div style="border: 1px solid #bfcbd9;padding: 10px;background: #fff;">
            <?php foreach ($goi_diem as $item) { ?>
            <div class="col-md-3 col-xs-6 col-sm-6" style="padding: 5px;">
                <p><input type="radio" name="diem" onclick="chon_3(<?= $item['id'] ?>)"> <?= $item['diem'] ?> Điểm</p>
                <p style="color: #e34a4e;"><?= number_format($item['gia']) ?> đ</p>
            </div>
            <?php } ?>
            <div style="clear: both;text-align: right;">
                <button type="button" style="margin: 5px;" onclick="mua_3(<?= $_SESSION['user_id_gbvn'] ?>)">Mua tin</button>
                <!-- <img src="/images/icons/tin-hap-dan.png" onclick="mua_1(<?= $_SESSION['user_id_gbvn'] ?>)" alt=""> -->
            </div>
        </div>
    </div>

    <div style="background: #c3bfb9; padding: 16px;margin-top: 20px;">
        <h2 style="font-weight: 700;color: #fff;font-size: 18px;margin-top: -5px;text-transform: uppercase;">Bảng giá đăng tin trang chủ - Tuyển dụng gấp</h2>
        <div style="border: 1px solid #bfcbd9;padding: 10px;background: #fff;">
            <?php foreach ($bang_gia_3 as $item) { ?>
            <div class="col-md-3 col-xs-6 col-sm-6" style="padding: 5px;">
                <p><input type="radio" name="home" onclick="chon_1(<?= $item['id'] ?>)"> <?= $item['week'] ?> Tuần</p>
                <p style="color: #e34a4e;"><?= number_format($item['price']) ?> đ</p>
            </div>
            <?php } ?>
            <div style="clear: both;text-align: right;">
                <button type="button" style="margin: 5px;" onclick="mua_1(<?= $_SESSION['user_id_gbvn'] ?>)">Mua tin</button>
                <!-- <img src="/images/icons/tin-hap-dan.png" onclick="mua_1(<?= $_SESSION['user_id_gbvn'] ?>)" alt=""> -->
            </div>
        </div>
    </div>

    <div style="background: #c3bfb9; padding: 16px;margin-top: 20px;">
        <h2 style="font-weight: 700;color: #fff;font-size: 18px;margin-top: -5px;text-transform: uppercase;">Bảng giá đăng tin trang tuyển - Tuyển dụng nhanh</h2>
        <div style="border: 1px solid #bfcbd9;padding: 10px;background: #fff;">
            <?php foreach ($bang_gia_4 as $item) { ?>
            <div class="col-md-3 col-xs-6 col-sm-6" style="padding: 5px;">
                <p><input type="radio" name="tuyen" onclick="chon_2(<?= $item['id'] ?>)"> <?= $item['week'] ?> Tuần</p>
                <p style="color: #e34a4e;"><?= number_format($item['price']) ?> đ</p>
            </div>
            <?php } ?>
            <div style="clear: both;text-align: right;">
                <button type="button" style="margin: 5px;" onclick="mua_2(<?= $_SESSION['user_id_gbvn'] ?>)">Mua tin</button>
                <!-- <img src="/images/icons/tin-hap-dan.png" onclick="mua_2(<?= $_SESSION['user_id_gbvn'] ?>)" alt=""> -->
            </div>
        </div>
    </div>

	<div class="cac-bo-loc" style="display: none;">
		<h3>Lọc trang chủ</h3>
		<?php include DIR_SEARCH."MS_SEARCH_VIECLAM_0005.php";?>
		<h3>Lọc tuyển dụng</h3>
		<?php include DIR_SEARCH."MS_SEARCH_VIECLAM_0004.php";?>
		<h3>Lọc ứng viên có trình độ</h3>
		<?php include DIR_SEARCH."MS_SEARCH_VIECLAM_0004_1.php";?>
		<h3>Lọc ứng viên phổ thông</h3>
		<?php include DIR_SEARCH."MS_SEARCH_VIECLAM_0004_2.php";?>
	</div>
	<br>
</div>

<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function (){
        $('.gb-tieubieu-product_ruouvang-slide').owlCarousel({
            loop:true,
            margin:10,
            // navSpeed:500,
            autoplayTimeout:2000,
            nav:false,
            dots: false,
            autoplay: true,
            rewind: true,
            navText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
            responsive:{
                0:{
                    items:1,
                    nav: true
                },
                992:{
                    items: 1,
                    nav:true
                }
            }
        });
    });
</script>

<script>
    var home = 0;
    var tuyen = 0;
    var diem = 0;

    function chon_1 (id) {
        // alert(id);
        home = id;
    }

    function chon_2 (id) {
        // alert(id);
        tuyen = id;
    }

    function chon_3 (id) {
        // alert(id);
        diem = id;
    }

    function mua_1 (ntd_id) {
        // alert(home);
        // alert(home);
        if (ntd_id == null) {
            alert('Bạn chưa đăng nhập.');
            return false;
        }

        if (home == 0) {
            alert('Bạn chưa chọn');
        } else {
            book_home(home, ntd_id);
        }
    }

    function mua_2 (ntd_id) {
        // alert(tuyen);
        // alert(ntd_id);
        if (ntd_id == null) {
            alert('Bạn chưa đăng nhập.');
            return false;
        }

        if (tuyen == 0) {
            alert('Bạn chưa chọn');
        } else {
            book_tuyen(tuyen, ntd_id);
        }
    }

    function mua_3 (ntd_id) {
        // alert(diem);
        // alert(ntd_id);
        if (ntd_id == null) {
            alert('Bạn chưa đăng nhập.');
            return false;
        }

        if (diem == 0) {
            alert('Bạn chưa chọn');
        } else {
            mua_diem(diem, ntd_id);
        }
    }

    function book_home (goi_id, ntd_id) {
        // alert(goi_id);alert(ntd_id);
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             // document.getElementById("demo").innerHTML = this.responseText;
                alert(this.responseText);
            }
          };
          xhttp.open("GET", "/functions/ajax/book_home.php?goi_id="+goi_id+"&ntd_id="+ntd_id, true);
          xhttp.send();
    }

    function book_tuyen (goi_id, ntd_id) {
        // alert(goi_id);alert(ntd_id);
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             // document.getElementById("demo").innerHTML = this.responseText;
                alert(this.responseText);
            }
          };
          xhttp.open("GET", "/functions/ajax/book_tuyen.php?goi_id="+goi_id+"&ntd_id="+ntd_id, true);
          xhttp.send();
    }

    function mua_diem (goi_id, ntd_id) {
        // alert(goi_id);alert(ntd_id);
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             // document.getElementById("demo").innerHTML = this.responseText;
                alert(this.responseText);
            }
          };
          xhttp.open("GET", "/functions/ajax/mua_diem.php?goi_id="+goi_id+"&ntd_id="+ntd_id, true);
          xhttp.send();
    }
</script>