<?php 
	include_once dirname(__FILE__) . "/../database.php";
	$id = $_GET['id'];

	$sql = "DELETE FROM ho_so_da_luu WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
?>