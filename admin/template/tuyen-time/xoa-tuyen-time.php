<?php 
	$id = $_GET['id'];
	$sql = "DELETE FROM bang_gia_4 WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	header('location: index.php?page=tuyen-time');
?>