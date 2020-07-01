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
    function dang_ky () {
        global $message;
        global $conn_vn;
        if (isset($_POST['ungvien'])) {
            $src= "images/";
            $image = '';

            if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
                $image = time().$_FILES['image']['name'];
                uploadPicture($src, $image, $_FILES['image']['tmp_name']);
            }

            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $born = '';
            // $birthday = $_POST['birthday'];
            $sex = $_POST['sex'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $check = 'true';

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
            $birthday = $_POST['year'].'-'.$month.'-'.$day;

            // Check email isset
            $sql_email = "SELECT * FROM ung_vien Where email = '$email'";
            $result_email = mysqli_query($conn_vn, $sql_email);
            $row_email = mysqli_num_rows($result_email);

            if ($row_email > 0) {
                $check = "false";
                $message .= "<div class='alert alert-danger'>Email đã tồn tại</div>";
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
                $sql = "INSERT INTO ung_vien (name, email, phone, born, birthday, sex, password, type, image, `time`) VALUES ('$name', '$email', '$phone', '$born', '$birthday', $sex, '$pass', 0, '$image', '$time')";
                $result = mysqli_query($conn_vn, $sql);
                if ($result) {
                    $sql_user = "SELECT * FROM ung_vien Where email = '$email'";
                    $result_user = mysqli_query($conn_vn, $sql_user);
                    $row_user = mysqli_fetch_assoc($result_user);
                    $_SESSION['user_id_gbvn'] = $row_user['id'];
                    $_SESSION['user_email_gbvn'] = $row_user['email'];
                    $_SESSION['user_name_gbvn'] = $row_user['name'];
                    $_SESSION['user_type_gbvn'] = 2;
                    echo '<script type="text/javascript">alert(\'Bạn đã đăng ký thành công!\')</script>';
                } else {
                    echo '<script type="text/javascript">alert(\'Có lỗi xảy ra!\')</script>';
                }
            }
        }
    }
    dang_ky();

    function cap_nhat ($id) {
        global $message;
        global $conn_vn;
        if (isset($_POST['edit_ungvien'])) {
            $src= "images/";
            $image = '';

            if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
                $image = time().$_FILES['image']['name'];
                uploadPicture($src, $image, $_FILES['image']['tmp_name']);
            }

            $name = $_POST['name'];
            // $phone = $_POST['phone'];
            $born = '';
            // $birthday = $_POST['birthday'];
            $sex = $_POST['sex'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $check = 'true';

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
            $birthday = $_POST['year'].'-'.$month.'-'.$day;

            if ($pass1 != $pass2) {
                $check = "false";
                $message .= "<div class='alert alert-danger'>Mật khẩu không khớp</div>";
            }

            if ($check == "true") {
                if ($pass1 != '' && $pass2 != '') {
                    $pass = password_hash($pass1, PASSWORD_DEFAULT);
                    if ($image == '') {
                        $sql = "UPDATE ung_vien SET name = '$name', born = '$born', birthday = '$birthday', sex = $sex, password = '$pass' WHERE id = $id";
                    } else {
                        $sql = "UPDATE ung_vien SET name = '$name', born = '$born', birthday = '$birthday', sex = $sex, image = '$image', password = '$pass' WHERE id = $id";
                    }
                } else {
                    if ($image == '') {
                        $sql = "UPDATE ung_vien SET name = '$name', born = '$born', birthday = '$birthday', sex = $sex WHERE id = $id";
                    } else {
                        $sql = "UPDATE ung_vien SET name = '$name', born = '$born', birthday = '$birthday', sex = $sex, image = '$image' WHERE id = $id";
                    }
                }
                $result = mysqli_query($conn_vn, $sql);
                if ($result) {
                    echo '<script type="text/javascript">alert(\'Bạn đã cập nhật thành công!\')</script>';
                } else {
                    echo '<script type="text/javascript">alert(\'Có lỗi xảy ra!\')</script>';
                }
            }
        }
    }

    if (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 2) {
        $loai_ungvien = 1;
        cap_nhat($_SESSION['user_id_gbvn']);
        $info = $action->getDetail('ung_vien', 'id', $_SESSION['user_id_gbvn']);//var_dump($info);
        if ($info['type']==1) {
            header('location: /dang-ky-ung-vien-pho-thong');
        }
        $name = $info['name'];
        $email = $info['email'];
        $phone = $info['phone'];
        $born = $info['born'];
        $birthday = $info['birthday'];
        $birthday = explode("-", $birthday);//var_dump($birthday);die;
        $sex = (int)$info['sex'];
        $list_don_tuyen = $action->getList('ung_tuyen', 'ung_vien_id', $_SESSION['user_id_gbvn']);
    } else {
        $loai_ungvien = 0;
        $name = '';
        $email = '';
        $phone = '';
        $born = '';
        $birthday = '0000-00-00';
        $birthday = explode("-", $birthday);
        $sex = '';
    }

    function set_time_ungvien () {
        global $conn_vn;
        $id = $_SESSION['user_id_gbvn'];
        $time = date("Y-m-d H:i:s");
        $sql = "UPDATE ung_vien SET `time` = '$time' WHERE id = $id";
        $result = mysqli_query($conn_vn, $sql);
    }

    function add_hoso () {
        set_time_ungvien();
        global $conn_vn;
        $action = new action();
        if (isset($_POST['add_hoso'])) {
            // var_dump($_POST);
            $src= "images/cv/";
            $cv = '';

            if(isset($_FILES['cv']) && $_FILES['cv']['name'] != ""){
                $cv = time().$_FILES['cv']['name'];
                uploadPicture($src, $cv, $_FILES['cv']['tmp_name']);

            }

            $school = $_POST['school'];
            $career = $_POST['career'];
            $year = $_POST['year'];
            $skill = $_POST['skill'];
            $work_progress = $_POST['work_progress'];
            $experience = $_POST['experience'];
            $salary = $_POST['salary'];
            $form = $_POST['form'];
            $address = $_POST['address'];
            $ung_vien_id = $_SESSION['user_id_gbvn'];
            $position = $_POST['position'];
            $level = $_POST['level'];
            $item = $_POST['item'];
            // $item = implode(',', $item);
            $item = json_encode($item);
            $hon_nhan = $_POST['hon_nhan'];
            $dia_diem = $_POST['dia_diem'];
            // $dia_diem = implode(',', $dia_diem);
            $dia_diem = json_encode($dia_diem);
            $alias = $_POST['alias'];
            $xep_loai = $_POST['xep_loai'];
            $muc_tieu = $_POST['muc_tieu'];
            $loai_nganh = $_POST['loai_nganh'];
            $office = $_POST['office'];

            $ngoai_ngu_tin_hoc = $_POST['ngoai_ngu_tin_hoc'];

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
            $ngay = $_POST['nam'].'-'.$month.'-'.$day;

            $count_hoso = $action->getList('ho_so', 'ung_vien_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
            $count_hoso = count($count_hoso);
            if ($count_hoso > 0) {
                echo '<script type="text/javascript">alert(\'Bạn đã tạo hồ sơ rồi!\')</script>';
            } else {
                $sql = "INSERT INTO ho_so (ung_vien_id, school, career, year, skill, work_progress, experience, salary, form, address, cv, position, level, item, hon_nhan, dia_diem, alias, created_at, xep_loai, muc_tieu, loai_nganh, ngoai_ngu_tin_hoc, office) VALUES ($ung_vien_id, '$school', '$career', '$year', '$skill', '$work_progress', '$experience', '$salary', $form, '$address', '$cv', '$position', '$level', '$item', $hon_nhan, '$dia_diem', '$alias', '$ngay', '$xep_loai', '$muc_tieu', $loai_nganh, '$ngoai_ngu_tin_hoc', $office)";
                $result = mysqli_query($conn_vn, $sql);
                if ($result) {
                    echo '<script type="text/javascript">alert(\'Bạn tạo hồ sơ thành công!\');window.location.href="/";</script>';
                } else {
                    echo '<script type="text/javascript">alert(\'Có lỗi xảy ra!\')</script>';
                }
            }            
        }
    }
    add_hoso();

    function edit_hoso ($id) {
        set_time_ungvien();
        global $conn_vn;
        if (isset($_POST['edit_hoso'])) {
            $src= "images/cv/";
            $cv = '';

            if(isset($_FILES['cv']) && $_FILES['cv']['name'] != ""){
                $cv = time().$_FILES['cv']['name'];
                uploadPicture($src, $cv, $_FILES['cv']['tmp_name']);

            }

            $school = $_POST['school'];
            $career = $_POST['career'];
            $year = $_POST['year'];
            $skill = $_POST['skill'];
            $work_progress = $_POST['work_progress'];
            $experience = $_POST['experience'];
            $salary = $_POST['salary'];
            $form = $_POST['form'];
            $address = $_POST['address'];
            // $ung_vien_id = $_SESSION['user_id_gbvn'];
            $position = $_POST['position'];
            $level = $_POST['level'];
            $item = $_POST['item'];
            // $item = implode(',', $item);
            $item = json_encode($item);
            $hon_nhan = $_POST['hon_nhan'];
            $dia_diem = $_POST['dia_diem'];
            // $dia_diem = implode(',', $dia_diem);
            $dia_diem = json_encode($dia_diem);
            $alias = $_POST['alias'];
            $xep_loai = $_POST['xep_loai'];
            $muc_tieu = $_POST['muc_tieu'];
            $loai_nganh = $_POST['loai_nganh'];
            $office = $_POST['office'];

            $ngoai_ngu_tin_hoc = $_POST['ngoai_ngu_tin_hoc'];

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
            $ngay = $_POST['nam'].'-'.$month.'-'.$day;

            if ($cv == '') {
                $sql = "UPDATE ho_so SET school = '$school', career = '$career', year = '$year', skill = '$skill', work_progress = '$work_progress', experience = '$experience', salary = '$salary', form = $form, address = '$address', position = '$position', level = '$level', item = '$item', hon_nhan = $hon_nhan, dia_diem = '$dia_diem', alias = '$alias', created_at = '$ngay', xep_loai = '$xep_loai', muc_tieu = '$muc_tieu', loai_nganh = $loai_nganh, ngoai_ngu_tin_hoc = '$ngoai_ngu_tin_hoc', office = $office WHERE ung_vien_id = $id";
            } else {
                $sql = "UPDATE ho_so SET school = '$school', career = '$career', year = '$year', skill = '$skill', work_progress = '$work_progress', experience = '$experience', salary = '$salary', form = $form, address = '$address', position = '$position', level = '$level', item = '$item', hon_nhan = $hon_nhan, dia_diem = '$dia_diem', alias = '$alias', created_at = '$ngay', xep_loai = '$xep_loai', muc_tieu = '$muc_tieu', loai_nganh = $loai_nganh, ngoai_ngu_tin_hoc = '$ngoai_ngu_tin_hoc', office = $office, cv = '$cv' WHERE ung_vien_id = $id";
            }

            $result = mysqli_query($conn_vn, $sql);
            if ($result) {
                echo '<script type="text/javascript">alert(\'Bạn cập nhật hồ sơ thành công!\')</script>';
            } else {
                echo '<script type="text/javascript">alert(\'Có lỗi xảy ra!\')</script>';
            }
        }
    }

    if (isset($_SESSION['user_id_gbvn'])) {
        edit_hoso($_SESSION['user_id_gbvn']);
        $count_hoso = $action->getList('ho_so', 'ung_vien_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
        $count_hoso = count($count_hoso);
        if ($count_hoso > 0) {
            $info_hoso = $action->getDetail('ho_so', 'ung_vien_id', $_SESSION['user_id_gbvn']);
            $position = $info_hoso['position'];
            $school = $info_hoso['school'];
            $career = $info_hoso['career'];
            $year_hs = $info_hoso['year'];
            $skill = $info_hoso['skill'];
            $work_progress = $info_hoso['work_progress'];
            $experience = $info_hoso['experience'];
            $salary = $info_hoso['salary'];
            $form = $info_hoso['form'];
            $address = $info_hoso['address'];
            $cv = $info_hoso['cv'];
            $level = $info_hoso['level'];
            $item1 = $info_hoso['item'];
            // $item1 = explode(',', $item1);
            $item1 = json_decode($item1);
            $hon_nhan = $info_hoso['hon_nhan'];
            $dia_diem = $info_hoso['dia_diem'];
            // $dia_diem = explode(',', $dia_diem);
            $dia_diem = json_decode($dia_diem);
            $alias = $info_hoso['alias'];
            $created_at = $info_hoso['created_at'];
            $created_at = explode("-", $created_at);
            $xep_loai = $info_hoso['xep_loai'];
            $muc_tieu = $info_hoso['muc_tieu'];
            $type_career = $info_hoso['loai_nganh'];
            $ngoai_ngu_tin_hoc = $info_hoso['ngoai_ngu_tin_hoc'];
            $chuc_vu = $info_hoso['office'];
        } else {
            $position = '';
            $school = '';
            $career = '';
            $year_hs = '';
            $skill = '';
            $work_progress = '';
            $experience = '';
            $salary = '';
            $form = 0;
            $address = '';
            $cv = '';
            $level = '';
            $item1 = '';
            $hon_nhan = '';
            $dia_diem = '';
            $alias = '';
            $created_at = date('Y-m-d');
            $created_at = explode("-", $created_at);
            $xep_loai = '';
            $muc_tieu = '';
            $type_career = 0;
            $ngoai_ngu_tin_hoc = '';
            $chuc_vu = '';
        }
    } else {
        $position = '';
        $school = '';
        $career = '';
        $year_hs = '';
        $skill = '';
        $work_progress = '';
        $experience = '';
        $salary = '';
        $form = 0;
        $address = '';
        $cv = '';
        $level = '';
        $item1 = '';
        $hon_nhan = '';
        $dia_diem = '';
        $alias = '';
        $created_at = date('Y-m-d');
        $created_at = explode("-", $created_at);
        $xep_loai = '';
        $muc_tieu = '';
        $type_career = 0;
        $ngoai_ngu_tin_hoc = '';
        $chuc_vu = '';
    }
    
    $list_career = $action->getList('career', '', '', 'id', 'asc', '', '', '');
    $list_location = $action->getList('location', '', '', 'id', 'asc', '', '', '');
    $loai_nganh = $action->getList('loai_nganh', '', '', 'id', 'asc', '', '', '');
    $ngoai_ngu = $action->getList('ngoai_ngu_1', '', '', 'id', 'asc', '', '', '');
    $search_name = array();
    foreach ($list_location as $key => $row)
    {
        $search_name[$key] = $row['name'];
    }
    // array_multisort($search_name, SORT_ASC, $list_location);

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
</style>
<div id="output"></div>
<div class="gb-dangky-ungvien">
    <div class="container">
        <h1>Ứng viên có bằng cấp đăng ký việc làm</h1>
        <div class="gb-dangky-tuyendung-head">
            <!-- <h2>Thông tin ứng viên</h2> -->
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <?= $message ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    
                                </div>
                                <div class="col-sm-8">
                                    <?php if ($loai_ungvien == 1) { ?>
                                        <img src="/images/<?= $info['image']!='' ? $info['image'] : 'no-photo.png' ?>" alt="" width="100">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Ảnh đại diện</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="file" name="image" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Họ và tên <span style="color:Magenta;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="name" value="<?= $name ?>" class="form-control" required >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Ngày sinh <span style="color:Magenta;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <select name="day" class="form-control" required>
                                                <option value=""> -- Ngày --</option>
                                                <?php for ($i=1;$i<=31;$i++) { ?>
                                                <option value="<?= $i ?>" <?= $birthday[2]==$i ? 'selected' : '' ?> ><?= $i<10 ? '0' : '' ?><?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="month" class="form-control" required>
                                                <option value=""> -- Tháng --</option>
                                                <?php for ($i=1;$i<=12;$i++) { ?>
                                                <option value="<?= $i ?>" <?= $birthday[1]==$i ? 'selected' : '' ?> ><?= $i<10 ? '0' : '' ?><?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="year" class="form-control" required>
                                                <option value=""> -- Năm --</option>
                                                <?php 
                                                $year = date('Y');
                                                for ($i=1960;$i<=$year;$i++) { ?>
                                                <option value="<?= $i ?>" <?= $birthday[0]==$i ? 'selected' : '' ?> ><?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Địa chỉ <span style="color:Magenta;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="born" value="<?= $born ?>" class="form-control" required >
                                </div>
                            </div>
                        </div> -->
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Giới tính <span style="color:Magenta;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="sex" id="sex" class="form-control" required >
                                        <option value="">----Chọn giới tính----</option>
                                        <option value="1" <?= $sex==1 ? 'selected' : '' ?> >Nam</option>
                                        <option value="0" <?= $sex===0 ? 'selected' : '' ?> >Nữ</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Điện thoại <span style="color:Magenta;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="tel" name="phone" value="<?= $phone ?>" class="form-control" <?= $loai_ungvien == 1 ? 'readonly' : 'required' ?> >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Email <span style="color:Magenta;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="email" name="email" value="<?= $email ?>" class="form-control"  <?= $loai_ungvien == 1 ? 'readonly' : 'required' ?>  >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Mật khẩu <span style="color:Magenta;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="password" name="pass1" class="form-control"  <?= $loai_ungvien == 1 ? '' : 'required' ?>  >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Đánh lại mật khẩu <span style="color:Magenta;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="password" name="pass2" class="form-control"  <?= $loai_ungvien == 1 ? '' : 'required' ?>  >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    
                                </div>
                                <div class="col-sm-8">
                                    
                                    <?php if ($loai_ungvien == 1) { ?>
                                    <input type="submit" name="edit_ungvien" value="Cập nhật" class="form-control btn-capnhattintuyendung">
                                    <?php } else { ?>
                                    <input type="submit" name="ungvien" value="Đăng ký" class="form-control btn-capnhattintuyendung" required >
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php if (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 2) { ?>
    <div class="container">
        <div class="gb-dangky-tuyendung-info">
            <h2>Thông tin hồ sơ</h2>

            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Vị trí ứng tuyển <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="position" id="position" value="<?= $position ?>" class="form-control" onchange="ChangeToSlug()" required>
                                    <input type="hidden" name="alias" id="alias" value="<?= $alias ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Tốt nghiêp trường <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="school" value="<?= $school ?>" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Chuyên ngành học <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="career" value="<?= $career ?>" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Trình độ <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="level" id="level" class="form-control" required>
                                        <option value="">-- Chọn trình độ --</option>
                                        <option value="1" <?= $level==1 ? 'selected' : '' ?> >Trung cấp</option>
                                        <option value="2" <?= $level==2 ? 'selected' : '' ?> >Cao đẳng</option>
                                        <option value="3" <?= $level==3 ? 'selected' : '' ?> >Đại học</option>
                                        <option value="4" <?= $level==4 ? 'selected' : '' ?> >Thạc sĩ</option>
                                        <option value="5" <?= $level==5 ? 'selected' : '' ?> >Tiến sĩ</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Khóa học <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="year" value="<?= $year_hs ?>" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Xếp loại <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="xep_loai" value="<?= $xep_loai ?>" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Tình trạng hôn nhân <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="hon_nhan" id="hon_nhan" class="form-control" required>
                                        <option value="" >-- Chọn tình trạng hôn nhân -- </option>
                                        <option value="1" <?= $hon_nhan==1 ? 'selected' : '' ?> >Độc thân</option>
                                        <option value="2" <?= $hon_nhan==2 ? 'selected' : '' ?> >Đã kết hôn</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Kinh nghiệm <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    
                                    <select name="experience" id="experience" class="form-control" required>
                                        <option value="">-- Chọn kinh nghiệm -- </option>
                                        <option value="1" <?= $experience==1 ? 'selected' : '' ?> >Chưa có</option>
                                        <option value="2" <?= $experience==2 ? 'selected' : '' ?> >Dưới 1 năm</option>
                                        <option value="3" <?= $experience==3 ? 'selected' : '' ?> >1 năm</option>
                                        <option value="4" <?= $experience==4 ? 'selected' : '' ?> >2 năm</option>
                                        <option value="5" <?= $experience==5 ? 'selected' : '' ?> >3 năm</option>
                                        <option value="6" <?= $experience==6 ? 'selected' : '' ?> >4 năm</option>
                                        <option value="7" <?= $experience==7 ? 'selected' : '' ?> >5 năm</option>
                                        <option value="8" <?= $experience==8 ? 'selected' : '' ?> >6 năm</option>
                                        <option value="9" <?= $experience==9 ? 'selected' : '' ?> >7 năm</option>
                                        <option value="10" <?= $experience==10 ? 'selected' : '' ?> >8 năm</option>
                                        <option value="11" <?= $experience==11 ? 'selected' : '' ?> >9 năm</option>
                                        <option value="12" <?= $experience==12 ? 'selected' : '' ?> >10 năm</option>
                                        <option value="13" <?= $experience==13 ? 'selected' : '' ?> >Trên 10 năm</option>
                                    </select>
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
                                        <option value=""> -- Chọn hình thức làm việc --</option>
                                        <option value="1" <?= $form==1 ? 'selected' : '' ?> >Toàn thời gian</option>
                                        <option value="2" <?= $form==2 ? 'selected' : '' ?> >Bán thời gian</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Loại ngành nghề <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="loai_nganh" id="loai_nganh" class="form-control" required>
                                        <option value="" >-- Chọn loại ngành nghề -- </option>
                                        <?php foreach ($loai_nganh as $item) { ?>
                                        <option value="<?= $item['id'] ?>" <?= $item['id']==$type_career ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Ngoại ngữ <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="ngoai_ngu_tin_hoc" id="ngoai_ngu_tin_hoc" class="form-control" required>
                                        <option value="" >-- Chọn ngoại ngữ -- </option>
                                        <?php foreach ($ngoai_ngu as $item) { ?>
                                        <option value="<?= $item['id'] ?>" <?= $item['id']==$ngoai_ngu_tin_hoc ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Chức vụ <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="office" id="office" class="form-control" required>
                                        <option value="" >-- Chọn chức vụ -- </option>
                                        <?php foreach ($office as $item) { ?>
                                        <option value="<?= $item['id'] ?>" <?= $item['id']==$chuc_vu ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Kỹ năng của bản thân <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="skill" rows="5" required><?= $skill ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Kinh nghiệm làm việc <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <span style="color: #19a05e;">Tăng 40% hiệu quả khi tạo phần KN hấp dẫn</span>
                                    <textarea class="form-control" name="work_progress" rows="8" placeholder="Hãy tạo phần kinh nghiệm hấp dẫn để chinh phục mọi nhà tuyển dụng" required><?= $work_progress ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Mục tiêu nghề nghiệp <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="muc_tieu" rows="5" required><?= $muc_tieu ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Lương mong muốn <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <!-- <input type="text" name="salary" value="<?= $salary ?>" class="form-control" placeholder="Ví dụ: 5-7 triệu" required> -->
                                    <select name="salary" class="form-control" required="">
                                        <option value="">----Chọn Mức lương----</option>
                                        <?php foreach ($luong as $item) { ?>
                                        <option value="<?= $item['id'] ?>" <?= $item['id']==$salary ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Vị trí đăng tin ứng tuyển<span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="item[]" id="item" class="form-control chosen-select" data-placeholder="--Chọn 2 vị trí ứng tuyển--" multiple required >
                                        <option value="">----Chọn mục đăng tin----</option>
                                        <?php foreach ($list_career as $item) { ?>
                                        <option value="<?= $item['id'] ?>" <?= in_array($item['id'], $item1) ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>                    
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Địa chỉ liên hệ <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="address" value="<?= $address ?>" class="form-control" placeholder="Ghi rõ địa chỉ đang ở" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Địa điểm làm việc <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="dia_diem[]" id="dia_diem" class="form-control chosen-select-1" data-placeholder="Chọn địa điểm làm việc" multiple required >
                                        <option value="">----Chọn địa điểm----</option>
                                        <option value="72" <?= in_array(72, $dia_diem) ? 'selected' : '' ?> >Hà Nội</option>
                                        <option value="71" <?= in_array(71, $dia_diem) ? 'selected' : '' ?> >Hồ Chí Minh</option>
                                        <?php foreach ($list_location as $item) { 
                                            if ($item['id'] == 71 || $item['id'] == 72) { } else {
                                        ?>
                                        <option value="<?= $item['id'] ?>" <?= in_array($item['id'], $dia_diem) ? 'selected' : '' ?> ><?= $item['name'] ?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Ngày tạo <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <select name="day" class="form-control" required>
                                                <option> -- Ngày --</option>
                                                <?php for ($i=1;$i<=31;$i++) { ?>
                                                <option value="<?= $i ?>" <?= $created_at[2]==$i ? 'selected' : '' ?> ><?= $i<10 ? '0' : '' ?><?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="month" class="form-control" required>
                                                <option> -- Tháng --</option>
                                                <?php for ($i=1;$i<=12;$i++) { ?>
                                                <option value="<?= $i ?>" <?= $created_at[1]==$i ? 'selected' : '' ?> ><?= $i<10 ? '0' : '' ?><?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="nam" class="form-control" required>
                                                <option> -- Năm --</option>
                                                <?php 
                                                $year = date('Y');
                                                for ($i=1960;$i<=$year;$i++) { ?>
                                                <option value="<?= $i ?>" <?= $created_at[0]==$i ? 'selected' : '' ?> ><?= $i ?></option>
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
                                    <label>CV đính kèm</label>
                                </div>
                                <div class="col-sm-8">
                                    <?php if (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 2) { ?>
                                    <input type="file" name="cv" class="form-control" <?= $count_hoso > 0 ? '' : '' ?> >
                                    <?php if ($cv != '') { ?>
                                    <a href="/images/cv/<?= $cv ?>" download >Download</a>
                                    <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    
                                </div>
                                <div class="col-sm-8">
                                    <?php 
                                    if (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 2) { 
                                        if ($count_hoso > 0) { 
                                    ?>
                                    <input type="submit" name="edit_hoso" value="CẬP NHẬT HỒ SƠ" class="form-control" style="font-weight: bold;" onclick="set_hoso()">
                                    <?php } else { ?>
                                    <input type="submit" name="add_hoso" value="TẠO HỒ SƠ" class="form-control"  style="font-weight: bold;" onclick="set_hoso()">
                                    <?php } } ?>
                                    <p style="text-align: center;color: #1790d4;font-size: 15px;font-style: italic;margin-top: 10px;">* vieclam12h.vn cảm ơn bạn đã sử dụng dịch vụ</p>

                                    <!-- <p><a href="/images/mau_cv/Avt CV 1-01.jpg" download>Mẫu CV 1</a></p>
                                    <p><a href="/images/mau_cv/Avt CV 2-02.jpg" download>Mẫu CV 2</a></p>
                                    <p><a href="/images/mau_cv/Avt CV 3-03.jpg" download>Mẫu CV 3</a></p>
                                    <p><a href="/images/mau_cv/Avt CV 4-04.jpg" download>Mẫu CV 4</a></p> -->
                                    <!-- <p><a href="/cv1/index.php?id=<?= $_SESSION['user_id_gbvn'] ?>" target="_blank">Tải mẫu CV</a></p> -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<?php } ?>
<?php include DIR_OTHER . "MS_OTHER_VIECLAM_0009.php"; ?>
    <?php if ($loai_ungvien == 1) { ?>
    <div class="container">
      <h2>Danh sách đơn tuyền dụng</h2>
               
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Vị chí tuyển dụng</th>
            <th>Chuyên ngành</th>
            <th>Chí tiết</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($list_don_tuyen as $item) { 
            $don = $action->getDetail('thong_tin_tuyen_dung', 'id', $item['thong_tin_tuyen_dung_id']);
        ?>
          <tr>
            <td><?= $don['position'] ?></td>
            <td><?= $action->getDetail('career', 'id', $don['career'])['name'] ?></td>
            <td><a href="/thong-tin-tuyen-dung/<?= $don['id'] ?>">Chi tiết</a></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
    <?php } ?>
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
$(".chosen-select").chosen({max_selected_options: 2});
$(".chosen-select-1").chosen({max_selected_options: 2});
//# sourceURL=pen.js
</script>
<script type="text/javascript">
    function set_hoso () {
        var item = document.getElementById("item").value;
        var dia_diem = document.getElementById("dia_diem").value;
        if (item == '') {
            alert('Bạn chưa chọn vị trí đăng tin ứng tuyển.');
            return false;
        }

        if (dia_diem == '') {
            alert('Bạn chưa chọn địa điểm làm việc.');
            return false;
        }
    }
</script>