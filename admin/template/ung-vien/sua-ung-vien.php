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
	function ung_vien ($id) {
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
            $born = '';
            $birthday = $_POST['birthday'];
            $sex = $_POST['sex'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $check = 'true';

            if ($pass1 != $pass2) {
                $check = "false";
                $message .= "<div class='alert alert-danger'>Mật khẩu không khớp</div>";
            }

            if ($check == "true") {
                if ($pass1 != '' && $pass2 != '') {
                    $pass = password_hash($pass1, PASSWORD_DEFAULT);
                    if ($image == '') {
                        $sql = "UPDATE ung_vien SET name = '$name', phone = '$phone', born = '$born', birthday = '$birthday', sex = $sex, password = '$pass' WHERE id = $id";
                    } else {
                        $sql = "UPDATE ung_vien SET name = '$name', phone = '$phone', born = '$born', birthday = '$birthday', sex = $sex, image = '$image', password = '$pass' WHERE id = $id";
                    }
                } else {
                    if ($image == '') {
                        $sql = "UPDATE ung_vien SET name = '$name', phone = '$phone', born = '$born', birthday = '$birthday', sex = $sex WHERE id = $id";
                    } else {
                        $sql = "UPDATE ung_vien SET name = '$name', phone = '$phone', born = '$born', birthday = '$birthday', sex = $sex, image = '$image' WHERE id = $id";
                    }
                }
                $result = mysqli_query($conn_vn, $sql);
                if ($result) {
                    echo '<script type="text/javascript">alert(\'Bạn đã sửa ứng viên thành công!\')</script>';
                } else {
                    echo '<script type="text/javascript">alert(\'Có lỗi xảy ra!\')</script>';
                }
            }
        }
	}

	ung_vien($_GET['id']);

    $info = $action->getDetail('ung_vien', 'id', $_GET['id']);
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin thương hiệu<br /><br /></p>     
            <?php if ($info['type']==0) { ?>
            <p class="subLeftNCP"><a href="index.php?page=ung-vien-co-trinh-do">Quay lại</a><br /><br /></p>
            <?php } else { ?>
            <p class="subLeftNCP"><a href="index.php?page=ung-vien-pho-thong">Quay lại</a><br /><br /></p>
            <?php } ?>
                    
        </div>
        <div class="boxNodeContentPage">
        	<?= $message ?>
            <p class="titleRightNCP">Họ và tên</p>
            <input type="text" class="txtNCP1" name="name" value="<?= $info['name'] ?>" required/>
            <p class="titleRightNCP">Ngày sinh</p>
            <input type="date" class="txtNCP1" name="birthday" value="<?= $info['birthday'] ?>" required/>
            <p class="titleRightNCP">Điện thoại</p>
            <input type="number" class="txtNCP1" name="phone" value="<?= $info['phone'] ?>" readonly/>
            <!-- <p class="titleRightNCP">Nơi sinh</p>
            <input type="text" class="txtNCP1" name="born" value="<?= $info['born'] ?>" required/> -->
            <p class="titleRightNCP">Giới tính</p>
            <select name="sex" class="txtNCP1" required>
            	<option value="">Chọn giới tính</option>
            	<option value="1" <?= $info['sex']==1 ? 'selected' : '' ?> >Nam</option>
            	<option value="0" <?= $info['sex']==0 ? 'selected' : '' ?> >Nữ</option>
            </select>
            <p class="titleRightNCP">Ảnh đại diện</p>
            <input type="file" class="txtNCP1" name="image" />
            <img src="/images/<?= $info['image']=='' ? 'no-photo.png' : $info['image'] ?>" alt="" width="100">
            <p class="titleRightNCP">Email</p>
            <input type="email" class="txtNCP1" name="email" value="<?= $info['email'] ?>" readonly />
            <p class="titleRightNCP">Mật khẩu</p>
            <input type="password" class="txtNCP1" name="pass1" />
            <p class="titleRightNCP">Xác nhận mật khẩu</p>
            <input type="password" class="txtNCP1" name="pass2" />
            
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="ungvien">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ GoldBridge Việt Nam</p>