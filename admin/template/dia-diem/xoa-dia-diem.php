<?php 
	$id = $_GET['id'];
	$sql = "DELETE FROM location WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	header('location: index.php?page=dia-diem');
?>