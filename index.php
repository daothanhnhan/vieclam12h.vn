<?php
//phpinfo();die;
session_start();
ob_start();
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$folder = dirname(__FILE__);
include_once('config.php');
include_once('__autoload.php');
$action = new action();
include_once dirname(__FILE__).DIR_FUNCTIONS."database.php";
// $urlAnalytic = $action->showabc();    
include_once dirname(__FILE__).DIR_FUNCTIONS_PAGING."pagination.php";
include_once 'functions/phpmailer/class.smtp.php';
include_once 'functions/phpmailer/class.phpmailer.php';
include_once "functions/vi_en.php";
// // LÀM RÕ NHỮNG THƯ VIỆN NÀY
// // include_once('lib/vi_en.php');
// // include_once('lib/nganLuong/NL_Checkoutv3.php');

// // LÀM RÕ Install Cart

// Install MultiLanguage
include_once dirname(__FILE__).DIR_FUNCTIONS_LANGUAGE."lang_config.php";
include_once dirname(__FILE__).DIR_FUNCTIONS_LANGUAGE.$lang_file;
// Install Friendly Url
include_once dirname(__FILE__).DIR_FUNCTIONS_URL."url_config.php";
// Configure Website
include_once dirname(__FILE__).DIR_FUNCTIONS."website_config.php";
// echo $translate['link_contact'];die;
$trang = isset($_GET['trang']) ? $_GET['trang'] : '1';
// $action = new action();
$cart = new action_cart();
$menu = new action_menu();
$action_product = new action_product();
$action_news = new action_news();
$action_page = new action_page();
$action_ungvien = new action_ungvien();
if($lang == "vn"){
    $rowConfig_lang = $action->getDetail('config_languages','id',1);
}else{
    $rowConfig_lang = $action->getDetail('config_languages','id',2);
}


$rowConfig = $action->getDetail('config','config_id',1);

$experience = array('', 'Chưa có kinh nghiệm', 'Dưới 1 năm', '1 năm', '2 năm', '3 năm', '4 năm', '5 năm', '6 năm', '7 năm', '8 năm', 'Trên 8 năm');
$bang_cap = array('', 'Lao động phổ thông', 'Trung cấp', 'Cao đẳng', 'Đại học', 'Thạc sĩ');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?= $meta_des ?>"> 
    <meta name="keywords" content="<?= $meta_key ?>">
    <title><?= $title ?></title>
    <link rel="icon" href="/images/<?= $rowConfig['icon_web'] ?>" type="image/gif" sizes="16x16">

    <link rel="stylesheet" href="/plugin/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/plugin/bootstrap/css/bootstrap-theme.css">
    <link rel="stylesheet" href="/plugin/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style-ruouvang.css">
    <link rel="stylesheet" href="/css/vieclam12h-item.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <script src="/plugin/jquery/jquery-2.0.2.min.js"></script>
    <script src="/plugin/bootstrap/js/bootstrap.js"></script>
	
	
	<meta property="og:url"                content="http://vieclam12h.vn/" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="Cổng thông tin việc làm Việt Nam" />
<meta property="og:description"        content="Tìm việc hiệu quả - Tìm việc nhanh - Hàng nghìn công ty đang tuyển nhân sự trên vieclam12h" />
<meta property="og:image"              content="http://vieclam12h.vn/images/vieclam/vieclam.jpg" alt="logo" />

</head>

<body>

<?php include_once dirname(__FILE__).DIR_THEMES."header.php";?>

