<?php 
	$id = $_GET['id'];
	$sql = "SELECT * FROM ung_vien WHERE id = $id";
	$result1 = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_assoc($result1);
	$type = $row['type'];

	$sql = "DELETE FROM ung_vien WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);

	$sql = "DELETE FROM ho_so WHERE ung_vien_id = $id";
	$result = mysqli_query($conn_vn, $sql);
	if ($type == 0) {
		header('location: index.php?page=ung-vien-co-trinh-do');
	} else {
		header('location: index.php?page=ung-vien-pho-thong');
	}
	
?>