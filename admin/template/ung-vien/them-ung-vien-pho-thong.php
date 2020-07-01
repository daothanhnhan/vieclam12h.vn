<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	
	$message = '';
	function ung_vien () {
		global $message;
        global $conn_vn;
        if (isset($_POST['ungvien'])) {
            $src= "../images/";
            $image = '';

            if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
                $image = time().$_FILES['image']['name'];
                uploadPicture($src, $image, $_FILES['image']['tmp_name']);
            }

            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $born = $_POST['born'];
            $birthday = $_POST['birthday'];
            $sex = $_POST['sex'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $check = 'true';

            $time = date("Y-m-d H:i:s");

            if ($email != '') {
                // Check email isset
                $sql_email = "SELECT * FROM ung_vien Where email = '$email'";
                $result_email = mysqli_query($conn_vn, $sql_email);
                $row_email = mysqli_num_rows($result_email);

                if ($row_email > 0) {
                    $check = "false";
                    $message .= "<div class='alert alert-danger'>Email đã tồn tại</div>";
                }
            }
            

            // Check phone isset
            $sql_phone = "SELECT * FROM ung_vien Where phone = '$phone'";
            $result_phone = mysqli_query($conn_vn, $sql_phone);
            $row_phone = mysqli_num_rows($result_phone);

            if ($row_phone > 0) {
                $check = "false";
                $message .= "<div class='alert alert-danger'>Số điện thoại đã tồn tại</div>";
            }

            if ($pass1 != $pass2) {
                $check = "false";
                $message .= "<div class='alert alert-danger'>Mật khẩu không khớp</div>";
            }

            if ($check == "true") {
                $pass = password_hash($pass1, PASSWORD_DEFAULT);
                $sql = "INSERT INTO ung_vien (name, email, phone, born, birthday, sex, password, type, image, `time`) VALUES ('$name', '$email', '$phone', '$born', '$birthday', $sex, '$pass', 1, '$image', '$time')";
                $result = mysqli_query($conn_vn, $sql);
                if ($result) {
                    echo '<script type="text/javascript">alert(\'Bạn đã tạo ứng viên thành công!\');window.location.href="index.php?page=ung-vien-pho-thong"</script>';
                } else {
                    echo '<script type="text/javascript">alert(\'Có lỗi xảy ra!\')</script>';
                }
            }
        }
	}

	ung_vien();
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin ứng viên<br /><br /></p>   
            <p class="subLeftNCP"><a href="index.php?page=ung-vien-pho-thong">Quay lại</a><br /><br /></p>  
                    
        </div>
        <div class="boxNodeContentPage">
        	<?= $message ?>
            <p class="titleRightNCP">Họ và tên</p>
            <input type="text" class="txtNCP1" name="name" required/>
            <p class="titleRightNCP">Ngày sinh</p>
            <input type="date" class="txtNCP1" name="birthday" required/>
            <p class="titleRightNCP">Điện thoại</p>
            <input type="tel" class="txtNCP1" name="phone" required/>
            <p class="titleRightNCP">Nơi sinh</p>
            <input type="text" class="txtNCP1" name="born" required/>
            <p class="titleRightNCP">Giới tính</p>
            <select name="sex" class="txtNCP1" required>
            	<option value="">Chọn giới tính</option>
            	<option value="1">Nam</option>
            	<option value="0">Nữ</option>
            </select>
            <p class="titleRightNCP">Ảnh đại diện</p>
            <input type="file" class="txtNCP1" name="image" />
            <p class="titleRightNCP">Email</p>
            <input type="email" class="txtNCP1" name="email" />
            <p class="titleRightNCP">Mật khẩu</p>
            <input type="password" class="txtNCP1" name="pass1" required/>
            <p class="titleRightNCP">Xác nhận mật khẩu</p>
            <input type="password" class="txtNCP1" name="pass2" required/>
            
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="ungvien">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ GoldBridge Việt Nam</p>