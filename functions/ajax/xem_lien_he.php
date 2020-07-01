<?php 
	session_start();

	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";
	$action = new action();
	
	$id = $_GET['id'];
	$ntd_id = $_SESSION['user_id_gbvn'];
	$ntd = $action->getDetail('nha_tuyen_dung', 'id', $ntd_id);
	$diem = $ntd['diem'];
	$xem_hoso = $ntd['xem_ho_so'];

	$ung_vien = $action->getDetail('ung_vien', 'id', $id);
	$ho_so = $action->getDetail('ho_so', 'ung_vien_id', $ung_vien['id']);
	$kinh_nghiem = $ho_so['experience'];

	if ($kinh_nghiem > 3) {
		$tru = 3;
	} else {
		$tru = 2;
	}

	if ($diem < $tru) {
		echo 'no';die;
	}

	$diem = $diem - $tru;
    $sql = "UPDATE nha_tuyen_dung SET diem = $diem WHERE id = $ntd_id";
    $result = mysqli_query($conn_vn, $sql);
    $xem_hoso++;
    $sql = "UPDATE nha_tuyen_dung SET xem_ho_so = $xem_hoso WHERE id = $ntd_id";
    // $result = mysqli_query($conn_vn, $sql);
?>
<h3 class="heading-title-vieclam" style="color: #fff;">Thông tin liên hệ</h3>
<div class="col-md-7">
                            <ul>
                                <li><strong style="color: #fff;">Người liên hệ:</strong> <span style="color: #ffce45; font-weight: bold; font-size:16px;"><?= $ung_vien['name'] ?></span></li>
                                <li style="color: #fff;"><strong>Ngày sinh:</strong> <!-- <?= $ung_vien['birthday'] ?> --><?= date('d/m/Y', strtotime($ung_vien['birthday'])) ?></li>
                                <li style="color: #fff;"><strong>Địa chỉ:</strong> <?= $ho_so['address'] ?></li>
                                
                            </ul>
                        </div>
                        <div class="col-md-5">
                            <ul>
                                <li><strong style="color: #fff; font-size: 14px;">SĐT:</strong> <span style="color: #ffce45;font-size: 16px; font-weight: bold;"><?= $ung_vien['phone'] ?></span></li>
                                <li><strong style="color: #fff;">Email:</strong> <span style="color: #fff;"><?= $ung_vien['email'] ?></span></li>
                                <!-- <li style="color: #fff;"><strong>Ngày tạo hồ sơ:</strong> <?= date('d/m/Y', strtotime($ho_so['created_at'])) ?> </li> -->
                                <?php if ($ho_so['cv']!='') { ?>
                                <li style="color: #fff;"><strong>CV: <span style="color: #fff; font-weight: 300;">Tải xuống</span></strong>
                                    
                                    <a href="/images/cv/<?= $ho_so['cv'] ?>" download=""> <i class="fa fa-download" aria-hidden="true"></i></a>
                                    
                                </li>
                                <?php } ?>
                                <li><strong></strong></li>
                            </ul>
                        </div>
                        <div style="clear: both;">
                            
                        </div>