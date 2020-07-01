<!--MENU MOBILE-->
<?php //include_once DIR_MENU."MS_MENU_VIECLAM_0002.php"; ?>
<!-- End menu mobile-->
<?php 
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
<!--MENU DESTOP-->
<header>
    <div class="gb-header-ruouvang sticky-menu">
        <div class="gb-header-between_ruouvang">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="gb-header-between_ruouvang-left">
                            <h1>
                                <a href="/"><img src="/images/<?= $rowConfig['web_logo'] ?>" alt="logo" class="img-responsive"></a>
                            </h1>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="gb-header-bottom_ruouvang">
                            <?php include DIR_MENU."MS_MENU_VIECLAM_0001.php";?>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 9px;">
                        <ul class="menu-mobile-spec" style="width: 100%;">
                            <li style="display: inline-block;width: 26%;"><a href="/" class="<?= $_GET['page']=='' || $_GET['page']=='tim-kiem-2' ? 'active-menu-mobile' : '' ?>">Tuyến gấp</a></li>
                            <li style="display: inline-block;width: 29%;"><a href="/tuyen-dung" class="<?= $_GET['page']=='tuyen-dung' || $_GET['page']=='tim-kiem' || $_GET['page']=='thong-tin-tuyen-dung' ? 'active-menu-mobile' : '' ?>">Tuyển nhanh</a></li>
                            
                            <li style="display: inline-block;width: 21%;"><a href="/trang-quan-ly" class="<?= $_GET['page']=='trang-quan-ly' ? 'active-menu-mobile' : '' ?>">Quản lý</a></li>
                            <!-- <li style="display: inline-block;width: 20%;"><a href="/bao-gia" class="<?= $_GET['page']=='bao-gia' ? 'active-menu-mobile' : '' ?>">Mua tin</a></li> -->
                            <li style="display: inline-block;width: 20%;"><a href="/dang-ky" class="<?= $_GET['page']=='dang-ky' ? 'active-menu-mobile' : '' ?>">Đăng tin</a></li>
                            
                        </ul>
                        <ul class="menu-mobile-spec" style="display: none;">
                            <li><a href="/ung-vien-co-trinh-do" class="<?= $_GET['page']=='ung-vien-co-trinh-do' ? 'active-menu-mobile' : '' ?>">Ứng viên có trình độ</a></li>
                            <li><a href="/ung-vien-pho-thong" class="<?= $_GET['page']=='ung-vien-pho-thong' ? 'active-menu-mobile' : '' ?>">Ứng viên phổ thông</a></li>
                        </ul>
                        <!-- <ul class="menu-mobile-spec">
                            <li><a href="/dang-ky">Tạo hồ sơ</a></li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div style="position: fixed;bottom: 0;left: 0;background: #1b91d1;z-index: 999;width: 100%;">
    <ul class="menu-mobile-spec" style="width: 100%;">
        <li style="display: inline-block;width: 55%;padding: 10px 0;"><a href="/ung-vien-co-trinh-do" style="margin-left: 10px;" class="<?= $_GET['page']=='ung-vien-co-trinh-do' || $_GET['page']=='tim-kiem-ung-vien' || $ung_vien_active == 1 ? 'active-menu-mobile' : '' ?>">Ứng viên có trình độ</a></li>
        <li style="display: inline-block;width: 43%;padding: 10px 0;"><a href="/ung-vien-pho-thong" class="<?= $_GET['page']=='ung-vien-pho-thong' || $_GET['page']=='tim-kiem-ung-vien-1' || $ung_vien_active == 2 ? 'active-menu-mobile' : '' ?>">Ứng viên phổ thông</a></li>
    </ul>
</div>

<script src="/plugin/sticky/jquery.sticky.js"></script>
<script>
    $(document).ready(function () {
        $(".sticky-menu").sticky({topSpacing:0});
    });
</script>