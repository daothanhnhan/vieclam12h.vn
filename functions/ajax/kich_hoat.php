<?php 
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";
	$action = new action();

	$id = $_GET['id'];
	// echo $id;

	$sql = "SELECT * FROM book_diem WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_assoc($result);
	$state = $row['state'];

	if ($state == 1) {
		echo 'Đã kích hoạt gói mua.';
	} else {
		$ntd = $action->getDetail('nha_tuyen_dung', 'id', $row['nha_tuyen_dung_id']);
		$ntd_id = $ntd['id'];
		$ntd_diem = $ntd['diem'];

		$goi_diem = $action->getDetail('goi_diem', 'id', $row['goi_diem_id']);
		$diem = $goi_diem['diem'];
		

		$tong_diem = $ntd_diem + $diem;

		$sql = "UPDATE nha_tuyen_dung SET diem = $tong_diem WHERE id = $ntd_id";
		$result = mysqli_query($conn_vn, $sql);

		$sql = "UPDATE book_diem SET state = 1 WHERE id = $id";
		$result = mysqli_query($conn_vn, $sql);

		if ($result) {
			echo 'Bạn đã kích hoạt thành công.';
		} else {
			echo 'Có lỗi rảy ra.';
		}
	}
?>