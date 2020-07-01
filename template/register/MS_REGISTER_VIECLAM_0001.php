<style>
.gb-m-info-account-a {
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    margin-left: 1%;
}
</style>
<div class="gb-dangnhapdangky-vieclam">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="row gb-dangnhapdangky-vieclam-boder">
                    <div class="col-sm-6 col-xs-12 clear-padding-right ptd_edit_home_resi" style="display: <?= isset($_SESSION['user_id_gbvn']) ? '' : 'none'; ?>">
                        <div class="gb-dangnhapdangky-vieclam-item dangnhap-vieclam " style="background: #19a05e;">
                            <?php  if (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 1) { ?>
                            <a href="/dang-ky-nha-tuyen-dung" title="" class="gb-m-info-account-a"><img src="/images/<?= $info['image']!='' ? $info['image'] : 'no-photo.png' ?>" alt="" style="height: 24.69px;position: relative;right: 2px;top: 5px;border-radius: 50%;border: 2px solid #fff;"><?= substr($action->getDetail('nha_tuyen_dung', 'id', $_SESSION['user_id_gbvn'])['company'], 0, 26) ?></a>
                            <?php } elseif (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 2) { ?>
                            <a href="/dang-ky-ung-vien-pho-thong" title="" class="gb-m-info-account-a"><img src="/images/<?= $info['image']!='' ? $info['image'] : 'no-photo.png' ?>" alt="" style="height: 24.69px;position: relative;right: 2px;top: 5px;border-radius: 50%;border: 2px solid #fff;"><?= $_SESSION['user_name_gbvn'] ?></a>
                            <?php } else { ?>
                            <a href="/">Tài khoản</a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php  if (!isset($_SESSION['user_id_gbvn'])) { ?>
                    <div class="col-sm-6 col-xs-6 clear-padding-right ptd_edit_home_resi_item hidden-md hidden-lg">
                        <div class="gb-dangnhapdangky-vieclam-item dangnhap-vieclam" style="border-radius: 10px;">
                            <a href="/dang-nhap">
                                <!-- <i class="fa fa-lock" aria-hidden="true"></i> -->
                             Đăng nhập</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6 ptd_edit_home_resi_item hidden-md hidden-lg">
                        <div class="gb-dangnhapdangky-vieclam-item dangky-vieclam " style="border-radius: 10px;">
                            <a href="/dang-ky">
                                <!-- <i class="fa fa-gg" aria-hidden="true"></i> -->
                                 Đăng ký
                             </a>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="col-sm-6 col-xs-6 ptd_edit_home_resi_item hidden-md hidden-lg">
                        <div class="gb-dangnhapdangky-vieclam-item dangky-vieclam " style="border-radius: 10px;">
                            <a href="/dang-xuat">
                                <!-- <i class="fa fa-gg" aria-hidden="true"></i> -->
                                 Đăng xuất
                             </a>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="col-sm-2 clear-padding-right ptd_edit_home_resi_item hidden-xs hidden-sm">
                        <div class="gb-dangnhapdangky-vieclam-item dangnhap-vieclam" style="border-radius: 10px;width: 50%;margin-left: auto;">
                            <a href="/dang-nhap">
                                <!-- <i class="fa fa-lock" aria-hidden="true"></i> -->
                             Đăng nhập</a>
                        </div>
                    </div>
                    <div class="col-sm-2 ptd_edit_home_resi_item hidden-xs hidden-sm">
                        <div class="gb-dangnhapdangky-vieclam-item dangky-vieclam " style="border-radius: 10px;width: 50%;margin-right: auto;">
                            <a href="/dang-ky">
                                <!-- <i class="fa fa-gg" aria-hidden="true"></i> -->
                                 Đăng ký
                             </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>