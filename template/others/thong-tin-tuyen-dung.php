<?php 
    if (!isset($_GET['trang'])) {
        header('location: /');
    }
    
    if (!isset($_SESSION['user_id_gbvn'])) {
        echo '<script type="text/javascript">alert(\'Bạn chưa đăng nhập!\');window.location.href="/dang-nhap"</script>';
    }
    function check_login ($id1, $id2) {
        if ($id1 != $id2) {
            echo '<script type="text/javascript">alert(\'Bạn chưa đăng nhập!\');window.location.href="/dang-nhap"</script>';
        }
    }

    function don_tuyen_dung ($id) {
        global $conn_vn;
        if (isset($_POST['edit_tuyen_dung'])) {
            $position = $_POST['position'];
            $career = $_POST['career'];
            // $career = implode(',', $career);
            $career = json_encode($career);
            $level = $_POST['level'];
            $quatity = $_POST['quatity'];
            $sex = $_POST['sex'];
            $form = $_POST['form'];
            $experience = $_POST['experience'];
            $location = $_POST['location'];
            // $location = implode(',', $location);
            $location = json_encode($location);
            $ngay = $_POST['ngay'];
            $age = $_POST['age']!='' ? $_POST['age'] : '';
            $note = $_POST['note'];
            $benefit = $_POST['benefit'];
            $request = $_POST['request'];
            $salary = $_POST['salary'];
            $office = $_POST['office'];
            $brief = $_POST['brief'];
            $alias = $_POST['alias'];
            $chuyen_nganh = '';

            $ngoai_ngu_tin_hoc = $_POST['ngoai_ngu_tin_hoc'];

            $time = date("Y-m-d H:i:s");

            $len_month = strlen($_POST['month']);
            if ($len_month == 1) {
                $month = '0'.$_POST['month'];
            } else {
                $month = $_POST['month'];
            }
            $len_day = strlen($_POST['day']);
            if ($len_day == 1) {
                $day = '0'.$_POST['day'];
            } else {
                $day = $_POST['day'];
            }
            $ngay = $_POST['year'].'-'.$month.'-'.$day;

            $sql = "UPDATE thong_tin_tuyen_dung SET position = '$position', career = '$career', level = $level, quatity = $quatity, sex = $sex, form = $form, experience = $experience, location = '$location', ngay = '$ngay', age = '$age', note = '$note', benefit = '$benefit', request = '$request', salary = '$salary', office = $office, brief = '$brief', alias = '$alias', chuyen_nganh = '$chuyen_nganh', `time` = '$time', ngoai_ngu_tin_hoc = '$ngoai_ngu_tin_hoc' WHERE id = $id";
            $result = mysqli_query($conn_vn, $sql);
            if ($result) {
                echo '<script type="text/javascript">alert(\'Bạn đã cập nhật đơn tuyển dụng thành công!\')</script>';
            } else {
                echo '<script type="text/javascript">alert(\'Có lỗi xảy ra!\')</script>';
            }
        }
    }
    don_tuyen_dung($_GET['trang']);

    $don_tuyen_dung = $action->getDetail('thong_tin_tuyen_dung', 'id', $_GET['trang']);

    check_login($don_tuyen_dung['nha_tuyen_dung_id'], $_SESSION['user_id_gbvn']);

    $list_career = $action->getList('career', '', '', 'id', 'asc', '', '', '');
    $list_location = $action->getList('location', '', '', 'id', 'asc', '', '', '');
    $list_office = $action->getList('office', '', '', 'id', 'asc', '', '', '');
    $ngoai_ngu = $action->getList('ngoai_ngu', '', '', 'id', 'asc', '', '', '');
    $level = $action->getList('level_2', '', '', 'id', 'asc', '', '', '');
    $ngay = $don_tuyen_dung['ngay'];
    $ngay = explode("-", $ngay);
    // $diadiem = explode(',', $don_tuyen_dung['location']);
    // $mucdang = explode(',', $don_tuyen_dung['career']);
    $diadiem = json_decode($don_tuyen_dung['location']);
    $mucdang = json_decode($don_tuyen_dung['career']);
    $search_name = array();
    foreach ($list_location as $key => $row)
    {
        $search_name[$key] = $row['name'];
    }
    array_multisort($search_name, SORT_ASC, $list_location);

    $luong = $action->getList('luong', '', '', 'id', 'asc', '', '', '');
