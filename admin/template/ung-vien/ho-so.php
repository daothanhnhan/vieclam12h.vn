<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	function set_time_ungvien ($id) {
        global $conn_vn;
        $time = date("Y-m-d H:i:s");
        $sql = "UPDATE ung_vien SET `time` = '$time' WHERE id = $id";
        $result = mysqli_query($conn_vn, $sql);
    }

	function add_hoso ($id) {
        set_time_ungvien($id);
        global $conn_vn;
        $action = new action_page();
        if (isset($_POST['add_hoso'])) {
            // var_dump($_POST);
            $src= "../images/cv/";
            $cv = '';

            if(isset($_FILES['cv']) && $_FILES['cv']['name'] != ""){
                $cv = time().$_FILES['cv']['name'];
                uploadPicture($src, $cv, $_FILES['cv']['tmp_name']);

            }

            $school = isset($_POST['school']) ? $_POST['school'] : '';
            $career = isset($_POST['career']) ? $_POST['career'] : '';
            $year = isset($_POST['year']) ? $_POST['year'] : '';
            $level = isset($_POST['level']) ? $_POST['level'] : '0';
            $skill = $_POST['skill'];
            $work_progress = $_POST['work_progress'];
            $experience = $_POST['experience'];
            $salary = $_POST['salary'];
            $form = $_POST['form'];
            $address = $_POST['address'];
            $ung_vien_id = $id;
            $position = $_POST['position'];
            $alias = $_POST['alias'];
            $item = $_POST['item'];
            // $item = implode(',', $item);
            $item = json_encode($item);
            $dia_diem = $_POST['dia_diem'];
            // $dia_diem = implode(',', $dia_diem);
            $dia_diem = json_encode($dia_diem);
            $hon_nhan = $_POST['hon_nhan'];
            $created_at = $_POST['created_at'];
            $xep_loai = isset($_POST['xep_loai']) ? $_POST['xep_loai'] : '';
            $muc_tieu = $_POST['muc_tieu'];
            $loai_nganh = $_POST['loai_nganh'];
            $office = $_POST['office'];

            $ngoai_ngu_tin_hoc = isset($_POST['ngoai_ngu_tin_hoc']) ? $_POST['ngoai_ngu_tin_hoc'] : '';

            $count_hoso = $action->getList('ho_so', 'ung_vien_id', $id, 'id', 'asc', '', '', '');
            $count_hoso = count($count_hoso);
            if ($count_hoso > 0) {
                echo '<script type="text/javascript">alert(\'Bạn đã tạo hồ sơ rồi!\')</script>';
            } else {
                $sql = "INSERT INTO ho_so (ung_vien_id, school, career, year, skill, work_progress, experience, salary, form, address, cv, position, alias, item, dia_diem, hon_nhan, level, created_at, xep_loai, muc_tieu, loai_nganh, ngoai_ngu_tin_hoc, office) VALUES ($ung_vien_id, '$school', '$career', '$year', '$skill', '$work_progress', '$experience', '$salary', $form, '$address', '$cv', '$position', '$alias', '$item', '$dia_diem', $hon_nhan, $level, '$created_at', '$xep_loai', '$muc_tieu', $loai_nganh, '$ngoai_ngu_tin_hoc', $office)";
                $result = mysqli_query($conn_vn, $sql);
                if ($result) {
                    echo '<script type="text/javascript">alert(\'Bạn tạo hồ sơ thành công!\')</script>';
                } else {
                    echo '<script type="text/javascript">alert(\'Có lỗi xảy ra!\')</script>';
                }
            }            
        }
    }
    add_hoso($_GET['id']);

    function edit_hoso ($id) {
        set_time_ungvien($id);
        global $conn_vn;
        if (isset($_POST['edit_hoso'])) {
            $src= "../images/cv/";
            $cv = '';

            if(isset($_FILES['cv']) && $_FILES['cv']['name'] != ""){
                $cv = time().$_FILES['cv']['name'];
                uploadPicture($src, $cv, $_FILES['cv']['tmp_name']);

            }

            $school = isset($_POST['school']) ? $_POST['school'] : '';
            $career = isset($_POST['career']) ? $_POST['career'] : '';
            $year = isset($_POST['year']) ? $_POST['year'] : '';
            $level = isset($_POST['level']) ? $_POST['level'] : '0';
            $skill = $_POST['skill'];
            $work_progress = $_POST['work_progress'];
            $experience = $_POST['experience'];
            $salary = $_POST['salary'];
            $form = $_POST['form'];
            $address = $_POST['address'];
            $ung_vien_id = $id;
            $position = $_POST['position'];
            $alias = $_POST['alias'];
            $item = $_POST['item'];
            // $item = implode(',', $item);
            $item = json_encode($item);
            $dia_diem = $_POST['dia_diem'];
            // $dia_diem = implode(',', $dia_diem);
            $dia_diem = json_encode($dia_diem);
            $hon_nhan = $_POST['hon_nhan'];
            $created_at = $_POST['created_at'];
            $xep_loai = isset($_POST['xep_loai']) ? $_POST['xep_loai'] : '';
            $muc_tieu = $_POST['muc_tieu'];
            $loai_nganh = $_POST['loai_nganh'];
            $office = $_POST['office'];

            $ngoai_ngu_tin_hoc = isset($_POST['ngoai_ngu_tin_hoc']) ? $_POST['ngoai_ngu_tin_hoc'] : '';


            if ($cv == '') {
                $sql = "UPDATE ho_so SET school = '$school', career = '$career', year = '$year', skill = '$skill', work_progress = '$work_progress', experience = '$experience', salary = '$salary', form = $form, address = '$address', position = '$position', alias = '$alias', item = '$item', dia_diem = '$dia_diem', hon_nhan = $hon_nhan, level = $level, created_at = '$created_at', xep_loai = '$xep_loai', muc_tieu = '$muc_tieu', loai_nganh = $loai_nganh, ngoai_ngu_tin_hoc = '$ngoai_ngu_tin_hoc', office = $office WHERE ung_vien_id = $id";
            } else {
                $sql = "UPDATE ho_so SET school = '$school', career = '$career', year = '$year', skill = '$skill', work_progress = '$work_progress', experience = '$experience', salary = '$salary', form = $form, address = '$address', position = '$position', alias = '$alias', item = '$item', dia_diem = '$dia_diem', hon_nhan = $hon_nhan, level = $level, created_at = '$created_at', xep_loai = '$xep_loai', muc_tieu = '$muc_tieu', loai_nganh = $loai_nganh, ngoai_ngu_tin_hoc = '$ngoai_ngu_tin_hoc', office = $office, cv = '$cv' WHERE ung_vien_id = $id";
            }

            $result = mysqli_query($conn_vn, $sql);
            if ($result) {
                echo '<script type="text/javascript">alert(\'Bạn cập nhật hồ sơ thành công!\')</script>';
            } else {
                echo '<script type="text/javascript">alert(\'Có lỗi xảy ra!\')</script>';
            }
        }
    }
    edit_hoso($_GET['id']);

    $count_hoso = $action->getList('ho_so', 'ung_vien_id', $_GET['id'], 'id', 'asc', '', '', '');
    $count_hoso = count($count_hoso);
    if ($count_hoso > 0) {
        $info_hoso = $action->getDetail('ho_so', 'ung_vien_id', $_GET['id']);//var_dump($info_hoso);
        $position = $info_hoso['position'];
        $school = $info_hoso['school'];
        $career = $info_hoso['career'];
        $year = $info_hoso['year'];
        $skill = $info_hoso['skill'];
        $work_progress = $info_hoso['work_progress'];
        $experience = $info_hoso['experience'];
        $salary = $info_hoso['salary'];
        $form = $info_hoso['form'];
        $address = $info_hoso['address'];
        $cv = $info_hoso['cv'];
        $alias = $info_hoso['alias'];
        $item1 = $info_hoso['item'];
        // $item1 = explode(',', $item1);
        $item1 = json_decode($item1);
        $dia_diem = $info_hoso['dia_diem'];
        // $dia_diem = explode(',', $dia_diem);
        $dia_diem = json_decode($dia_diem);
        $hon_nhan = $info_hoso['hon_nhan'];
        $level = $info_hoso['level'];
        $created_at = $info_hoso['created_at'];
        $xep_loai = $info_hoso['xep_loai'];
        $muc_tieu = $info_hoso['muc_tieu'];
        $type_carrer = $info_hoso['loai_nganh'];
        $ngoai_ngu_tin_hoc = $info_hoso['ngoai_ngu_tin_hoc'];
        $chuc_vu = $info_hoso['office'];
    } else {
        $position = '';
        $school = '';
        $career = '';
        $year = '';
        $skill = '';
        $work_progress = '';
        $experience = '';
        $salary = '';
        $form = 0;
        $address = '';
        $cv = '';
        $alias = '';
        $item1 = '';
        $dia_diem = '';
        $hon_nhan = '';
        $level = '';
        $created_at = date("Y-m-d");
        $xep_loai = '';
        $muc_tieu = '';
        $type_carrer = 0;
        $ngoai_ngu_tin_hoc = '';
        $chuc_vu = '';
    }

    $info_ungvien = $action->getDetail('ung_vien', 'id', $_GET['id']);

    $dangtin = $action->getList('career', '', '', 'id', 'asc', '', '', '');
    $location = $action->getList('location', '', '', 'id', 'asc', '', '', '');
    $loai_nganh = $action->getList('loai_nganh', '', '', 'id', 'asc', '', '', '');
    $ngoai_ngu = $action->getList('ngoai_ngu_1', '', '', 'id', 'asc', '', '', '');
    $search_name = array();
    foreach ($location as $key => $row)
    {
        $search_name[$key] = $row['name'];
    }
    // array_multisort($search_name, SORT_ASC, $location);

    $experience_arr = array('khong', 'Chưa có', 'Dưới 1 năm', '1 năm', '2 năm', '3 năm', '4 năm', '5 năm', '6 năm', '7 năm', '8 năm', '9 năm', '10 năm', 'trên 10 năm');unset($experience_arr[0]);

    $luong = $action->getList('luong', '', '', 'id', 'asc', '', '', '');
    $office = $action->getList('office', '', '', 'id', 'asc', '', '', '');

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
            <p class="subLeftNCP">Nhập thông tin thương hiệu<br /><br /></p>     
            <?php if ($info_ungvien['type']==0) { ?>
            <p class="subLeftNCP"><a href="index.php?page=ung-vien-co-trinh-do">Quay lại</a><br /><br /></p>
            <?php } else { ?>
            <p class="subLeftNCP"><a href="index.php?page=ung-vien-pho-thong">Quay lại</a><br /><br /></p>
            <?php } ?>
                    
        </div>
        <div class="boxNodeContentPage">
            <p class="titleRightNCP">Vị trí ứng tuyển</p>
            <input type="text" class="txtNCP1" name="position" id="position" value="<?= $position ?>" onchange="ChangeToSlug()" required/>
            <input type="hidden" name="alias" id="alias" value="<?= $alias ?>">
            <p class="titleRightNCP">Tốt nghiệp trường</p>
            <input type="text" class="txtNCP1" name="school" value="<?= $school ?>" />
            <p class="titleRightNCP">Trình độ</p>
            <select name="level" class="txtNCP1" required>
                <option value="">Chọn trình độ</option>
                <?php if ($info_ungvien['type']==0) { ?>
                <option value="1" <?= $level==1 ? 'selected' : '' ?> >Trung cấp</option>
                <option value="2" <?= $level==2 ? 'selected' : '' ?> >Cao đẳng</option>
                <option value="3" <?= $level==3 ? 'selected' : '' ?> >Đại học</option>
                <option value="4" <?= $level==4 ? 'selected' : '' ?> >Thạc sĩ</option>
                <option value="5" <?= $level==5 ? 'selected' : '' ?> >Tiến sĩ</option>
                <?php } else { ?>
                <option value="6" <?= $level==6 ? 'selected' : '' ?> >THCS/PTTH</option>

                <option value="7" <?= $level==7 ? 'selected' : '' ?> >Chứng chỉ nghề</option>
                <option value="8" <?= $level==8 ? 'selected' : '' ?> >Bằng lái ô tô</option>
                <option value="9" <?= $level==9 ? 'selected' : '' ?> >Bằng lái Xúc, Nâng</option>
                <?php } ?>
            </select>
            <?php if ($info_ungvien['type']==0) { ?>
            
            <p class="titleRightNCP">Chuyên ngành</p>
            <input type="text" class="txtNCP1" name="career" value="<?= $career ?>" required/>
            <p class="titleRightNCP">Năm tốt nghiệp</p>
            <input type="text" class="txtNCP1" name="year" value="<?= $year ?>" required/>
            
            <p class="titleRightNCP">Xếp loại</p>
            <input type="text" class="txtNCP1" name="xep_loai" value="<?= $xep_loai ?>" required/>
            <p class="titleRightNCP">Ngoại ngữ</p>
            <select name="ngoai_ngu_tin_hoc" class="txtNCP1" required>
                <?php foreach ($ngoai_ngu as $item) { ?>
                <option value="<?= $item['id'] ?>" <?= $item['id']==$ngoai_ngu_tin_hoc ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                <?php } ?>
            </select>
            <?php } ?>
            
            <p class="titleRightNCP">Mục đăng tin</p>
            <select name="item[]" class="txtNCP1 chosen-select" data-placeholder="Chọn mục đăng tin" multiple required>
                <?php foreach ($dangtin as $item) { ?>
                <option value="<?= $item['id'] ?>" <?= in_array($item['id'], $item1) ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                <?php } ?>
            </select>
            <p class="titleRightNCP">Địa điểm làm việc</p>
            <select name="dia_diem[]" class="txtNCP1 chosen-select-1" data-placeholder="Chọn địa điểm làm việc" multiple required>
                <?php foreach ($location as $item) { ?>
                <option value="<?= $item['id'] ?>" <?= in_array($item['id'], $dia_diem) ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                <?php } ?>
            </select>
            <p class="titleRightNCP">Loại ngành</p>
            <select class="txtNCP1" name="loai_nganh" required>
                <option value="">Chọn loại ngành</option>
                <?php foreach ($loai_nganh as $item) { ?>
                <option value="<?= $item['id'] ?>" <?= $item['id']==$type_carrer ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                <?php } ?>
            </select>
            <p class="titleRightNCP">Tình trạng hôn nhân</p>
            <select name="hon_nhan" class="txtNCP1" required>
                <option value="">Chọn hôn nhân</option>
                <option value="1" <?= $hon_nhan==1 ? 'selected' : '' ?> >Độc thân</option>
                <option value="2" <?= $hon_nhan==2 ? 'selected' : '' ?> >Có gia đình</option>
            </select>
            <p class="titleRightNCP">Chức vụ</p>
            <select name="office" class="txtNCP1" required>
                <option value="">Chọn chức vụ</option>
                <?php foreach ($office as $item) { ?>
                <option value="<?= $item['id'] ?>" <?= $chuc_vu==$item['id'] ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                <?php } ?>
            </select>
            <p class="titleRightNCP">Kỹ năng bản thân</p>
            <textarea name="skill" class="txtNCP1" rows="5" required><?= $skill ?></textarea>
            <p class="titleRightNCP">Quá trình làm việc</p>
            <textarea name="work_progress" class="txtNCP1" rows="5" required><?= $work_progress ?></textarea>
            <p class="titleRightNCP">Mục tiêu nghề nghiệp</p>
            <textarea name="muc_tieu" class="txtNCP1" rows="5" required><?= $muc_tieu ?></textarea>
            <p class="titleRightNCP">Kinh nghiệm</p>

            <select name="experience" class="txtNCP1" required>
                <?php foreach ($experience_arr as $k => $item) { ?>
                <option value="<?= $k ?>" <?= $k==$experience ? 'selected' : '' ?> ><?= $item ?></option>
                <?php } ?>
            </select>
            <p class="titleRightNCP">Lương mong muốn</p>
            <!-- <input type="text" class="txtNCP1" name="salary" value="<?= $salary ?>" required/> -->
            <select name="salary" class="txtNCP1">
                <?php foreach ($luong as $item) { ?>
                <option value="<?= $item['id'] ?>" <?= $item['id']==$salary ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                <?php } ?>
            </select>
            <p class="titleRightNCP">Hình thức làm việc</p>
            <select name="form" class="txtNCP1" required>
            	<option value="1" <?= $form==1 ? 'selected' : '' ?> >Toàn thời gian</option>
            	<option value="2" <?= $form==2 ? 'selected' : '' ?> >Bán thời gian</option>
            </select>
            <p class="titleRightNCP">Chỗ ở hiện nay</p>
            <input type="text" class="txtNCP1" name="address" value="<?= $address ?>" required/>
            <p class="titleRightNCP">Ngày tạo</p>
            <input type="date" class="txtNCP1" name="created_at" value="<?= $created_at ?>" required/>
            <p class="titleRightNCP">CV đi kèm</p>
            <input type="file" class="txtNCP1" name="cv" />
            <?php if ($cv != '') { ?>
            <a href="/images/cv/<?= $cv ?>" download>Download</a>
            <?php } ?>
            
        </div>
    </div><!--end rowNodeContentPage-->
    <?php if ($count_hoso > 0) { ?>
    <button class="btn btnSave" type="submit" name="edit_hoso">Cập nhật</button>
	<?php } else { ?>
	<button class="btn btnSave" type="submit" name="add_hoso">Thêm mới</button>
	<?php } ?>
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
$(".chosen-select-1").chosen({max_selected_options: 2});
//# sourceURL=pen.js
</script>