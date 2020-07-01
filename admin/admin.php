<?php
include_once('__autoload.php');

// var_dump($_SESSION);
if (isset($_GET['logout'])) {
    $acc->logout();
    $acc->redirect("index.php");
}

$trang = isset($_GET['trang']) ? $_GET['trang'] : '1';
$infor = $acc->getLoginInfor();

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'vn';
if (isSet($_GET['lang'])) {
    $lang = $_GET['lang'];
    $id_lang = $_GET['lang'];
    // register the session and set the cookie
    $_SESSION['lang'] = $lang;

    //setcookie('lang', $lang, time() + (3600 * 24 * 30));
} else if (isSet($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
    $id_lang = $_SESSION['lang'];
} else if (isSet($_COOKIE['lang'])) {
    $lang = $_COOKIE['lang'];
    $id_lang = $_COOKIE['lang'];
} else {
    $lang = 'vn';
    $id_lang = 'vn';
}
switch ($lang) {
    case 'en':
        $lang_file = 'lang_en.php';
        break;

    case 'vn':
        $lang_file = 'lang_vn.php';
        break;

    default:
        $lang_file = 'lang_vn.php';

}
include_once '../languages/' . $lang_file;
$config_id = 1;
$rowConfigLang = $action->getDetail_New('config_languages', array('config_id', 'languages_code'), array(&$config_id, &$lang), 'is');
?>
<?php
    $hidden_multi_lang = 'hidden';// de an text laf hidden.
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Quản trị</title>

    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" type="text/css" href="css/content.css"/>
    <link rel="stylesheet" type="text/css" href="css/header.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/content.css"/>
    <link rel="stylesheet" type="text/css" href="css/footer.css"/>
    <link rel="stylesheet" type="text/css" href="css/pageload.css"/>
    <link rel='stylesheet' type='text/css' href='css/chi-tiet-trang-noi-dung.css'/>
    <link rel='stylesheet' type='text/css' href='css/trac-nghiem-benh-tri.css'/>
    <link rel="stylesheet" type="text/css" href="css/font.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <script src="https://rawgit.com/andrewng330/PreviewImage/master/preview.image.min.js"></script>
    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="js/getslug.js"></script>
    <script src="js/action_query_ajax.js"></script>
    <script src="js/pageload.min.js"></script>

    <script src="js/jquery-1.11.0.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        (function () {
            var link_element = document.createElement("link"),
                s = document.getElementsByTagName("script")[0];
            if (window.location.protocol !== "http:" && window.location.protocol !== "https:") {
                link_element.href = "http:";
            }
            link_element.href += "//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600italic,600,700italic,700,800italic,800";
            link_element.rel = "stylesheet";
            link_element.type = "text/css";
            s.parentNode.insertBefore(link_element, s);
        })();
    </script>
</head>


