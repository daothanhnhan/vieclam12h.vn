<?php 
    // var_dump($_SESSION);
    if (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 1) {
        $info['image'] = $action->getDetail('nha_tuyen_dung', 'id', $_SESSION['user_id_gbvn'])['image'];
    } else {
        $info['image'] = $action->getDetail('ung_vien', 'id', $_SESSION['user_id_gbvn'])['image'];
    }
    ////////////////////
    $ung_vien_active = 0;
    if ($_GET['page']=='thong-tin-ung-tuyen') {
        $ung_vien_menu = $action->getDetail('ung_vien', 'id', $_GET['trang']);
        $ung_vien_menu_type = $ung_vien_menu['type'];
        if ($ung_vien_menu_type == 0) {
            $ung_vien_active = 1;
        } else if ($ung_vien_menu_type == 1) {
            $ung_vien_active = 2;
        }
    }
?>
<link href="https://doannguyennet.github.io/iconsfont/linearicons.min.css" rel="stylesheet"/>
<style>
.icon-chiec-cap:before {
    content: "\e83a";
}
</style>
<nav class="gb-main-menu_ldpvinhome" >
    <div class="main-navigation uni-menu-text_ldpvinhome">
        <div class="cssmenu">
            <ul>
                <li>
                    <a href="/" class="slide-section <?= ($_GET['page']=='' || $_GET['page']=='tim-kiem-2') ? 'active-menu-pc' : '' ?>">
                        <p style="text-align: center;"><i class="fa icon-chiec-cap" aria-hidden="true" style=""></i></p>
                        <p>Tuyển gấp</p>
                    </a>
                </li>
                <li>
                    <a href="/tuyen-dung" class="<?= $_GET['page']=='tuyen-dung' || $_GET['page']=='tim-kiem' || $_GET['page']=='thong-tin-tuyen-dung' ? 'active-menu-pc' : '' ?>">
                        <p style="text-align: center;"><i class="fa icon-chiec-cap" aria-hidden="true" style=""></i></p>
                        <p>Tuyển nhanh</p>
                    </a>
                </li>
                <li>
                    <a href="/ung-vien-co-trinh-do" class="<?= $_GET['page']=='ung-vien-co-trinh-do' || $_GET['page']=='tim-kiem-ung-vien' || $ung_vien_active == 1 ? 'active-menu-pc' : '' ?>">
                        <p style="text-align: center;"><i class="fa icon-chiec-cap" aria-hidden="true" style=""></i></p>
                        <p>Ứng viên có trình độ</p>
                    </a>
                </li>
                <li>
                    <a href="/ung-vien-pho-thong" class="<?= $_GET['page']=='ung-vien-pho-thong' || $_GET['page']=='tim-kiem-ung-vien-1' || $ung_vien_active == 2 ? 'active-menu-pc' : '' ?>">
                        <p style="text-align: center;"><i class="fa icon-chiec-cap" aria-hidden="true" style=""></i></p>
                        <p>Ứng viên phổ thông</p>
                    </a>
                </li>
                <?php  if (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 1) { ?>
                <li class="has-sub  has-sub-tencty" style="width: 140px;"><a href="/dang-ky-nha-tuyen-dung">
                    <img src="/images/<?= $info['image']!='' ? $info['image'] : 'no-photo.png' ?>" alt="" style="width: 15%;height: 20.69px;position: absolute;top: 6px;    margin-left: 3%;border-radius: 50%;border: 2px solid #fff;">
                    <p style="margin-left: 25%;"><?= $action->getDetail('nha_tuyen_dung', 'id', $_SESSION['user_id_gbvn'])['company'] ?></p>
                    </a>

                <?php } elseif (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 2) { ?>
                <li class="has-sub  has-sub-tencty" style="width: 140px;"><a href="/dang-ky-ung-vien-pho-thong">
                    <img src="/images/<?= $info['image']!='' ? $info['image'] : 'no-photo.png' ?>" alt="" style="width: 15%;height: 20.69px;position: absolute;top: 6px;    margin-left: 3%;border-radius: 50%;border: 2px solid #fff;">
                    <p style="margin-left: 25%;"><?= $_SESSION['user_name_gbvn'] ?></p></a>
                <?php } else { ?>
                <li class="has-sub">
                    <a href="/">
                        <p style="text-align: center;"><i class="fa icon-chiec-cap" aria-hidden="true" style=""></i></p>
                        <p>Tài khoản</p>
                    </a>
                <?php } ?>
                    <ul>
                        <?php if (!isset($_SESSION['user_id_gbvn'])) { ?>
                        <li><a href="/dang-ky">Đăng ký</a></li>
                        <li class="has-sub"><a href="/dang-nhap">Đăng nhập</a></li>
                        <li><a href="/bao-gia">Mua tin</a></li>
                        <?php } ?>
                        <?php if (isset($_SESSION['user_id_gbvn'])) { ?>
                            <?php if ($_SESSION['user_type_gbvn'] == 1) { ?>
                            <!-- <li><a href="/mua-diem">Mua điểm</a></li> -->
                            <!-- <li><a href="/bang-gia">Bảng giá</a></li> -->
                            <li><a href="/trang-quan-ly">Trang quản lý</a></li>
                            <li><a href="/dang-ky-nha-tuyen-dung">Đăng tin mới</a></li>
                            <?php } ?>
                        <li><a href="/dang-xuat">Đăng xuất</a></li>
                        <?php } else { ?>
                        <?php } ?>

                    </ul>
                </li>
                <li class="has-sub">
                    <a href="/">
                        <p style="text-align: center;"><i class="fa icon-chiec-cap" aria-hidden="true" style=""></i></p>
                        <p>Toàn quốc</p>
                    </a>
                    <ul>
                        <li><a href="/mien-bac">Miền Bẵc</a></li>
                        <li><a href="/mien-nam">Miền Nam</a></li>
                        
                        <li><a href="/tin-tuc">Tin tức</a></li>
                    </ul>
                </li>
                <!-- <li><a href="/bao-gia" class="<?= $_GET['page']=='bao-gia' ? 'active-menu-pc' : '' ?>">Mua tin</a></li> -->
                <li>
                    <a href="/dang-ky" class="<?= $_GET['page']=='dang-ky' ? 'active-menu-pc' : '' ?>">
                        <p style="text-align: center;"><i class="fa icon-chiec-cap" aria-hidden="true" style=""></i></p>
                        <p>Đăng tin</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script src="/plugin/sticky/jquery.sticky.js"></script>
<script>
    $(document).ready(function () {
        var headerHeight = $('.gb-main-menu_ldpvinhome').outerHeight();

        $('.slide-section').click(function () {
            var linkHref = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(linkHref).offset().top - headerHeight
            }, 1000);
            e.preventDefault();
        });

        $(".sticky-menu").sticky({topSpacing:0});
    });
</script>