<div class="gb-content">
    <?php
    if (isset($_GET['page'])){

        $urlAnalytic = $action->getTypePage_byUrl($_GET['page'],$lang);
        // echo $urlAnalytic;
        switch ($urlAnalytic) {

            case 'tin-tuc':

                include_once dirname(__FILE__).DIR_THEMES."tintuc.php"; break;

            case 'newscat_languages':

                include_once dirname(__FILE__).DIR_THEMES."tintuc.php"; break;

            case 'news_languages':

                include_once dirname(__FILE__).DIR_THEMES."chitiettintuc.php"; break;
            case 'lien-he':

                include_once dirname(__FILE__).DIR_THEMES."lienhe.php"; break;

            case 'gio-hang':

                include_once dirname(__FILE__).DIR_THEMES."giohang.php"; break;

            // case 'khuyen-mai':

            //     include_once dirname(__FILE__).DIR_THEMES."khuyenmai.php"; break;
            case 'tuyen-dung':

                include_once dirname(__FILE__).DIR_THEMES."sanpham.php"; break;
            case 'hang-thanh-ly':

                include_once dirname(__FILE__).DIR_THEMES."hangthanhly.php"; break;

            case 'thanh-toan':

                include_once dirname(__FILE__).DIR_THEMES."thanhtoan.php"; break;
            case 'thong-tin-tuyen-dung':

                include_once dirname(__FILE__).DIR_THEMES."chitietsanpham.php"; break;
            // case 'huong-dan-dat-hang':

            //     include_once dirname(__FILE__).DIR_THEMES."huongdanmuahang.php"; break;
            // case 'huong-dan-thanh-toan':

            //     include_once dirname(__FILE__).DIR_THEMES."cachthucthanhtoan.php"; break;

            // case 'chinh-sach-van-chuyen':

            //     include_once dirname(__FILE__).DIR_THEMES."chinhsachvanchuyen.php"; break;
            case 'page_language':

                include_once dirname(__FILE__).DIR_THEMES."gioithieu.php"; break;
            case 'ung-vien-co-trinh-do':

                include_once dirname(__FILE__).DIR_THEMES."ungvien.php"; break;
            case 'dang-ky-nha-tuyen-dung':

                include_once dirname(__FILE__).DIR_THEMES."dangkynhatuyendung.php"; break;
            case 'dang-ky-ung-vien-co-trinh-do':

                include_once dirname(__FILE__).DIR_THEMES."dangkyungvien.php"; break;

            case 'dang-ky-ung-vien-pho-thong':
            	include_once dirname(__FILE__) . DIR_THEMES . "dangkyungvien-phothong.php";break;

            case 'dang-xuat':
                include_once dirname(__FILE__) . DIR_THEMES . "dangxuat.php";break;

            case 'dang-nhap':
                include_once dirname(__FILE__) . DIR_THEMES . "dangnhap.php";break;

            case 'don-tuyen-dung':
                include_once dirname(__FILE__) . DIR_THEMES . "thong-tin-tuyen-dung.php";break;

            case 'tim-kiem':
                include_once dirname(__FILE__) . DIR_THEMES . "tim-kiem.php";break;

            case 'tim-kiem-1':
                include_once dirname(__FILE__) . DIR_THEMES . "tim-kiem-1.php";break;

            case 'tim-kiem-2':
                include_once dirname(__FILE__) . DIR_THEMES . "tim-kiem-2.php";break;

            case 'tim-kiem-ung-vien':
                include_once dirname(__FILE__) . DIR_THEMES . "tim-kiem-ung-vien.php";break;

            case 'tim-kiem-ung-vien-1':
                include_once dirname(__FILE__) . DIR_THEMES . "tim-kiem-ung-vien-1.php";break;

            case 'thong-tin-ung-tuyen':
                include_once dirname(__FILE__) . DIR_THEMES . "thong-tin-ung-tuyen.php";break;

            case 'thong-tin-don-tuyen-dung':
                include_once dirname(__FILE__) . DIR_THEMES . "thong-tin-don-tuyen-dung.php";break;

            case 'dang-ky':
                include_once dirname(__FILE__) . DIR_THEMES . "dang-ky.php";break;

            case 'mien-bac':
                include_once dirname(__FILE__) . DIR_THEMES . "mien-bac.php";break;

            case 'mien-nam':
                include_once dirname(__FILE__) . DIR_THEMES . "mien-nam.php";break;

            case 'ung-vien-pho-thong':
                include_once dirname(__FILE__) . DIR_THEMES . "ung-vien-pho-thong.php";break;

            case 'mua-diem':
                include_once dirname(__FILE__) . DIR_THEMES . "mua-diem.php";break;

            case 'bao-gia':
                include_once dirname(__FILE__) . DIR_THEMES . "bao-gia.php";break;

            case 'bang-gia':
                include_once dirname(__FILE__) . DIR_THEMES . "bang-gia.php";break;

            case 'trang-quan-ly':
                include_once dirname(__FILE__) . DIR_THEMES . "trang-quan-ly.php";break;

            case 'viec-lam-da-dang':
                include_once dirname(__FILE__) . DIR_THEMES . "viec-lam-da-dang.php";break;

            case 'ho-so-ung-tuyen':
                include_once dirname(__FILE__) . DIR_THEMES . "ho-so-ung-tuyen.php";break;

            case 'ho-so-da-luu':
                include_once dirname(__FILE__) . DIR_THEMES . "ho-so-da-luu.php";break;

            case 'quen-mat-khau-ntd':
                include_once dirname(__FILE__) . DIR_THEMES . "quen-mat-khau-ntd.php";break;

            case 'quen-mat-khau-ung-vien':
                include_once dirname(__FILE__) . DIR_THEMES . "quen-mat-khau-ung-vien.php";break;

            case 'doi-mat-khau-ntd':
                include_once dirname(__FILE__) . DIR_THEMES . "doi-mat-khau-ntd.php";break;

            case "doi-mat-khau-ung-vien":
                include_once dirname(__FILE__) . DIR_THEMES . "doi-mat-khau-ung-vien.php";break;

            // case 'tuan':
                // include_once dirname(__FILE__) . DIR_THEMES . "tuan.php";break;
        }
    }
    else include_once dirname(__FILE__).DIR_THEMES."home.php";
    ?>
