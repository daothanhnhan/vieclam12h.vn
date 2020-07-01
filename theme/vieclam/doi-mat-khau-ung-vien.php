<?php 
	if (!isset($_GET['trang'])) {
		header('location: /');
	}

	function doi_pass ($id) {
		global $conn_vn;
		if (isset($_POST['doi'])) {
			$pass1 = $_POST['pass1'];
			$pass2 = $_POST['pass2'];

			if ($pass1 != $pass2) {
				echo '<script>alert(\'Mật khẩu không khớp.\');</script>';
				return false;
			}

			$pass = password_hash(trim($pass1), PASSWORD_DEFAULT);
			$sql = "UPDATE ung_vien SET password = '$pass' WHERE id = $id";

			$result = mysqli_query($conn_vn, $sql);
			if ($result) {
				echo '<script>alert(\'Đổi mật khẩu thành công.\');</script>';
			} else {
				echo '<script>alert(\'Có lỗi xảy ra.\');</script>';
			}
		}
	}
	doi_pass($_GET['trang']);
?>
<div class="container" style="margin-bottom: 200px;margin-top: 90px;">
	<div class="row">
		
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<h1 style="font-size: 30px;margin-bottom: 20px;">Đổi mật khẩu ứng viên</h1>
			<form action="" method="post">
			  
			  <div class="form-group">
			    <label for="pwd1">Mật khẩu:</label>
			    <input type="password" class="form-control" id="pwd1" name="pass1" required="">
			  </div>
			  <div class="form-group">
			    <label for="pwd2">Nhập lại mật khẩu:</label>
			    <input type="password" class="form-control" id="pwd2" name="pass2" required="">
			  </div>
			  
			  <button type="submit" name="doi" class="btn btn-default">Đổi mật khẩu</button>
			</form>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>