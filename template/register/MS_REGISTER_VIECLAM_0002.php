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
        if (isset($_POST['dangky'])) {
            $src= "images/";
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
            $quy_mo = $_POST['quy_mo'];
            $website = $_POST['website'];
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
                $sql = "INSERT INTO nha_tuyen_dung (company, name, email, phone, address, password, image, quy_mo, website) VALUES ('$company', '$name', '$email', '$phone', '$address', '$pass', '$image', '$quy_mo', '$website')";
                $result = mysqli_query($conn_vn, $sql);
                if ($result) {
                    $sql_user = "SELECT * FROM nha_tuyen_dung Where email = '$email'";
                    $result_user = mysqli_query($conn_vn, $sql_user);
                    $row_user = mysqli_fetch_assoc($result_user);
                    $_SESSION['user_id_gbvn'] = $row_user['id'];
                    $_SESSION['user_email_gbvn'] = $row_user['email'];
                    $_SESSION['user_name_gbvn'] = $row_user['company'];
                    $_SESSION['user_type_gbvn'] = 1;
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
        if (isset($_POST['edit_nhatuyen'])) {
            $src= "images/";
            $image = '';

            if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
                $image = time().$_FILES['image']['name'];
                uploadPicture($src, $image, $_FILES['image']['tmp_name']);

            }

            $company = $_POST['company'];
            $name = $_POST['name'];
            // $phone = $_POST['phone'];
            $address = $_POST['address'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $quy_mo = $_POST['quy_mo'];
            $website = $_POST['website'];
            $check = 'true';

            if ($pass1 != $pass2) {
                $check = "false";
                $message .= "<div class='alert alert-danger'>Mật khẩu không khớp</div>";
            }

            if ($check == "true") {
                if ($pass1 != '' && $pass2 != '') {
                    $pass = password_hash($pass1, PASSWORD_DEFAULT);
                    if ($image == '') {
                        $sql = "UPDATE nha_tuyen_dung SET company = '$company', name = '$name', address = '$address', quy_mo = '$quy_mo', website = '$website', password = '$pass' WHERE id = $id";
                    } else {
                        $sql = "UPDATE nha_tuyen_dung SET company = '$company', name = '$name', address = '$address', quy_mo = '$quy_mo', website = '$website', password = '$pass', image = '$image' WHERE id = $id";
                    }
                } else {
                    if ($image == '') {
                        $sql = "UPDATE nha_tuyen_dung SET company = '$company', name = '$name', address = '$address', quy_mo = '$quy_mo', website = '$website' WHERE id = $id";
                    } else {
                        $sql = "UPDATE nha_tuyen_dung SET company = '$company', name = '$name', address = '$address', quy_mo = '$quy_mo', website = '$website', image = '$image' WHERE id = $id";
                    }
                }

                $result = mysqli_query($conn_vn, $sql);
                if ($result) {
                    echo '<script type="text/javascript">alert(\'Cập nhật thành công!\')</script>';
                } else {
                    echo '<script type="text/javascript">alert(\'Có lỗi xảy ra!\')</script>';
                }
            }
        }
    }

    function them_tuyen_dung ($id) {
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
            // $ngay = $_POST['ngay'];
            $office = $_POST['office'];
            $brief = $_POST['brief'];
            $alias = $_POST['alias'];
            $chuyen_nganh = '';
            $created_at = date("Y-m-d");

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
            $ngay = $_POST['year'].'-'.$month.'-'.$day;//echo $ngay;die;

            if ($age == '') {
                // $age = 0;
            }

            if (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 1) {

            } else {
                echo '<script type="text/javascript">alert(\'Bạn chưa đăng nhập!\')</script>';
                return false;
            }

            $sql = "INSERT INTO thong_tin_tuyen_dung (nha_tuyen_dung_id, position, career, level, quatity, sex, form, experience, age, note, benefit, location, request, salary, ngay, office, brief, alias, chuyen_nganh, created_at, `time`, ngoai_ngu_tin_hoc) VALUES ($id, '$position', '$career', $level, $quatity, $sex, $form, $experience, '$age', '$note', '$benefit', '$location', '$request', '$salary', '$ngay', $office, '$brief', '$alias', '$chuyen_nganh', '$created_at', '$time', '$ngoai_ngu_tin_hoc')";
            // echo $sql;
            $result = mysqli_query($conn_vn, $sql);
            if ($result) {
                echo '<script type="text/javascript">alert(\'Bạn đã tạo thông tin tuyển dụng thành công!\')</script>';
            } else {
                echo '<script type="text/javascript">alert(\'Có lỗi xảy ra!\')</script>';
                // echo mysqli_error($conn_vn);
            }
        }
    }
    them_tuyen_dung($_SESSION['user_id_gbvn']);

    if (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 1) {
        $loai_nhatuyendung = 1;
        cap_nhat($_SESSION['user_id_gbvn']);
        $info = $action->getDetail('nha_tuyen_dung', 'id', $_SESSION['user_id_gbvn']);
        $company = $info['company'];
        $name = $info['name'];
        $email = $info['email'];
        $phone = $info['phone'];
        $address = $info['address'];
        $quy_mo = $info['quy_mo'];
        $website = $info['website'];
        
        $list_don_tuyen = $action->getList('thong_tin_tuyen_dung', 'nha_tuyen_dung_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
        $list_ung_vien = $action->getList('ung_tuyen', 'nha_tuyen_dung_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
        $book_diem = $action->getList('book_diem', 'nha_tuyen_dung_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
        $book_home_time = $action->getList('book_home_time', 'ntd_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
        $book_tuyen_time = $action->getList('book_tuyen_time', 'ntd_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
    } else {
        $loai_nhatuyendung = 0;
        $company = '';
        $name = '';
        $email = '';
        $phone = '';
        $address = '';
        $quy_mo = '';
        $website = '';
    }

    $list_career = $action->getList('career', '', '', 'id', 'asc', '', '', '');
    $list_location = $action->getList('location', '', '', 'id', 'asc', '', '', '');
    $list_office = $action->getList('office', '', '', 'id', 'asc', '', '', '');
    $ngoai_ngu = $action->getList('ngoai_ngu', '', '', 'id', 'asc', '', '', '');
    $level = $action->getList('level_2', '', '', 'id', 'asc', '', '', '');
    $search_name = array();
    foreach ($list_location as $key => $row)
    {
        $search_name[$key] = $row['name'];
    }
    // array_multisort($search_name, SORT_ASC, $list_location);
    // $list_location = array_merge(array(71 => $list_location[71]) + $list_location);
    $luong = $action->getList('luong', '', '', 'id', 'asc', '', '', '');

    ///////////////////////////

?>
<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" /> -->
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
        <h1>Nhà tuyển dụng đăng ký tài khoản</h1>
        <div class="gb-dangky-tuyendung-head">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <?= $message ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    
                                </div>
                                <div class="col-sm-4">
                                    <?php if ($loai_nhatuyendung == 1) { ?>
                                        <img src="/images/<?= $info['image']!='' ? $info['image'] : 'no-photo.png' ?>" alt="" width="100" style="float: right;width: 27%;">
                                    <?php } ?>
                                </div>
                                <div class="col-sm-4">
                                    <a href="https://www.google.com/maps/place/<?= str_replace(" ", "+", $address) ?>"><img src="/images/icons/map.png" alt="" style="width: 42px;"></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Logo công ty</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="file" name="image" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Tên công ty <span style="color:Magenta;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="company" class="form-control" value="<?= $company ?>" required >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Địa chỉ <span style="color:Magenta;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="address" class="form-control" value="<?= $address ?>" required >
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Google map </label>
                                </div>
                                <div class="col-sm-8">
                                    
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Quy mô<span style="color:Magenta;"></span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="quy_mo" class="form-control" value="<?= $quy_mo ?>" placeholder="Ví dụ: 10-20 người">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Website <span style="color:Magenta;"></span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="website" class="form-control" value="<?= $website ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Người liên hệ <span style="color:Magenta;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="form-control" value="<?= $name ?>" required >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Điện thoại <span style="color:Magenta;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="tel" name="phone" class="form-control" value="<?= $phone ?>" <?= $loai_nhatuyendung == 1 ? 'readonly' : 'required' ?> >
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Email <span style="color:Magenta;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="email" name="email" class="form-control" value="<?= $email ?>" <?= $loai_nhatuyendung == 1 ? 'readonly' : 'required' ?> >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Mật khẩu <span style="color:Magenta;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="password" name="pass1" class="form-control" <?= $loai_nhatuyendung == 1 ? '' : 'required' ?>  >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Đánh lại mật khẩu <span style="color:Magenta;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="password" name="pass2" class="form-control" <?= $loai_nhatuyendung == 1 ? '' : 'required' ?>  >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    
                                </div>
                                <div class="col-sm-8 btn-dangkynhatuyendung">
                                    <?php if ($loai_nhatuyendung == 1) { ?>
                                    <input type="submit" name="edit_nhatuyen" value="Cập nhật" class="form-control">
                                    <?php } else { ?>
                                    <input type="submit" name="dangky" value="Đăng ký" class="form-control">
                                    <?php } ?>
                                    <p style="margin-top: 15px;color: #dcdcdc;text-align: center;font-size: 14px;">* Tôi đồng ý các điều khoản của vieclam12h.vn</p>
                                </div> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
<?php if (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 1) { ?>
    <div class="container" style="display: none;">
        <div class="row">
            <div class="col-md-3">
                <div style="background: #f1f1f1;padding: 10px;">
                    <h2><a href="/mua-diem">Số điểm</a></h2>
                    <h2><?= $info['diem'] ?></h2>
                </div>
            </div>
            <div class="col-md-3">
                <div style="background: #f1f1f1;padding: 10px;">
                    <h2>Việc làm đã đăng</h2>
                    <h2><?= count($list_don_tuyen) ?></h2>
                </div>
            </div>
            <div class="col-md-3">
                <div style="background: #f1f1f1;padding: 10px;">
                    <h2>Lượt xem hồ sơ</h2>
                    <h2><?= $info['xem_ho_so'] ?></h2>
                </div>
            </div>
            <div class="col-md-3">
                <div style="background: #f1f1f1;padding: 10px;">
                    <h2><a href="/bang-gia">Gói bảng giá</a></h2>
                    <h2>&nbsp;</h2>
                </div>
            </div>
        </div>

        <div style="margin-top: 20px;">
            <h2>Các gói đã mua</h2>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Tên gói</th>
                    <th>Giá</th>
                    <th>Kích hoạt</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                foreach ($book_diem as $item) { 
                    $goi = $action->getDetail('goi_diem', 'id', $item['goi_diem_id']);
                ?>
                  <tr>
                    <td>Điểm</td>
                    <td><?= number_format($goi['gia']) ?> đ</td>
                    <td><?= $item['state']==0 ? 'Chưa kích hoạt' : 'Đã kích hoạt' ?></td>
                  </tr>
                <?php } ?>
                <?php 
                foreach ($book_home_time as $item) { 
                    $goi = $action->getDetail('bang_gia_3', 'id', $item['home_time_id']);
                ?>
                  <tr>
                    <td>Hiện ở trang chủ</td>
                    <td><?= number_format($goi['price']) ?> đ</td>
                    <td><?= $item['state']==0 ? 'Chưa kích hoạt' : 'Đã kích hoạt' ?></td>
                  </tr>
                <?php } ?>
                <?php 
                foreach ($book_tuyen_time as $item) { 
                    $goi = $action->getDetail('bang_gia_4', 'id', $item['tuyen_time_id']);
                ?>
                  <tr>
                    <td>Hiện ở trang tuyển</td>
                    <td><?= number_format($goi['price']) ?> đ</td>
                    <td><?= $item['state']==0 ? 'Chưa kích hoạt' : 'Đã kích hoạt' ?></td>
                  </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <div class="gb-dangky-tuyendung-info">
            <h2>Tạo hồ sơ tuyển dụng</h2>

            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Vị trí tuyển dụng <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="position" id="position" class="form-control" onchange="ChangeToSlug()" required >
                                    <input type="hidden" name="alias" id="alias">
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
                                        <option value="">-- Chọn chức vụ --</option>
                                        <?php foreach ($list_office as $item) { ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
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
                                    <select name="level" id="level" class="form-control" required="">
                                        <option value="">----Chọn trình độ----</option>
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
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Chuyên ngành <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="chuyen_nganh" class="form-control" required >
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
                                        <option value="">--Chọn kinh nghiệm--</option>
                                        <option value="1">Chưa có</option>
                                        <option value="2">Dưới 1 năm</option>
                                        <option value="3">1 năm</option>
                                        <option value="4">2 năm</option>
                                        <option value="5">3 năm</option>
                                        <option value="6">4 năm</option>
                                        <option value="7">5 năm</option>
                                        <option value="8">6 năm</option>
                                        <option value="9">7 năm</option>
                                        <option value="10">8 năm</option>
                                        <option value="11">9 năm</option>
                                        <option value="12">10 năm</option>
                                        <option value="13">Trên 10 năm</option>
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
                                    <input type="number" name="quatity" class="form-control" required  min="1">
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
                                            <label><input type="radio" name="sex" value="1" required>Không yêu cầu</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <label><input type="radio" name="sex" value="2">Nam</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <label><input type="radio" name="sex" value="3">Nữ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Yêu cầu độ tuổi <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="age" class="form-control" required  placeholder="Ví dụ: 20 - 35 tuổi">
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
                                        <option value="">-- Chọn hình thức làm việc --</option>
                                        <option value="1">Toàn thời gian</option>
                                        <option value="2">Bán thời gian</option>
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
                                    <!-- <input type="text" name="salary" class="form-control" required  placeholder="Ví dụ: 5 - 7 triệu"> -->
                                    <select name="salary" class="form-control" required="">
                                        <option value="">----Chọn Mức lương----</option>
                                        <?php foreach ($luong as $item) { ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
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
                                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
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
                                    <textarea class="form-control" name="note" rows="8"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Yêu cầu công việc <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="request" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Quyền lợi <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="benefit" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Yêu cầu hồ sơ <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="brief" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Vị trí đăng tin tuyển dụng <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="career[]" id="career" class="form-control chosen-select" data-placeholder="--Chọn 2 mục đăng tin--" multiple required >
                                        <option value="">----Chọn mục đăng tin----</option>
                                        <?php foreach ($list_career as $item) { ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
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
                                    <select name="location[]" id="location" class="form-control chosen-select-1" data-placeholder="Chọn địa điểm" data-show-subtext="true" data-live-search="true" multiple required >
                                        <option value="">-- Tất cả các địa điểm --</option>
                                        <option value="72">Hà Nội</option>
                                        <option value="71">Hồ Chí Minh</option>
                                        <?php foreach ($list_location as $item) { 
                                            if ($item['id'] == 71 || $item['id'] == 72) { } else {
                                        ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Hạn nôp hồ sơ <span style="color: red;">*</span></label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <select name="day" class="form-control" required>
                                                <option value=""> -- Ngày -- </option>
                                                <?php for ($i=1;$i<=31;$i++) { ?>
                                                <option value="<?= $i ?>"><?= $i<10 ? '0' : '' ?><?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="month" class="form-control" required>
                                                <option value=""> -- Tháng -- </option>
                                                <?php for ($i=1;$i<=12;$i++) { ?>
                                                <option value="<?= $i ?>"><?= $i<10 ? '0' : '' ?><?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="year" class="form-control" required>
                                                <option value=""> -- Năm -- </option>
                                                <?php 
                                                $year = date('Y');
                                                for ($i=$year;$i<=$year+2;$i++) { ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
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
                                    <?php if (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 1) { ?>
                                    <input type="submit" name="add_tuyen_dung" value="Đăng Tin Tuyển" class="form-control btn-capnhattintuyendung" >
                                    <?php } ?>
                                    <h4 class="titlecamon">Vieclam12h - Cảm ơn quý khách hàng đã sử dụng dịch vụ!</h4>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
    <?php if ($loai_nhatuyendung == 1 && false) { ?>
    <div class="container">
      <h2>TIN ĐÃ ĐĂNG</h2>
               
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Vị chí tuyển dụng</th>
            <th>Mục đăng tin</th>
            <th>Sửa tin</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($list_don_tuyen as $item) { ?>
          <tr>
            <td><?= $item['position'] ?></td>
            <td><?php 
            $mucdang = json_decode($item['career']);
            $d = 0;
            foreach ($mucdang as $id) { 
                $d++;
                if ($d==1) {
                    echo $action->getDetail('career', 'id', $id)['name'];
                } else {
                    echo ', '.$action->getDetail('career', 'id', $id)['name'];
                }
            }
            ?></td>
            <td><a href="/don-tuyen-dung/<?= $item['id'] ?>">Sửa tin</a></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>

    <div class="container">
      <h2>Danh sách người ứng tuyển</h2>
               
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Người ứng tuyển</th>
            <th>Chí tiết</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($list_ung_vien as $item) { ?>
          <tr>
            <td><?= $action->getDetail('ung_vien', 'id', $item['ung_vien_id'])['name'] ?></td>
            <td><a href="/thong-tin-ung-tuyen/<?= $item['ung_vien_id'] ?>">Chi tiết</a></td>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script src='/css/chosen/chosen.jquery.js'></script>
<script >
document.getElementById('output').innerHTML = location.search;
$(".chosen-select").chosen({max_selected_options: 2});
$(".chosen-select-1").chosen({max_selected_options: 2});
//# sourceURL=pen.js
</script>