</div>


<?php include_once dirname(__FILE__).DIR_THEMES."footer.php"; ?>

<!-- <a href="tel:0963788838" class="suntory-alo-phone suntory-alo-green" id="suntory-alo-phoneIcon" style="left: 0px; bottom: 0px;">
  <div class="suntory-alo-ph-circle"></div>
  <div class="suntory-alo-ph-circle-fill"></div>
  <div class="suntory-alo-ph-img-circle"><i class="fa fa-phone"></i></div>
</a>

<style type="text/css">
  .suntory-alo-phone {
  background-color: transparent;
  cursor: pointer;
  height: 120px;
  position: fixed;
  transition: visibility 0.5s ease 0s;
  width: 120px;
  z-index: 200000 !important;
}
.suntory-alo-ph-circle {
  animation: 1.2s ease-in-out 0s normal none infinite running suntory-alo-circle-anim;
  background-color: transparent;
  border: 2px solid rgba(30, 30, 30, 0.4);
  border-radius: 100%;
  height: 100px;
  left: 0px;
  opacity: 0.1;
  position: absolute;
  top: 0px;
  transform-origin: 50% 50% 0;
  transition: all 0.5s ease 0s;
  width: 100px;
}
.suntory-alo-ph-circle-fill {
  animation: 2.3s ease-in-out 0s normal none infinite running suntory-alo-circle-fill-anim;
  border: 2px solid transparent;
  border-radius: 100%;
  height: 70px;
  left: 15px;
  position: absolute;
  top: 15px;
  transform-origin: 50% 50% 0;
  transition: all 0.5s ease 0s;
  width: 70px;
}
.suntory-alo-ph-img-circle {
  border: 2px solid transparent;
  border-radius: 100%;
  height: 50px;
  left: 25px;
  opacity: 0.7;
  position: absolute;
  top: 25px;
  transform-origin: 50% 50% 0;
  width: 50px;
  text-align: center;
}
.suntory-alo-phone.suntory-alo-hover, .suntory-alo-phone:hover {
  opacity: 1;
}
.suntory-alo-phone.suntory-alo-active .suntory-alo-ph-circle {
  animation: 1.1s ease-in-out 0s normal none infinite running suntory-alo-circle-anim !important;
}
.suntory-alo-phone.suntory-alo-static .suntory-alo-ph-circle {
  animation: 2.2s ease-in-out 0s normal none infinite running suntory-alo-circle-anim !important;
}
.suntory-alo-phone.suntory-alo-hover .suntory-alo-ph-circle, .suntory-alo-phone:hover .suntory-alo-ph-circle {
  border-color: #00aff2;
  opacity: 0.5;
}
.suntory-alo-phone.suntory-alo-green.suntory-alo-hover .suntory-alo-ph-circle, .suntory-alo-phone.suntory-alo-green:hover .suntory-alo-ph-circle {
  border-color: #EB278D;
  opacity: 1;
}
.suntory-alo-phone.suntory-alo-green .suntory-alo-ph-circle {
  border-color: #bfebfc;
  opacity: 1;
}
.suntory-alo-phone.suntory-alo-hover .suntory-alo-ph-circle-fill, .suntory-alo-phone:hover .suntory-alo-ph-circle-fill {
  background-color: rgba(0, 175, 242, 0.9);
}
.suntory-alo-phone.suntory-alo-green.suntory-alo-hover .suntory-alo-ph-circle-fill, .suntory-alo-phone.suntory-alo-green:hover .suntory-alo-ph-circle-fill {
  background-color: #EB278D;
}
.suntory-alo-phone.suntory-alo-green .suntory-alo-ph-circle-fill {
  background-color: rgba(0, 175, 242, 0.9);
}
.suntory-alo-phone.suntory-alo-hover .suntory-alo-ph-img-circle, .suntory-alo-phone:hover .suntory-alo-ph-img-circle {
  background-color: #00aff2;
}
.suntory-alo-phone.suntory-alo-green.suntory-alo-hover .suntory-alo-ph-img-circle, .suntory-alo-phone.suntory-alo-green:hover .suntory-alo-ph-img-circle {
  background-color: #EB278D;
}
.suntory-alo-phone.suntory-alo-green .suntory-alo-ph-img-circle {
  background-color: #00aff2;
}
@keyframes suntory-alo-circle-anim {
  0% {
    opacity: 0.1;
    transform: rotate(0deg) scale(0.5) skew(1deg);
  }
  30% {
    opacity: 0.5;
    transform: rotate(0deg) scale(0.7) skew(1deg);
  }
  100% {
    opacity: 0.6;
    transform: rotate(0deg) scale(1) skew(1deg);
  }
}
@keyframes suntory-alo-circle-img-anim {
  0% {
    transform: rotate(0deg) scale(1) skew(1deg);
  }
  10% {
    transform: rotate(-25deg) scale(1) skew(1deg);
  }
  20% {
    transform: rotate(25deg) scale(1) skew(1deg);
  }
  30% {
    transform: rotate(-25deg) scale(1) skew(1deg);
  }
  40% {
    transform: rotate(25deg) scale(1) skew(1deg);
  }
  50% {
    transform: rotate(0deg) scale(1) skew(1deg);
  }
  100% {
    transform: rotate(0deg) scale(1) skew(1deg);
  }
}
@keyframes suntory-alo-circle-fill-anim {
  0% {
    opacity: 0.2;
    transform: rotate(0deg) scale(0.7) skew(1deg);
  }
  50% {
    opacity: 0.2;
    transform: rotate(0deg) scale(1) skew(1deg);
  }
  100% {
    opacity: 0.2;
    transform: rotate(0deg) scale(0.7) skew(1deg);
  }
}
.suntory-alo-ph-img-circle i {
  animation: 1s ease-in-out 0s normal none infinite running suntory-alo-circle-img-anim;
  font-size: 30px;
  line-height: 50px;
  color: #fff;
  float: none;
}
@keyframes suntory-alo-ring-ring {
  0% {
    transform: rotate(0deg) scale(1) skew(1deg);
  }
  10% {
    transform: rotate(-25deg) scale(1) skew(1deg);
  }
  20% {
    transform: rotate(25deg) scale(1) skew(1deg);
  }
  30% {
    transform: rotate(-25deg) scale(1) skew(1deg);
  }
  40% {
    transform: rotate(25deg) scale(1) skew(1deg);
  }
  50% {
    transform: rotate(0deg) scale(1) skew(1deg);
  }
  100% {
    transform: rotate(0deg) scale(1) skew(1deg);
  }
}

