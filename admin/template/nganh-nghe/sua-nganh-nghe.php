<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	

	function nganh_nghe ($id) {
		global $conn_vn;
		if (isset($_POST['add_career'])) {
			$src= "../images/";
			// $src = "uploads/";

			// if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

			// 	uploadPicture($src, $_FILES['image']['name'], $_FILES['image']['tmp_name']);

			// }

			$name = $_POST['name'];
			$type = $_POST['type'];

			$sql = "UPDATE career SET name = '$name', type = $type WHERE id = $id";
			$result = mysqli_query($conn_vn, $sql);
			if ($result) {
				echo '<script type="text/javascript">alert(\'Bạn đã sửa được một ngành nghề.\')</script>';
			} else {
				echo '<script type="text/javascript">alert(\'Có lỗi xảy ra.\')</script>';
			}
		}
	}

	nganh_nghe($_GET['id']);

	$info = $action->getDetail('career', 'id', $_GET['id']);
	$type = $action->getList('loai_nganh', '', '', 'id', 'asc', '', '', '');
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin ngành nghề<br /><br /></p>     
            <p class="subLeftNCP"><a href="index.php?page=nganh-nghe">Quay lại</a><br /><br /></p>     
                    
        </div>
        <div class="boxNodeContentPage">
            <p class="titleRightNCP">Tên</p>
            <input type="text" class="txtNCP1" name="name" value="<?= $info['name'] ?>" required/>
            <p class="titleRightNCP">Loại</p>
            <select class="txtNCP1" name="type">
            	<?php foreach ($type as $item) { ?>
            	<option value="<?= $item['id'] ?>" <?= $item['id']==$info['type'] ? 'selected' : '' ?> ><?= $item['name'] ?></option>
            	<?php } ?>
            </select>
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="add_career">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ GoldBridge Việt Nam</p>