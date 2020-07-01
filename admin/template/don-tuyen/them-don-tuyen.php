<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	

	function don_tuyen ($id) {
		global $conn_vn;
        if (isset($_POST['add_tuyen_dung'])) {
            $position = $_POST['position'];
            $career = $_POST['career'];
            // $career = implode(',', $career);
            $career = json_encode($career);
            $level = $_POST['level'];
            $quatity = $_POST['quatity'];
            $sex = $_POST['sex'];
            $form = $_POST['form'];
            $experience = $_POST['experience'];
            $age = $_POST['age'];
            $note = $_POST['note'];
            $benefit = $_POST['benefit'];
            $location = $_POST['location'];
            // $location = implode(',', $location);
            $location = json_encode($location);
            $request = $_POST['request'];
            $salary = $_POST['salary'];
            $ngay = $_POST['ngay'];
            $office = $_POST['office'];
            $brief = $_POST['brief'];
            $alias = $_POST['alias'];
            $chuyen_nganh = $_POST['chuyen_nganh'];
            $created_at = date('Y-m-d');

            $time = date("Y-m-d H:i:s");

            $ngoai_ngu_tin_hoc = $_POST['ngoai_ngu_tin_hoc'];

            if ($age == '') {
                // $age = 0;
            }


            $sql = "INSERT INTO thong_tin_tuyen_dung (nha_tuyen_dung_id, position, career, level, quatity, sex, form, experience, age, note, benefit, location, request, salary, ngay, office, brief, alias, chuyen_nganh, created_at, `time`, ngoai_ngu_tin_hoc) VALUES ($id, '$position', '$career', $level, $quatity, $sex, $form, $experience, '$age', '$note', '$benefit', '$location', '$request', '$salary', '$ngay', $office, '$brief', '$alias', '$chuyen_nganh', '$created_at', '$time', '$ngoai_ngu_tin_hoc')";
            // echo $sql;
            $result = mysqli_query($conn_vn, $sql);
            if ($result) {
                echo '<script type="text/javascript">alert(\'Bạn đã tạo đơn tuyển thành công!\');window.location.href="index.php?page=don-tuyen&nha_tuyen_dung_id='.$id.'"</script>';
            } else {
                echo '<script type="text/javascript">alert(\'Có lỗi xảy ra!\')</script>';
                // echo mysqli_error($conn_vn);
            }
        }
	}

	don_tuyen($_GET['nha_tuyen_dung_id']);

	$career = $action->getList('career', '', '', 'id', 'asc', '', '', '');
	$location = $action->getList('location', '', '', 'id', 'asc', '', '', '');
	$office = $action->getList('office', '', '', 'id', 'asc', '', '', '');
	$sex = array('không', 'Không yêu cầu', 'Nam', 'Nữ');unset($sex[0]);
	$level = array('không', 'Lao động phổ thông', 'Trung cấp', 'Cao đẳng', 'Đại học', 'Thạc sĩ');unset($level[0]);
    $level = $action->getList('level_2', '', '', 'id', 'asc', '', '', '');
    $experience = $action->getList('experience', '', '', 'id', 'asc', '', '', '');
	$ngoai_ngu = $action->getList('ngoai_ngu', '', '', 'id', 'asc', '', '', '');
    $luong = $action->getList('luong', '', '', 'id', 'asc', '', '', '');
