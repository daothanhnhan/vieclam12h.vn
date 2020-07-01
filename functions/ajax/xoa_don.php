<?php 
	include_once dirname(__FILE__) . "/../database.php";
	$id = $_GET['id'];

	$sql = "DELETE FROM thong_tin_tuyen_dung WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
?>