</style> -->

<!-- <script lang="javascript">var _vc_data = {id : 210888, secret : 'c2a29174185144409f48ff3ac4fbc35b'};(function() {var ga = document.createElement('script');ga.type = 'text/javascript';ga.async=true; ga.defer=true;ga.src = '//live.vnpgroup.net/client/tracking.js?id=210888';var s = document.getElementsByTagName('script');s[0].parentNode.insertBefore(ga, s[0]);})();</script> -->


<!--
Do not modify the NAME value of any of the INPUT fields
the FORM action, or any of the hidden fields (eg. input type=hidden).
These are all required for this form to function correctly.
-->
<!-- <style type="text/css">

  .myForm td, input, select, textarea, checkbox  {
    font-family: tahoma;
    font-size: 12px;
  }

  .required {
    color: red;
  }

</style> -->
<!-- <form method="post" action="https://app.zetamail.vn/form.php?form=127" id="frmSS127" onsubmit="return CheckForm127(this);">
  <table border="0" cellpadding="2" class="myForm">
    <tr>
  <td><span class="required">*</span>&nbsp;
Địa chỉ Email của bạn:</td>
  <td><input type="text" name="email" value="" /></td>
</tr><input type="hidden" name="format" value="h" /><tr>
  <td><span class="required">*</span>&nbsp;
