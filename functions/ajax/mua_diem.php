<?php 
	include_once dirname(__FILE__) . "/../database.php";
	$goi_id = $_GET['goi_id'];
	$ntd_id = $_GET['ntd_id'];

	$sql = "INSERT INTO book_diem (nha_tuyen_dung_id, goi_diem_id, state) VALUES ($ntd_id, $goi_id, 0)";
	$result = mysqli_query($conn_vn, $sql);
	// echo mysqli_error($conn_vn);
	if ($result) {
		echo 'Bạn đã đặt mua gói thành công.';
	} else {
		echo 'Có lỗi xảy ra.';
	}
?>
