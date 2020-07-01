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

	function nha_tuyen_dung ($id) {
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
            $see = isset($_POST['see']) ? 1 : 0;
            $quy_mo = $_POST['quy_mo'];
            $website = $_POST['website'];
            $check = 'true';
            $diem = $_POST['diem'];

            $send_email = isset($_POST['send_email']) ? 1 : 0;

            if ($pass1 != $pass2) {
                $check = "false";
                $message .= "<div class='alert alert-danger'>Mật khẩu không khớp</div>";
            }

            if ($check == "true") {
                if ($pass1 != '' && $pass2 != '') {
                    $pass = password_hash($pass1, PASSWORD_DEFAULT);
                    if ($image == '') {
                        $sql = "UPDATE nha_tuyen_dung SET company = '$company', name = '$name', phone = '$phone', address = '$address', password = '$pass', see = $see, quy_mo = '$quy_mo', website = '$website', send_email = $send_email, diem = $diem WHERE id = $id";
                    } else {
                        $sql = "UPDATE nha_tuyen_dung SET company = '$company', name = '$name', phone = '$phone', address = '$address', password = '$pass', see = $see, quy_mo = '$quy_mo', website = '$website', send_email = $send_email, diem = $diem, image = '$image' WHERE id = $id";
                    }
                } else {
                    if ($image == '') {
                        $sql = "UPDATE nha_tuyen_dung SET company = '$company', name = '$name', phone = '$phone', address = '$address', see = $see, quy_mo = '$quy_mo', website = '$website', send_email = $send_email, diem = $diem WHERE id = $id";
                    } else {
                        $sql = "UPDATE nha_tuyen_dung SET company = '$company', name = '$name', phone = '$phone', address = '$address', see = $see, quy_mo = '$quy_mo', website = '$website', send_email = $send_email, diem = $diem, image = '$image' WHERE id = $id";
                    }
                }
                $result = mysqli_query($conn_vn, $sql);
                if ($result) {
                    echo '<script type="text/javascript">alert(\'Bạn đã sửa nhà tuyển dụng thành công!\')</script>';
                } else {
                    echo '<script type="text/javascript">alert(\'Có lỗi xảy ra!\')</script>';
                    // echo mysqli_error($co);
                }
            }
        }
	}

	nha_tuyen_dung($_GET['id']);

    $info = $action->getDetail('nha_tuyen_dung', 'id', $_GET['id']);

    $list_don_tuyen = $action->getList('thong_tin_tuyen_dung', 'nha_tuyen_dung_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
    $list_ung_vien = $action->getList('ung_tuyen', 'nha_tuyen_dung_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
    $ho_so_da_luu = $action->getList('ho_so_da_luu', 'nha_tuyen_dung_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
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
            <input type="text" class="txtNCP1" name="company" value="<?= $info['company'] ?>" required/>
            <p class="titleRightNCP">Địa chỉ</p>
            <input type="text" class="txtNCP1" name="address" value="<?= $info['address'] ?>" required/>
            <p class="titleRightNCP">Điện thoại</p>
            <input type="number" class="txtNCP1" name="phone" value="<?= $info['phone'] ?>" readonly/>
            <p class="titleRightNCP">Người liên hệ</p>
            <input type="text" class="txtNCP1" name="name" value="<?= $info['name'] ?>" required/>
            <p class="titleRightNCP">Quy mô</p>
            <input type="text" class="txtNCP1" name="quy_mo" value="<?= $info['quy_mo'] ?>" />
            <p class="titleRightNCP">Website</p>
            <input type="text" class="txtNCP1" name="website" value="<?= $info['website'] ?>" />
            <p class="titleRightNCP">Ảnh đại diện</p>
            <input type="file" class="txtNCP1" name="image" />
            <img src="/images/<?= $info['image']=='' ? 'no-photo.png' : $info['image'] ?>" alt="" width="100">
            <p class="titleRightNCP">Email</p>
            <input type="email" class="txtNCP1" name="email" value="<?= $info['email'] ?>" readonly/>
            <p class="titleRightNCP">Mật khẩu</p>
            <input type="password" class="txtNCP1" name="pass1" />
            <p class="titleRightNCP">Xác nhận mật khẩu</p>
            <input type="password" class="txtNCP1" name="pass2" />
            
            
        </div>
    </div><!--end rowNodeContentPage-->
    <div class="rowNodeContentPage" style="display: <?= $_SESSION['admin_role']!=1 ? 'none' : ''; ?>">
        <div class="leftNCP">
            <span class="titLeftNCP">Trạng thái</span>
            <p class="subLeftNCP">Thiết lập chế độ hiển thị cho trang nội dung</p>                
        </div>
        <div class="boxNodeContentPage">
            

            <label class="selectCate">
                <input type="checkbox" value="1" name="send_email" <?= $info['send_email']==1 ? 'checked' : '' ?> >
                Gửi email
            </label>
            
            <label class="selectCate" style="display: ;">
                <input type="checkbox" value="1" name="see" <?= $info['see']==1 ? 'checked' : '' ?> >
                Điểm
                <input type="number" class="txtNCP1" name="diem" value="<?= $info['diem'] ?>" style="width: 100px;" />
            </label>
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="dangky">Lưu</button>
</form>

<div class="rowNodeContentPage" style="margin-top: 35px;">
        <div class="leftNCP">
            <span class="titLeftNCP">Trạng quản trị</span>
            <p class="subLeftNCP">Thiết lập chế độ hiển thị cho trang nội dung</p>                
        </div>
        <div class="boxNodeContentPage">
            <h2>Thông tin trang quản trị</h2>
              
              <table class="table table-striped">
                
                <tbody>
                  <tr>
                    <td>Điểm</td>
                    <td><?= $info['diem'] ?></td>
                  </tr>
                  <tr>
                    <td><a href="index.php?page=tin-da-dang-ntd&id=<?= $info['id'] ?>">Tin đã đăng</a></td>
                    <td><?= count($list_don_tuyen) ?></td>
                  </tr>
                  <tr>
                    <td><a href="index.php?page=ho-so-ung-tuyen-ntd&id=<?= $info['id'] ?>">Hồ sơ ứng tuyển</a></td>
                    <td><?= count($list_ung_vien) ?></td>
                  </tr>
                  <tr>
                    <td><a href="index.php?page=ho-so-da-luu-ntd&id=<?= $info['id'] ?>">Hồ sơ đã lưu</a></td>
                    <td><?= count($ho_so_da_luu) ?></td>
                  </tr>
                  <tr>
                    <td>Lượt xem hồ sơ</td>
                    <td><?= $info['xem_ho_so'] ?></td>
                  </tr>
                  <tr>
                    <td>Số làm mới</td>
                    <td><?= $info['lam_moi'] ?></td>
                  </tr>
                </tbody>
              </table>

            
        </div>
    </div><!--end rowNodeContentPage-->
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ GoldBridge Việt Nam</p>