Nhập mã bảo mật đã được hiển thị:</td>
  <td><script type="text/javascript">
// <![CDATA[
  if (!Application) var Application = {};
  if (!Application.Page) Application.Page = {};
  if (!Application.Page.ClientCAPTCHA) {
    Application.Page.ClientCAPTCHA = {
      sessionIDString: '',
      captchaURL: [],
      getRandomLetter: function () { return String.fromCharCode(Application.Page.ClientCAPTCHA.getRandom(65,90)); },
      getRandom: function(lowerBound, upperBound) { return Math.floor((upperBound - lowerBound + 1) * Math.random() + lowerBound); },
      getSID: function() {
        if (Application.Page.ClientCAPTCHA.sessionIDString.length <= 0) {
          var tempSessionIDString = '';
          for (var i = 0; i < 32; ++i) tempSessionIDString += Application.Page.ClientCAPTCHA.getRandomLetter();
          Application.Page.ClientCAPTCHA.sessionIDString.length = tempSessionIDString;
        }
        return Application.Page.ClientCAPTCHA.sessionIDString;
      },
      getURL: function() {
        if (Application.Page.ClientCAPTCHA.captchaURL.length <= 0) {
          var tempURL = 'https://app.zetamail.vn/admin/resources/form_designs/captcha/index.php?c=';
          
                      tempURL += Application.Page.ClientCAPTCHA.getRandom(1,1000);
                          tempURL += '&ss=' + Application.Page.ClientCAPTCHA.getSID();
                        Application.Page.ClientCAPTCHA.captchaURL.push(tempURL);
                  }
        return Application.Page.ClientCAPTCHA.captchaURL;
      }
    }
  }

  var temp = Application.Page.ClientCAPTCHA.getURL();
  for (var i = 0, j = temp.length; i < j; i++) document.write('<img src="' + temp[i] + '" alt="img' + i + '" />');
// ]]>
</script>
<br/><input type="text" name="captcha" value="" /></td>
</tr>
    
  </table>
</form>

<script type="text/javascript">
// <![CDATA[

      function CheckMultiple127(frm, name) {
        for (var i=0; i < frm.length; i++)
        {
          fldObj = frm.elements[i];
          fldId = fldObj.id;
          if (fldId) {
            var fieldnamecheck=fldObj.id.indexOf(name);
            if (fieldnamecheck != -1) {
              if (fldObj.checked) {
                return true;
              }
            }
          }
        }
        return false;
      }
    function CheckForm127(f) {
      var email_re = /[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i;
      if (!email_re.test(f.email.value)) {
        alert("Vui lòng nhập email của bạn.");
        f.email.focus();
        return false;
      }
    
        if (f.captcha.value == "") {
          alert("Vui lòng nhập mã bảo mật đã được hiển thị");
          f.captcha.focus();
          return false;
        }
      
        return true;
      }
    
// ]]>
</script> -->

<!--Start of Tawk.to Script-->
<!-- <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5ee841209e5f69442290a31c/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script> -->
<!--End of Tawk.to Script-->
</body>

</html>

