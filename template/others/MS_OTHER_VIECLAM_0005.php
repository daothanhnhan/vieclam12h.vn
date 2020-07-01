<?php 
	if (!isset($_SESSION['user_id_gbvn']) || $_SESSION['user_type_gbvn']!=1) {
		header('location: /');
	}

	$ntd = $action->getDetail('nha_tuyen_dung', 'id', $_SESSION['user_id_gbvn']);

	$list_don_tuyen = $action->getList('thong_tin_tuyen_dung', 'nha_tuyen_dung_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
    $list_ung_vien = $action->getList('ung_tuyen', 'nha_tuyen_dung_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
    $book_diem = $action->getList('book_diem', 'nha_tuyen_dung_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
    $book_home_time = $action->getList('book_home_time', 'ntd_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
    $book_tuyen_time = $action->getList('book_tuyen_time', 'ntd_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
    $ho_so_da_luu = $action->getList('ho_so_da_luu', 'nha_tuyen_dung_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
?>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<style>
@media screen and (max-width: 991px) {
    .img-logo-ntd-ql {
        height: 37px !important;
    }
    .box-img-logo-ntd-ql {
        text-align: center;
    }
    .box-text-info-ntd-ql .name-info-ntd-ql {
        font-size: 15px !important;
    }
    .box-ho-so-da-luu {
        margin-top: 10px;
    }
    .box-tin-da-dang {
        margin-bottom: 10px;
    }
    .box-ho-so-ung-tuyen {
        margin-bottom: 10px;
    }
    .box-luot-xem-ho-so {
        margin-bottom: 10px;
    }
    .box-ho-so-da-luu > div > a > h2 {
        margin-top: 39px !important;
    }
    .box-tin-da-dang > div > a > h2 {
        margin-top: 39px !important;
    } 
    .box-ho-so-ung-tuyen > div > a > h2 {
        margin-top: 39px !important;
    } 
    .box-luot-xem-ho-so > div > h2 {
        margin-top: 39px !important;
    } 
    .box-so-lam-moi > div > h2 {
        margin-top: 39px !important;
    } 
}

</style>
<div class="container" style="margin-top: 32px;">
	<div class="row">
		
        <div class="col-md-9" style="background: #d55c58;border-radius: 9px;">
            <div class="row">
            <div class="col-md-3 box-img-logo-ntd-ql">
                <div style="padding: 10px;border: 3px solid #fff;border-radius: 18px;margin: 7px;display: inline-block;">
                    <img src="/images/<?= $ntd['image'] ?>" alt="" style="height: 100px;" class="img-logo-ntd-ql">
                </div>
            </div>
            <div class="col-md-9 box-text-info-ntd-ql">
                <div style="padding: 10px;color: #fff;">
                    <h2 class="name-info-ntd-ql" style="font-size: 20px;text-transform: uppercase;"><?= $ntd['company'] ?></h2>
                    <h2 style="color: #ffce45;font-size: 20px;">Mã tin: (00<?= $ntd['id'] ?>)</h2>
                    <h2><a href="/mua-diem" style="color: #ffce45;font-size: 20px;">Điểm: <?= $ntd['see']==1 ? $ntd['diem'] : '' ?></a></h2>
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-3 box-ho-so-da-luu">
            <div style="background: #fdfafa;padding: 10px;border-radius: 12px;">
                <a href="/ho-so-da-luu" title="" style="color: #000;">
                    <div class="col-xs-6">
                        <i class='fa fa-floppy-o' style="font-size: 25px;"></i>
                    </div>
                    <div class="col-xs-6">
                        <h2 style="font-size: 25px;text-align: right;"><?= count($ho_so_da_luu) ?></h2>
                    </div>
                    <h2 style="text-align: center;margin-top: 60px;text-transform: uppercase;clear: both;">Hồ sơ đã lưu</h2>
                    </a>
                </div>
        </div>
	</div>
    
</div>
<div class="container" style="margin-top: 28px;">
        <div class="row">
            
            <div class="col-md-3 box-tin-da-dang">
                <div style="background: #b5a9a9;padding: 10px;border-radius: 12px;">
                    <a href="/viec-lam-da-dang" title="" style="color: #000;">
                    <div class="col-xs-6">
                        <i class='fas fa-pencil-alt' style="font-size: 25px;"></i>
                    </div>
                    <div class="col-xs-6">
                        <h2 style="font-size: 25px;text-align: right;"><?= count($list_don_tuyen) ?></h2>
                    </div>
                    <h2 style="text-align: center;margin-top: 60px;text-transform: uppercase;clear: both;">Tin đã đăng</h2>
                    </a>
                </div>
            </div>
            <div class="col-md-3 box-ho-so-ung-tuyen">
                <div style="background: #a9f5ee;padding: 10px;border-radius: 12px;">
                    <a href="/ho-so-ung-tuyen" title="" style="color: #000;">
                    <div class="col-xs-6">
                        <i class='far fa-sticky-note' style="font-size: 25px;"></i>
                    </div>
                    <div class="col-xs-6">
                        <h2 style="font-size: 25px;text-align: right;"><?= count($list_ung_vien) ?></h2>
                    </div>
                    <h2 style="text-align: center;margin-top: 60px;text-transform: uppercase;clear: both;">Hồ sơ ứng tuyển</h2>
                    </a>
                </div>
            </div>
            <div class="col-md-3 box-luot-xem-ho-so">
                <div style="background: #d8b685;padding: 10px;border-radius: 12px;">
                    <div class="col-xs-6">
                        <i class="fa fa-eye" aria-hidden="true" style="font-size: 25px;"></i>
                    </div>
                    <div class="col-xs-6">
                        <h2 style="font-size: 25px;text-align: right;"><?= $ntd['xem_ho_so'] ?></h2>
                    </div>
                    <h2 style="text-align: center;margin-top: 60px;text-transform: uppercase;clear: both;">Lượt xem hồ sơ</h2>
                </div>
            </div>
            <div class="col-md-3 box-so-lam-moi">
                <div style="background: #c1e09d;padding: 10px;border-radius: 12px;">
                    <div class="col-xs-6">
                        <i class='fas fa-sync-alt' style="font-size: 25px;"></i>
                    </div>
                    <div class="col-xs-6">
                        <h2 style="font-size: 25px;text-align: right;"><?= $ntd['lam_moi'] ?></h2>
                    </div>
                    <h2 style="text-align: center;margin-top: 60px;text-transform: uppercase;clear: both;">Số làm mới</h2>
                </div>
            </div>

        </div>

        
    </div>

    

    

    <div class="container" style="display: none;">
        <div style="margin-top: 20px;">
            <h2 style="text-transform: uppercase;font-size: 20px;color: #fecc39;">Các gói đã mua</h2>
            <table class="table table-striped">
                <thead>
                  <tr style="background: #5ac18f;">
                    <th>Tên gói</th>
                    <th>Giá</th>
                    <th>Kích hoạt</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                foreach ($book_diem as $item) { 
                    $goi = $action->getDetail('goi_diem', 'id', $item['goi_diem_id']);
                ?>
                  <tr>
                    <td>Điểm</td>
                    <td><?= number_format($goi['gia']) ?> đ</td>
                    <td><?= $item['state']==0 ? 'Chưa kích hoạt' : 'Đã kích hoạt' ?></td>
                  </tr>
                <?php } ?>
                <?php 
                foreach ($book_home_time as $item) { 
                    $goi = $action->getDetail('bang_gia_3', 'id', $item['home_time_id']);
                ?>
                  <tr>
                    <td>Hiện ở trang chủ</td>
                    <td><?= number_format($goi['price']) ?> đ</td>
                    <td><?= $item['state']==0 ? 'Chưa kích hoạt' : 'Đã kích hoạt' ?></td>
                  </tr>
                <?php } ?>
                <?php 
                foreach ($book_tuyen_time as $item) { 
                    $goi = $action->getDetail('bang_gia_4', 'id', $item['tuyen_time_id']);
                ?>
                  <tr>
                    <td>Hiện ở trang tuyển</td>
                    <td><?= number_format($goi['price']) ?> đ</td>
                    <td><?= $item['state']==0 ? 'Chưa kích hoạt' : 'Đã kích hoạt' ?></td>
                  </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container">
        <img src="/images/<?= $rowConfig['banner6'] ?>" style="width: 100%;margin-bottom: 20px;margin-top: 26px;">
    </div>
