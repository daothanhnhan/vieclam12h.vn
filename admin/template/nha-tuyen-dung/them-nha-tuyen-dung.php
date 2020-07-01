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

	function nha_tuyen_dung () {
		global $message;
        global $conn_vn;
        if (isset($_POST['dangky'])) {
            $src= "../images/";
            $image = '';

            if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
                $image = time().$_FILES['image']['name'];
                uploadPicture($src, $image, $_FILES['image']['tmp_name']);
            }

            $company = $_POST['company'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $check = 'true';

            // Check email isset
            $sql_email = "SELECT * FROM nha_tuyen_dung Where email = '$email'";
            $result_email = mysqli_query($conn_vn, $sql_email);
            $row_email = mysqli_num_rows($result_email);

            if ($row_email > 0) {
                $check = "false";
                $message .= "<div class='alert alert-danger'>Email đã tồn tại</div>";
            }

            // Check phone isset
            $sql_phone = "SELECT * FROM nha_tuyen_dung Where phone = '$phone'";
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
                $sql = "INSERT INTO nha_tuyen_dung (company, name, email, phone, address, password, image) VALUES ('$company', '$name', '$email', '$phone', '$address', '$pass', '$image')";
                $result = mysqli_query($conn_vn, $sql);
                if ($result) {
                    echo '<script type="text/javascript">alert(\'Bạn đã tạo nhà tuyển dụng thành công!\');window.location.href="index.php?page=nha-tuyen-dung"</script>';
                } else {
                    echo '<script type="text/javascript">alert(\'Có lỗi xảy ra!\')</script>';
                }
            }
        }
	}

	nha_tuyen_dung();
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin nhà tuyển dụng<br /><br /></p>     
            <p class="subLeftNCP"><a href="index.php?page=nha-tuyen-dung">Quay lại</a><br /><br /></p>
                    
        </div>
        <div class="boxNodeContentPage">
        	<?= $message ?>
            <p class="titleRightNCP">Tên công ty</p>
            <input type="text" class="txtNCP1" name="company" required/>
            <p class="titleRightNCP">Địa chỉ</p>
            <input type="text" class="txtNCP1" name="address" required/>
            <p class="titleRightNCP">Điện thoại</p>
            <input type="tel" class="txtNCP1" name="phone" required/>
            <p class="titleRightNCP">Người liên hệ</p>
            <input type="text" class="txtNCP1" name="name" required/>
            <p class="titleRightNCP">Ảnh đại diện</p>
            <input type="file" class="txtNCP1" name="image" />
            <p class="titleRightNCP">Email</p>
            <input type="email" class="txtNCP1" name="email" required/>
            <p class="titleRightNCP">Mật khẩu</p>
            <input type="password" class="txtNCP1" name="pass1" required/>
            <p class="titleRightNCP">Xác nhận mật khẩu</p>
            <input type="password" class="txtNCP1" name="pass2" required/>
            
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="dangky">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ GoldBridge Việt Nam</p>