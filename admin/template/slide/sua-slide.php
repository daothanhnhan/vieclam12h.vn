<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	

	function slide ($id) {
		global $conn_vn;
		if (isset($_POST['add_slide'])) {
			$src= "../images/";
			// $src = "uploads/";
			$image = '';

			if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

				uploadPicture($src, $_FILES['image']['name'], $_FILES['image']['tmp_name']);
				$image = $_FILES['image']['name'];

			}

			$name = '';
			$link = '';
			$note = '';

			if ($image == '') {
				$sql = "UPDATE slide SET name = '$name', link = '$link', note = '$note' WHERE id = $id";
			} else {
				$sql = "UPDATE slide SET name = '$name', link = '$link', note = '$note', image = '$image' WHERE id = $id";
			}
			
			$result = mysqli_query($conn_vn, $sql);
			echo '<script type="text/javascript">alert(\'Bạn đã sửa được một Slide.\');</script>';
		}
	}

	slide($_GET['id']);

	$getslide = $acc->getDetail('slide', 'id', $_GET['id']);
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin Slide<br /><br /></p>     
                    
        </div>
        <div class="boxNodeContentPage">
            <!-- <p class="titleRightNCP">Tên </p>
            <input type="text" class="txtNCP1" name="name" value="<?= $getslide['name'] ?>" required/>
            <p class="titleRightNCP">Link </p>
            <input type="text" class="txtNCP1" name="link" value="<?= $getslide['link'] ?>" />
            <p class="titleRightNCP">Note </p>
            <textarea class="txtNCP1" name="note"><?= $getslide['note'] ?></textarea> -->
            <p class="titleRightNCP">Ảnh</p>
            <input type="file" class="txtNCP1" name="image" />
            <img src="/images/<?= $getslide['image'] ?>" width="100">
            
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="add_slide">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ GoldBridge Việt Nam</p>