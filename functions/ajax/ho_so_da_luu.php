<?php 
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";
	$action = new action();

	$id = $_GET['id'];
	$ung_tuyen = $action->getDetail('ung_tuyen', 'id', $id);
	$ntd_id = $ung_tuyen['nha_tuyen_dung_id'];
	$uv_id = $ung_tuyen['ung_vien_id'];
	$don_tuyen_id = $ung_tuyen['thong_tin_tuyen_dung_id'];

	$sql = "SELECT * FROM ho_so_da_luu WHERE nha_tuyen_dung_id = $ntd_id AND ung_vien_id = $uv_id AND thong_tin_tuyen_dung_id = $don_tuyen_id";
	$result = mysqli_query($conn_vn, $sql);
	$num = mysqli_num_rows($result);//echo $sql;die;

	if ($num > 0) {
		echo 'Hồ sơ đã lưu.';die;
	}

	$ngay = date('Y-m-d');
	$sql = "INSERT INTO ho_so_da_luu (nha_tuyen_dung_id, ung_vien_id, thong_tin_tuyen_dung_id, ngay) VALUES ($ntd_id, $uv_id, $don_tuyen_id, '$ngay')";
	$result = mysqli_query($conn_vn, $sql);

	if ($result) {
		echo 'Bạn đã lưu hồ sơ thành công.';
	} else {
		echo 'Có lỗi xảy ra.';
	}
?>