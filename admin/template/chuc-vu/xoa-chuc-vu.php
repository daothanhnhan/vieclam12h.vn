<?php 
	$id = $_GET['id'];
	$sql = "DELETE FROM office WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	header('location: index.php?page=chuc-vu');
?>