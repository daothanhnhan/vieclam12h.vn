<?php 
	$action_email = new action_email();
	echo '<pre>';
	$lien_he = $action_email->email_send('truongquangtuan3110@gmail.com', 'tieu de', 'Nội dung', 3);
?>
<?php 
	// $sql = "SELECT * FROM ho_so";
	// $result = mysqli_query($conn_vn, $sql);
	// while ($row = mysqli_fetch_assoc($result)) {
	// 	$carrer = explode(',', $row['item']);
	// 	$carrer = json_encode($carrer);
	// 	$id = $row['id'];

	// 	$sql1 = "UPDATE ho_so SET item = '$carrer' WHERE id = $id";//echo$sql1;
	// 	// $result1 = mysqli_query($conn_vn, $sql1);
	// }
?>