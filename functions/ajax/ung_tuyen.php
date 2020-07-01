<?php 
	include dirname(__FILE__) . "/../database.php";
	$don = $_GET['don'];
	$tuyen = $_GET['tuyen'];
	$ung = $_GET['ung'];

	$sql = "INSERT INTO ung_tuyen (nha_tuyen_dung_id, ung_vien_id, thong_tin_tuyen_dung_id) VALUES ($tuyen, $ung, $don)";
    $result = mysqli_query($conn_vn, $sql);
?>