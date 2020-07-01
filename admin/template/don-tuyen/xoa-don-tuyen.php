<?php 
	$id = $_GET['id'];
	$sql = "SELECT * FROM thong_tin_tuyen_dung WHERE id = $id";
	$result1 = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_assoc($result1);
	$nha_tuyen_dung_id = $row['nha_tuyen_dung_id'];

	$sql = "DELETE FROM thong_tin_tuyen_dung WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	header('location: index.php?page=don-tuyen&nha_tuyen_dung_id='.$nha_tuyen_dung_id);
?>