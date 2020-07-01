<?php 
	$id = $_GET['id'];
	$sql = "DELETE FROM thong_tin_tuyen_dung WHERE nha_tuyen_dung_id = $id";
	$result = mysqli_query($conn_vn, $sql);

	$sql = "DELETE FROM nha_tuyen_dung WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	header('location: index.php?page=nha-tuyen-dung');
?>