?>
<link rel='stylesheet' href='/css/chosen/chosen.css'>
<style class="cp-pen-styles">
#output {
  padding: 20px;
  background: #dadada;
  display: none;
}

</style>
<div id="output"></div>
<div class="gb-dangky-tuyendung">
    <div class="container">
        <div class="gb-dangky-tuyendung-info">
            <h2>Thông tin tuyển dụng</h2>

            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Vị trí tuyển dụng <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="position" id="position" class="form-control" onchange="ChangeToSlug()" value="<?= $don_tuyen_dung['position'] ?>" required >
                                    <input type="hidden" name="alias" id="alias" value="<?= $don_tuyen_dung['alias'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Chức vụ <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="office" id="office" class="form-control" required >
                                        <?php foreach ($list_office as $item) { ?>
                                        <option value="<?= $item['id'] ?>" <?= $don_tuyen_dung['office']==$item['id'] ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Mục đăng tin <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="career[]" id="career" class="form-control chosen-select" data-placeholder="Chọn mục đăng tin." multiple required >
                                        <option value="">----Chọn mục đăng tin----</option>
                                        <?php foreach ($list_career as $item) { ?>
                                        <option value="<?= $item['id'] ?>" <?= in_array($item['id'], $mucdang) ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Yêu cầu bằng cấp <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="level" id="level" class="form-control" required >
                                        <option value="">----Chọn trình độ----</option>
                                        <option value="6" <?= $don_tuyen_dung['level']==6 ? 'selected' : '' ?> >THCS/THPT</option>
                                        <option value="7" <?= $don_tuyen_dung['level']==7 ? 'selected' : '' ?> >Chứng chỉ nghề</option>
                                        <option value="8" <?= $don_tuyen_dung['level']==8 ? 'selected' : '' ?> >Bằng lái ô tô</option>
                                        <option value="9" <?= $don_tuyen_dung['level']==9 ? 'selected' : '' ?> >Bằng lái Xúc, Nâng</option>
                                        <option value="1" <?= $don_tuyen_dung['level']==1 ? 'selected' : '' ?> >Trung cấp</option>
                                        <option value="2" <?= $don_tuyen_dung['level']==2 ? 'selected' : '' ?> >Cao đẳng</option>
                                        <option value="3" <?= $don_tuyen_dung['level']==3 ? 'selected' : '' ?> >Đại học</option>
                                        <option value="4" <?= $don_tuyen_dung['level']==4 ? 'selected' : '' ?> >Thạc sĩ</option>
                                        <option value="5" <?= $don_tuyen_dung['level']==5 ? 'selected' : '' ?> >Tiến sĩ</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Chuyên ngành <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="chuyen_nganh" class="form-control" value="<?= $don_tuyen_dung['chuyen_nganh'] ?>" required >
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Kinh nghiệm <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="experience" id="experience" class="form-control" required>
                                        <option value="1" <?= $don_tuyen_dung['experience']==1 ? 'selected' : '' ?> >Chưa có kinh nghiệm</option>
                                        <option value="2" <?= $don_tuyen_dung['experience']==2 ? 'selected' : '' ?> >Dưới 1 năm</option>
                                        <option value="3" <?= $don_tuyen_dung['experience']==3 ? 'selected' : '' ?> >1 năm</option>
                                        <option value="4" <?= $don_tuyen_dung['experience']==4 ? 'selected' : '' ?> >2 năm</option>
                                        <option value="5" <?= $don_tuyen_dung['experience']==5 ? 'selected' : '' ?> >3 năm</option>
                                        <option value="6" <?= $don_tuyen_dung['experience']==6 ? 'selected' : '' ?> >4 năm</option>
                                        <option value="7" <?= $don_tuyen_dung['experience']==7 ? 'selected' : '' ?> >5 năm</option>
                                        <option value="8" <?= $don_tuyen_dung['experience']==8 ? 'selected' : '' ?> >6 năm</option>
                                        <option value="9" <?= $don_tuyen_dung['experience']==9 ? 'selected' : '' ?> >7 năm</option>
                                        <option value="10" <?= $don_tuyen_dung['experience']==10 ? 'selected' : '' ?> >8 năm</option>
                                        <option value="10" <?= $don_tuyen_dung['experience']==11 ? 'selected' : '' ?> >9 năm</option>
                                        <option value="10" <?= $don_tuyen_dung['experience']==12 ? 'selected' : '' ?> >10 năm</option>
                                        <option value="11" <?= $don_tuyen_dung['experience']==13 ? 'selected' : '' ?> >Trên 10 năm</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Số lượng <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="number" name="quatity" class="form-control" value="<?= $don_tuyen_dung['quatity'] ?>" required >
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Giới tính <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label><input type="radio" name="sex" value="1" <?= $don_tuyen_dung['sex']==1 ? 'checked' : '' ?>  required>Không yêu cầu</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <label><input type="radio" name="sex" value="2" <?= $don_tuyen_dung['sex']==2 ? 'checked' : '' ?>>Nam</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <label><input type="radio" name="sex" value="3" <?= $don_tuyen_dung['sex']==3 ? 'checked' : '' ?>>Nữ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Yêu cầu dộ tuổi <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="age" class="form-control" value="<?= $don_tuyen_dung['age'] ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Hình thức làm việc <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="form" id="form" class="form-control" required>
                                        <option value="1" <?= $don_tuyen_dung['form']==1 ? 'selected' : '' ?> >Toàn thời gian</option>
                                        <option value="2" <?= $don_tuyen_dung['form']==2 ? 'selected' : '' ?> >Bán thời gian</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Mức lương <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <!-- <input type="text" name="salary" class="form-control" value="<?= $don_tuyen_dung['salary'] ?>" required > -->
                                    <select name="salary" class="form-control">
                                        <?php foreach ($luong as $item) { ?>
                                        <option value="<?= $item['id'] ?>" <?= $item['id']==$don_tuyen_dung['salary'] ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Yêu cầu ngoại ngữ <span style="color: red;">*</span></label>
                                </div>
                                
                                <div class="col-sm-8">
                                    <select name="ngoai_ngu_tin_hoc" id="ngoai_ngu_tin_hoc" class="form-control" required>
                                        <option value="" >-- Chọn ngoại ngữ -- </option>
                                        <?php foreach ($ngoai_ngu as $item) { ?>
                                        <option value="<?= $item['id'] ?>" <?= $item['id']==$don_tuyen_dung['ngoai_ngu_tin_hoc'] ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Địa điểm làm việc <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="location[]" id="location" class="form-control chosen-select" data-placeholder="Chọn địa điểm làm viêc." multiple required >
                                        <?php foreach ($list_location as $item) { ?>
                                        <option value="<?= $item['id'] ?>" <?= in_array($item['id'], $diadiem) ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Mô tả công việc <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="note" rows="5"><?= $don_tuyen_dung['note'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Quyền lợi <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="benefit" rows="5"><?= $don_tuyen_dung['benefit'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Yêu cầu công việc <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="request" rows="5"><?= $don_tuyen_dung['request'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Yêu cầu hồ sơ</label>
                                </div>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="brief" rows="5"><?= $don_tuyen_dung['brief'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Hạn nộp hồ sơ <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <select name="day" class="form-control">
                                                <?php for ($i=1;$i<=31;$i++) { ?>
                                                <option value="<?= $i ?>" <?= $ngay[2]==$i ? 'selected' : '' ?> ><?= $i<10 ? '0' : '' ?><?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="month" class="form-control">
                                                <?php for ($i=1;$i<=12;$i++) { ?>
                                                <option value="<?= $i ?>" <?= $ngay[1]==$i ? 'selected' : '' ?> ><?= $i<10 ? '0' : '' ?><?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="year" class="form-control">
                                                <?php 
                                                $year = date('Y');
                                                for ($i=$year;$i<=$year+2;$i++) { ?>
                                                <option value="<?= $i ?>" <?= $ngay[0]==$i ? 'selected' : '' ?> ><?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    
                                </div>
                                <div class="col-sm-8">
                                    <input type="submit" name="edit_tuyen_dung" value="Cập nhật tin tuyển dụng" class="form-control btn-capnhattintuyendung" >
                                    <h4 class="titlecamon">Vieclam12h - Cảm ơn quý khách hàng đã sử dụng dịch vụ!</h4>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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