<?php 
	session_start();
	include_once dirname(__FILE__) . "/../database.php";

	$email = $_GET['email'];
	$pass  = $_GET['pass'];

	$sql = "SELECT * FROM nha_tuyen_dung Where email = '$email' Or phone = '$email'";
    $result = mysqli_query($conn_vn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 0) {
        $ok = 'false';
    } else {
        $row = mysqli_fetch_assoc($result);
        $pass_hash = $row['password'];
        if (password_verify($pass, $pass_hash)) {
	        $_SESSION['user_id_gbvn'] = $row['id'];
	        $_SESSION['user_email_gbvn'] = $row['email'];
	        $_SESSION['user_name_gbvn'] = $row['company'];
	        $_SESSION['user_type_gbvn'] = 1;
	        $ok = 'true';
        } else {
          	$ok = 'false';
        }
    }
    echo $ok;
?>