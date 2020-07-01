<?php 
	session_start();
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";
	$action = new action();

	$id = $_GET['id'];
	$now = date('Y-m-d H:i:s');
	$ntd = $action->getDetail('nha_tuyen_dung', 'id', $_SESSION['user_id_gbvn']);
	$ntd_id = $ntd['id'];

	$sql = "UPDATE thong_tin_tuyen_dung SET `time` = '$now' WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);

	$lam_moi = $ntd['lam_moi'];
	$lam_moi++;
	$sql = "UPDATE nha_tuyen_dung SET lam_moi = $lam_moi WHERE id = $ntd_id";
	$result = mysqli_query($conn_vn, $sql);
?>