<body>
<div id="divWrapper">
    <?php include_once('fixedNav.php'); ?>
    <div class="centerWeb">
        <div class="coverWeb">
            <?php
            if (isset($_GET["page"])) {
                switch ($_GET["page"]) {

                    case 'trinh-don':
                        echo "<link rel='stylesheet' type='text/css' href='css/trang-noi-dung.css' />";
                        include_once('template/trinh-don/menu.php');
                        break;

                    case 'them-trinh-don':
                        include_once("template/trinh-don/them-menu.php");
                        break;

                    case 'sua-trinh-don':
                        include_once("template/trinh-don/sua-menu.php");
                        break;

                    /*----------- Bài viết ------------*/

                    case "bai-viet":
                        echo "<link rel='stylesheet' type='text/css' href='css/trang-noi-dung.css' />";
                        include_once("template/bai-viet/trang-noi-dung.php");
                        break;

                    case "sua-bai-viet":
                        include_once("template/bai-viet/chi-tiet-trang-noi-dung.php");
                        break;

                    case "them-bai-viet":
                        include_once("template/bai-viet/them-trang-noi-dung.php");
                        break;

                    /*----------- Danh mục bài viết ------------*/

                    case "danh-muc-tin-tuc":
                        echo "<link rel='stylesheet' type='text/css' href='css/trang-noi-dung.css' />";
                        include_once("template/danh-muc-tin-tuc/danh-muc-tin-tuc.php");
                        break;

                    case "sua-danh-muc-tin-tuc":
                        include_once("template/danh-muc-tin-tuc/sua-danh-muc-tin-tuc.php");
                        break;

                    case "them-danh-muc-tin-tuc":
                        include_once("template/danh-muc-tin-tuc/them-danh-muc-tin-tuc.php");
                        break;

                    /*------------- Tin tức ------------*/

                    case "them-tin-tuc":
                        include_once("template/tin-tuc/them-tin-tuc.php");
                        break;

                    case "sua-tin-tuc":
                        include_once("template/tin-tuc/sua-tin-tuc.php");
                        break;

                    case "tin-tuc":
                        echo "<link rel='stylesheet' type='text/css' href='css/trang-bai-viet.css' />";
                        include_once("template/tin-tuc/tin-tuc.php");
                        break;

                    /*----------- Danh mục dịch vụ ------------*/

                    case "danh-muc-dich-vu":
                        echo "<link rel='stylesheet' type='text/css' href='css/trang-danh-muc-dich-vu.css' />";
                        include_once("template/danh-muc-dich-vu/danh-muc-dich-vu.php");
                        break;

                    case "sua-danh-muc-dich-vu":
                        include_once("template/danh-muc-dich-vu/sua-danh-muc-dich-vu.php");
                        break;

                    case "them-danh-muc-dich-vu":
                        include_once("template/danh-muc-dich-vu/them-danh-muc-dich-vu.php");
                        break;

                    /*------------- Tin tức ------------*/

                    case "them-dich-vu":
                        include_once("template/dich-vu/them-dich-vu.php");
                        break;

                    case "sua-dich-vu":
                        include_once("template/dich-vu/sua-dich-vu.php");
                        break;

                    case "dich-vu":
                        echo "<link rel='stylesheet' type='text/css' href='css/trang-dich-vu.css' />";
                        include_once("template/dich-vu/dich-vu.php");
                        break;


                    /*-------------- Sản phẩm -----------*/

                    case "them-san-pham":
                        echo "<link rel='stylesheet' type='text/css' href='css/trang-san-pham-them-moi.css' />";
                        include_once("template/san-pham/them-san-pham.php");
                        break;

                    case "sua-san-pham":
                        echo "<link rel='stylesheet' type='text/css' href='css/trang-san-pham-them-moi.css' />";
                        include_once("template/san-pham/sua-san-pham.php");
                        break;

                    case "san-pham":
                        echo "<link rel='stylesheet' type='text/css' href='css/trang-noi-dung.css' />";
                        include_once("template/san-pham/san-pham.php");
                        break;

                    /*-------------- Danh mục sản phẩm -----------*/

                    case "them-danh-muc-san-pham":
                        include_once("template/danh-muc-san-pham/them-loai-san-pham.php");
                        break;

                    case "sua-danh-muc-san-pham":
                        include_once("template/danh-muc-san-pham/sua-loai-san-pham.php");
                        break;

                    case "danh-muc-san-pham":
                        echo "<link rel='stylesheet' type='text/css' href='css/trang-noi-dung.css' />";
                        include_once("template/danh-muc-san-pham/loai-san-pham.php");
                        break;

                    /*-------------- danh sach nguoi dung dang ky thong tin ... -----------*/

                    case "dang-ky":
                        include_once("template/dang-ky/dang-ky.php");
                        break;

                    case "sua-dang-ky":
                        include_once("template/dang-ky/sua-dang-ky.php");
                        break;

                    case "them-dang-ky":
                        include_once("template/dang-ky/them-dang-ky.php");
                        break;

                    /*-------------- danh sach nguoi dung dang ky thành viên -----------*/

                    // case thanh vien user
                     case "tai-khoan-user":
                        include_once("template/tai-khoan-user/tai-khoan-user.php");
                        break;

                    // 

                    case "thanh-vien":
                        include_once("template/thanh-vien/thanh-vien.php");
                        break;

                    case "sua-thanh-vien":
                        include_once("template/thanh-vien/sua-thanh-vien.php");
                        break;

                    case "them-thanh-vien":
                        include_once("template/thanh-vien/them-thanh-vien.php");
                        break;


                    /*------------- Tài khoản ------------*/

                    case "tai-khoan":
                        echo "<link rel='stylesheet' type='text/css' href='css/trang-san-pham.css' />";
                        include_once("template/tai-khoan/tai-khoan.php");
                        break;

                    case "them-tai-khoan":
                        echo "<link rel='stylesheet' type='text/css' href='css/trang-san-pham-them-moi.css' />";
                        include_once("template/tai-khoan/them-tai-khoan.php");
                        break;

                    case "sua-tai-khoan":
                        echo "<link rel='stylesheet' type='text/css' href='css/trang-san-pham-them-moi.css' />";
                        include_once("template/tai-khoan/sua-tai-khoan.php");
                        break;


                    /*--------- Config -------------*/

                    case 'config':
                        include_once('config.php');
                        break;

                    ///////////// Trang đơn hàng //////////////////

                    case "them-don-hang":
                        include_once("template/don-hang/them-don-hang.php");
                        break;

                    case "sua-don-hang":
                        echo "<link rel='stylesheet' type='text/css' href='css/sua-don-hang.css' />";
                        include_once("template/don-hang/sua-don-hang.php");
                        break;

                    case "don-hang":
                        echo "<link rel='stylesheet' type='text/css' href='css/trang-don-hang.css' />";
                        include_once("template/don-hang/don-hang.php");
                        break;

                    case 'lien-he':
                        include_once('template/lien-he.php');
                        break;
                    //////////////Slider///////////////////
                    case "slider":
                        include_once("slider.php");
                        break;

                    case "them-slider":
                        include_once("them-slider.php");
                        break;

                    case "sua-slider":
                        include_once("sua-slider.php");
                        break;
                    /////////////// Quảng cáo //////////////////////
                    case "quang-cao":
                        include_once("quang-cao.php");
                        break;

                    case "them-quang-cao":
                        include_once("them-quang-cao.php");
                        break;

                    case "sua-quang-cao":
                        include_once("sua-quang-cao.php");
                        break;
                    /////////////// video ////////////////
                    case "video":
                        include_once("template/video/video.php");
                        break;
                    case "them-video":
                        include_once("template/video/them-video.php");
                        break;
                    case "sua-video":
                        include_once("template/video/sua-video.php");
                        break;
                    case "xoa-video":
                        include_once("template/video/xoa-video.php");
                        break;
                    ////////////// nganh nghe /////////////
                    case "nganh-nghe":
                        include_once("template/nganh-nghe/nganh-nghe.php");
                        break;
                    case "them-nganh-nghe":
                        include_once("template/nganh-nghe/them-nganh-nghe.php");
                        break;
                    case "sua-nganh-nghe":
                        include_once("template/nganh-nghe/sua-nganh-nghe.php");
                        break;
                    case "xoa-nganh-nghe":
                        include_once("template/nganh-nghe/xoa-nganh-nghe.php");
                        break;
                    ///////////// dia diem ////////////////
                    case "dia-diem":
                        include_once("template/dia-diem/dia-diem.php");
                        break;
                    case "them-dia-diem":
                        include_once("template/dia-diem/them-dia-diem.php");
                        break;
                    case "sua-dia-diem":
                        include_once("template/dia-diem/sua-dia-diem.php");
                        break;
                    case "xoa-dia-diem":
                        include_once("template/dia-diem/xoa-dia-diem.php");
                        break;
                    ///////////// chuc vu /////////////////
                    case "chuc-vu":
                        include_once("template/chuc-vu/chuc-vu.php");
                        break;
                    case "them-chuc-vu":
                        include_once("template/chuc-vu/them-chuc-vu.php");
                        break;
                    case "sua-chuc-vu":
                        include_once("template/chuc-vu/sua-chuc-vu.php");
                        break;
                    case "xoa-chuc-vu":
                        include_once("template/chuc-vu/xoa-chuc-vu.php");
                        break;
                    ///////////////// slide //////////////
                    case "slide":
                        include_once("template/slide/slide.php");
                        break;
                    case "them-slide":
                        include_once("template/slide/them-slide.php");
                        break;
                    case "sua-slide":
                        include_once("template/slide/sua-slide.php");
                        break;
                    case "xoa-slide":
                        include_once("template/slide/xoa-slide.php");
                        break;
                    /////////// hotline bac ///////////////
                    case "hotline-bac":
                        include_once("template/hotline-bac/hotline-bac.php");
                        break;
                    case "them-hotline-bac":
                        include_once("template/hotline-bac/them-hotline-bac.php");
                        break;
                    case "sua-hotline-bac":
                        include_once("template/hotline-bac/sua-hotline-bac.php");
                        break;
                    case "xoa-hotline-bac":
                        include_once("template/hotline-bac/xoa-hotline-bac.php");
                        break;
                     /////////// hotline nam ///////////////
                    case "hotline-nam":
                        include_once("template/hotline-nam/hotline-nam.php");
                        break;
                    case "them-hotline-nam":
                        include_once("template/hotline-nam/them-hotline-nam.php");
                        break;
                    case "sua-hotline-nam":
                        include_once("template/hotline-nam/sua-hotline-nam.php");
                        break;
                    case "xoa-hotline-nam":
                        include_once("template/hotline-nam/xoa-hotline-nam.php");
                        break;
                    ///////// tuyen dung /////////////
                    case "nha-tuyen-dung":
                        include_once("template/nha-tuyen-dung/nha-tuyen-dung.php");
                        break;
                    case "them-nha-tuyen-dung":
                        include_once("template/nha-tuyen-dung/them-nha-tuyen-dung.php");
                        break;
                    case "sua-nha-tuyen-dung":
                        include_once("template/nha-tuyen-dung/sua-nha-tuyen-dung.php");
                        break;
                    case "xoa-nha-tuyen-dung":
                        include_once("template/nha-tuyen-dung/xoa-nha-tuyen-dung.php");
                        break;
                    //////// ứng viên co trình độ, pho thong /////////
                    case "ung-vien-co-trinh-do":
                        include_once("template/ung-vien/ung-vien-co-trinh-do.php");
                        break;
                    case "them-ung-vien-co-trinh-do":
                        include_once("template/ung-vien/them-ung-vien-co-trinh-do.php");
                        break;
                    case "sua-ung-vien":
                        include_once("template/ung-vien/sua-ung-vien.php");
                        break;
                    case "xoa-ung-vien":
                        include_once("template/ung-vien/xoa-ung-vien.php");
                        break;
                    case "ung-vien-pho-thong":
                        include_once("template/ung-vien/ung-vien-pho-thong.php");
                        break;
                    case "them-ung-vien-pho-thong":
                        include_once("template/ung-vien/them-ung-vien-pho-thong.php");
                        break;
                    case 'ho-so':
                        include_once("template/ung-vien/ho-so.php");
                        break;
                    ///////////// don tuyền //////////////
                    case "don-tuyen":
                        include_once("template/don-tuyen/don-tuyen.php");
                        break;
                    case "them-don-tuyen":
                        include_once("template/don-tuyen/them-don-tuyen.php");
                        break;
                    case "sua-don-tuyen":
                        include_once("template/don-tuyen/sua-don-tuyen.php");
                        break;
                    case "xoa-don-tuyen":
                        include_once("template/don-tuyen/xoa-don-tuyen.php");
                        break;
                    ///////////// slideshow ///////////////
                    case "slideshow":
                        include_once("template/slideshow/slideshow.php");
                        break;
                    case "them-slideshow":
                        include_once("template/slideshow/them-slideshow.php");
                        break;
                    case "sua-slideshow":
                        include_once("template/slideshow/sua-slideshow.php");
                        break;
                    case "xoa-slideshow":
                        include_once("template/slideshow/xoa-slideshow.php");
                        break;
                    ///////////// goi diem ////////////////
                    case "goi-diem":
                        include_once("template/goi-diem/goi-diem.php");
                        break;
                    case "them-goi-diem":
                        include_once("template/goi-diem/them-goi-diem.php");
                        break;
                    case "sua-goi-diem":
                        include_once("template/goi-diem/sua-goi-diem.php");
                        break;
                    case "xoa-goi-diem":
                        include_once("template/goi-diem/xoa-goi-diem.php");
                        break;
                    ////////////// book diem //////////////
                    case "book-diem":
                        include_once("template/book-diem/book-diem.php");
                        break;
                    case "book-home":
                        include_once("template/book-diem/book-home.php");
                        break;
                    case "book-tuyen":
                        include_once("template/book-diem/book-tuyen.php");
                        break;
                    ///////////// home time ///////////////
                    case "home-time":
                        include_once("template/home-time/home-time.php");
                        break;
                    case "them-home-time":
                        include_once("template/home-time/them-home-time.php");
                        break;
                    case "sua-home-time":
                        include_once("template/home-time/sua-home-time.php");
                        break;
                    case "xoa-home-time":
                        include_once("template/home-time/xoa-home-time.php");
                        break;
                    ////////////// tuyen time /////////////
                    case "tuyen-time":
                        include_once("template/tuyen-time/tuyen-time.php");
                        break;
                    case "them-tuyen-time":
                        include_once("template/tuyen-time/them-tuyen-time.php");
                        break;
                    case "sua-tuyen-time":
                        include_once("template/tuyen-time/sua-tuyen-time.php");
                        break;
                    case "xoa-tuyen-time":
                        include_once("template/tuyen-time/xoa-tuyen-time.php");
                        break;
                    ////////////// nha tuyen dung /////////
                    case "tin-da-dang-ntd":
                        include_once("template/nha-tuyen-dung/tin-da-dang.php");
                        break;
                    case "ho-so-ung-tuyen-ntd":
                        include_once("template/nha-tuyen-dung/ho-so-ung-tuyen.php");
                        break;
                    case "ho-so-da-luu-ntd":
                        include_once("template/nha-tuyen-dung/ho-so-da-luu.php");
                        break;
                    ///////////// Default /////////////////
                    default:
                        include_once("homeAdmin.php");
                }
            } else {
                include_once("homeAdmin.php");
            }
            ?>

        </div><!--end coverWeb-->
    </div>
</div><!--end divWrapper-->
<link rel="stylesheet" type="text/css" href="../css/select2.min.css"/>
<script src="../js/select2.min.js"></script>
<script>
    $(function () {
        $('.select2').select2({
            width: '100%',
        });
    })
</script>
<style>
    .select2-results__option, .select2-results__options {
        width: 100%;
    }
</style>
</body>
</html>