?>
<link rel='stylesheet' href='/css/chosen/chosen.css'>
<style class="cp-pen-styles">
#output {
  padding: 20px;
  background: #dadada;
  display: none;
}
.chosen-results li {
    /*float: none;*/
    width: 100%;
}
</style>
<div id="output"></div>
<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin đơn tuyển<br /><br /></p>     
            <p class="subLeftNCP"><a href="index.php?page=don-tuyen&nha_tuyen_dung_id=<?= $_GET['nha_tuyen_dung_id'] ?>">Quay lại</a><br /><br /></p>     
                    
        </div>
        <div class="boxNodeContentPage">
            <p class="titleRightNCP">Vị trí tuyển dụng</p>
            <input type="text" class="txtNCP1" name="position" id="position"  onchange="ChangeToSlug()" required/>
            <input type="hidden" name="alias" id="alias">
            <p class="titleRightNCP">Mục đăng tin</p>
            <select name="career[]" class="txtNCP1 chosen-select" data-placeholder="Chọn mục đăng tin" multiple required>
            	<?php foreach ($career as $item) { ?>
            	<option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
            	<?php } ?>
            </select>
            <p class="titleRightNCP" style="display: none;">Chuyên ngành</p>
            <input type="text" class="txtNCP1" name="chuyen_nganh" style="display: none;" />
            <p class="titleRightNCP">Trình độ yêu cầu</p>
            <select name="level" class="txtNCP1" required>
                <option value="">Chọn trình độ</option>
                <option value="6">THCS/THPT</option>
                <option value="7">Chứng chỉ nghề</option>
                <option value="8">Bằng lái ô tô</option>
                <option value="9">Bằng lái Xúc, Nâng</option>
                <option value="1">Trung cấp</option>
                <option value="2">Cao đẳng</option>
                <option value="3">Đại học</option>
                <option value="4">Thạc sĩ</option>
                <option value="5">Tiến sĩ</option>
            </select>
            <p class="titleRightNCP">Số lượng</p>
            <input type="number" class="txtNCP1" name="quatity" required/>
            <p class="titleRightNCP">Giới tính</p>
            <select name="sex" class="txtNCP1" required>
            	<option value="">Chọn giới tính</option>
            	<?php foreach ($sex as $k => $item) { ?>
            	<option value="<?= $k ?>"><?= $item ?></option>
            	<?php } ?>
            </select>
            <p class="titleRightNCP">Hình thức làm việc</p>
            <select name="form" class="txtNCP1" required>
            	<option value="1">Toàn thời gian</option>
            	<option value="2">Bán thời gian</option>
            </select>
            <p class="titleRightNCP">Kinh nghiệm</p>
            <select name="experience" class="txtNCP1" required>
            	<?php foreach ($experience as $item) { ?>
            	<option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
            	<?php } ?>
            </select>
            <p class="titleRightNCP">Mức lương</p>
            <!-- <input type="text" class="txtNCP1" name="salary" required/> -->
            <select name="salary" class="txtNCP1">
                <?php foreach ($luong as $item) { ?>
                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                <?php } ?>
            </select>
            <p class="titleRightNCP">Ngày hết hạn</p>
            <input type="date" class="txtNCP1" name="ngay" required/>
            <p class="titleRightNCP">Địa điểm làm việc</p>
            <select name="location[]" class="txtNCP1 chosen-select" data-placeholder="Chọn địa điểm làm việc" multiple required>
            	<?php foreach ($location as $item) { ?>
            	<option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
            	<?php } ?>
            </select>
            <p class="titleRightNCP">Chức vụ</p>
            <select name="office" class="txtNCP1" required>
            	<?php foreach ($office as $item) { ?>
            	<option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
            	<?php } ?>
            </select>
            <p class="titleRightNCP">Yêu cầu độ tuổi</p>
            <input type="text" class="txtNCP1" name="age" />
            <p class="titleRightNCP">Yêu cầu ngoại ngữ</p>
            
            <select name="ngoai_ngu_tin_hoc" class="txtNCP1" required>
                <?php foreach ($ngoai_ngu as $item) { ?>
                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                <?php } ?>
            </select>
            <p class="titleRightNCP">Mô tả công việc</p>
            <textarea name="note" class="txtNCP1" rows="5"></textarea>
            <p class="titleRightNCP">Quyền lợi</p>
            <textarea name="benefit" class="txtNCP1" rows="5"></textarea>
            <p class="titleRightNCP">Yêu cầu công việc</p>
            <textarea name="request" class="txtNCP1" rows="5"></textarea>
            <p class="titleRightNCP">Yêu cầu hồ sơ</p>
            <textarea name="brief" class="txtNCP1" rows="5"></textarea>
            
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="add_tuyen_dung">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ GoldBridge Việt Nam</p>
<script>
    function ChangeToSlug(){
        var title, slug;
        //alert ("a");
        //Lấy text từ thẻ input title 
        title = document.getElementById("position").value;
        // document.getElementById('title_seo').value = title;
        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();
     
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        slug = slug.replace(/[^a-z0-9\-]+/gi, '');
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('alias').value = slug;
        // document.getElementById('title_seo').value = title;
    }
</script>
<script src='/css/chosen/chosen.jquery.js'></script>
<script >
document.getElementById('output').innerHTML = location.search;
$(".chosen-select").chosen();
//# sourceURL=pen.js
</script>