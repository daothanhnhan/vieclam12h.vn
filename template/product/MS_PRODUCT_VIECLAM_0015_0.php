<?php 
    if (!isset($_GET['trang'])) {
        header('location: /');
    }

    function count_views ($id) {
        global $conn_vn;
        $sql = "SELECT * FROM ho_so WHERE ung_vien_id = $id";
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);
        $views = $row['views'];
        $views++;

        $sql = "UPDATE ho_so SET views = $views WHERE ung_vien_id = $id";
        $result = mysqli_query($conn_vn, $sql);
    }
    

    $ung_vien = $action->getDetail('ung_vien', 'id', $_GET['trang']);
    count_views($ung_vien['id']);
    $ho_so = $action->getDetail('ho_so', 'ung_vien_id', $ung_vien['id']);
    // $item['salary'] = $thong_tin['salary'];
    // var_dump($ung_vien);
    $kinh_nghiem = array('rỗng', 'Chưa có', 'Dưới 1 năm', '1 năm', '2 năm', '3 năm', '4 năm', '5 năm', '6 năm', '7 năm', '8 năm', '9 năm', '10 năm', 'Trên 10 năm');
    
    $hinh_thuc = array('rong', 'Toàn thời gian', 'Bán thời gian');
    $gioi_tinh = array('rong', 'Không yêu cầu', 'Nam', 'Nữ');
    $level = array('', 'Trung câp', 'Cao đẳng', 'Đại học', 'Thạc sĩ', 'Tiến sĩ', 'THCS/PTTH', 'Chứng chỉ nghề', 'Bằng lái xe các loại');

    function send_ung_vien () {
        $action_email = new action_email();
        global $action;
        if (isset($_POST['tuyen_ung_vien'])) {
            $name = $_POST['name_uv'];
            $email = $_POST['email_uv'];
            $phone = $_POST['phone'];
            $position = $_POST['position_uv'];

            $nha_tuyen = $action->getDetail('nha_tuyen_dung', 'id', $_SESSION['user_id_gbvn']);

            $don_tuyen = $action->getList('thong_tin_tuyen_dung', 'nha_tuyen_dung_id', $_SESSION['user_id_gbvn'], 'id', 'desc', '', '', '');

            $title = 'Thư mời của nhà tuyển dụng';
            $noidung = '<div style="width: 700px;margin: 0 auto;">
    <div style="border: 0;background-color: #499cd6;padding-top: 15px; padding-right: 15px; padding-bottom: 15px; padding-left: 15px;">
        <div style="width: 28%;display: inline-block;height: 100%;border: 0;position: relative;">
            <img style="position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);" src="http://vieclam12h.vn/images/logo.jpg" alt="" width="100">
        </div>
        <div style="width: 70%;display: inline-block;color: white;font-size: 1em;height: 100%;border: 0;position: relative;">
            <span style="position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);font-weight: bold;font-size: 18px;">Tuyển dụng uy tín - Tìm việc hiệu quả</span>
        </div>
    </div>
    <div>
        <div>
            <h1 style="font-size: 22px;">Xin chào bạn '.$name.'</h1>        
            <p style="font-weight:bold; font-size: 16px;"><span style="color: #4f9fda;">Vieclam12h.vn</span> <span style="color: #4f9fda;">trân trọng thông báo:</span></p>
            <p>Bạn vừa nhận được một vị trí ứng tuyển <span style="color: #0088cc;text-decoration: underline;">'.$position.'</span></p>
            
            <p><span style="color: #6c5db9;">Thông tin chi tiết của nhà tuyển dụng như sau:</span></p>
            <div style="background-color: #fff2cc;padding: 8px 20px;">
                <p  style="font-weight: bold;"><span style="font-weight: bold;">Nhà tuyển dụng:</span> '.$nha_tuyen['company'].'</p>
                <p><span style="font-weight: bold;">Email:</span> <span style="color: #003d99;text-decoration: underline;">'.$nha_tuyen['email'].'</span></p>
                <p><span style="font-weight: bold;">Số điện thoại:</span> '.$nha_tuyen['phone'].'</p>
            </div>
            <p>Bạn vui lòng xem thông tin tuyển dụng tại đây <a style="color: #ff3399; font-weight: bold" href="http://vieclam12h.vn/thong-tin-tuyen-dung/'.$don_tuyen[0]['id'].'" target="_blank">Tại đây</a></p>
            <p style="font-style: italic;">Nếu cần hỗ trợ xin vui lòng liên hệ số hotline:
            <span style="text-align: center;font-weight: bold;font-style: italic; color: #ff3399;">0963.788.838</span>
            </p>
        </div>  
    </div>
</div>';
             // echo $noidung;die;
            $action_email->email_send($email, $title, $noidung);
            echo '<script>alert(\'Bạn đã gửi email thành công.\');</script>';
        }
    }
    send_ung_vien();
?>

<div class="gb-chitiet-vieclam">
    <div class="container">
        <div class="gb-chitiet-vieclam-title">
            <div class="row">
                <div class="col-sm-2 vh-ung-tuyen ung-vien-img" id="info-uv-1">
                    <div class="gb-chitiet-vieclam-img">
                        <img src="/images/<?= $ung_vien['image']!='' ? $ung_vien['image'] : 'no-photo.png' ?>" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="col-sm-6 vh-ung-tuyen" id="info-uv-2">
                    <div class="gb-chitiet-vieclam-noidung">
                        <h1><a href=""><?= $ung_vien['name'] ?></a></h1>
                        <h4><?= $ho_so['position'] ?></h4>
                        <ul>
                            <li><strong>Ngày sinh: <!-- <?= $ung_vien['birthday'] ?> --><?= date('d/m/Y', strtotime($ung_vien['birthday'])) ?></strong></li>
                            <li><strong>Nơi làm việc: 
                                <?php 
                                $dia_diem = json_decode($ho_so['dia_diem']);
                                $d = 0;
                                foreach ($dia_diem as $item) {
                                    $d++;
                                    if ($d==1) {
                                        echo $action->getDetail('location', 'id', $item)['name'];
                                    } else {
                                        echo ' ,'.$action->getDetail('location', 'id', $item)['name'];
                                    }
                                }
                                ?></strong></li>
                            <li><strong>Ngành nghề: 
                                <?php 
                                $dang = json_decode($ho_so['item']);
                                $d = 0;
                                foreach ($dang as $item) {
                                    $d++;
                                    if ($d==1) {
                                        echo $action->getDetail('career', 'id', $item)['name'];
                                    } else {
                                        echo ' / '.$action->getDetail('career', 'id', $item)['name'];
                                    }
                                }
                                ?></strong></li>
                            
                            <!-- <li><strong>Ngày tạo hồ sơ: </strong><?= date('d/m/Y', strtotime($ho_so['created_at'])) ?></li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="gb-chitiet-vieclam-tag">
                        <ul>
                            <li><strong>Lượt xem: </strong> <?= $ho_so['views'] ?></li>
                            
                            <li><strong>Mã tin: </strong> <?= $ung_vien['id'] ?></li>

                            <li><strong>Ngày tạo hồ sơ: </strong> <?= date('d/m/Y', strtotime($ho_so['created_at'])) ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-8">
                <div class="gb-chitiet-vieclam-left">
                    <div class="gb-chitiet-vieclam-left-info">
                        <h3 class="heading-title-vieclam"><i class="fa fa-user-o" aria-hidden="true"></i></i> Thông tin hồ sơ</h3>
                        <?php 
                        if ($ung_vien['type'] == 0) {
                            include DIR_OTHER . "MS_OTHER_VIECLAM_0001.php";
                        } else {
                            include DIR_OTHER . "MS_OTHER_VIECLAM_0002.php";
                        }
                        ?>
                    </div>
                    <div class="gb-chitiet-vieclam-left-mota">
                        <h3 class="heading-title-vieclam"><i class="fa fa-key" aria-hidden="true"></i> Kỹ năng của bản thân</h3>
                        <p>
                            <?php
                            $thong_tin_skill = str_replace("\r\n", "<br>", $ho_so['skill']);
                            echo $thong_tin_skill 
                            ?>
                        </p>
                    </div>
                    <div class="gb-chitiet-vieclam-left-mota">
                        <h3 class="heading-title-vieclam" style="text-transform: none;"><i class="fa fa-clock-o" aria-hidden="true"></i> KINH NGHIỆM LÀM VIỆC <span style="color: red;font-weight: bold;">(<?= $kinh_nghiem[$ho_so['experience']] ?>)</span></h3>
                        <p>
                            <?php
                            $thong_tin_work = str_replace("\r\n", "<br>", $ho_so['work_progress']);
                            echo $thong_tin_work 
                            ?>
                        </p>
                    </div>
                    <div class="gb-chitiet-vieclam-left-mota">
                        <h3 class="heading-title-vieclam"><i class="fa fa-hourglass-end" aria-hidden="true"></i> Mục tiêu nghề nghiệp</h3>
                        <p>
                         - Mong muốn tìm được chỗ làm ổn định lâu dài<br>
                         - Mong muốn tìm được chỗ làm có cơ hội thăng tiến tốt<br>
                         - Mong muốn tìm được chỗ làm có mức lương tốt<br>
                         - Mong muốn tìm được nơi có cơ hội cống hiến bản thân tốt<br>
                            <?php
                            $thong_tin_item = str_replace("\r\n", "<br>", $ho_so['muc_tieu']);
                            echo $thong_tin_item 
                            ?>
                        </p>
                    </div>

                    <div class="gb-chitiet-vieclam-left-contact">
                        <h3 class="heading-title-vieclam" style="color: #fff;">Thông tin liên hệ</h3>
                        <?php if (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 1) { ?>
                            <?php 
                            $see = $action->getDetail('nha_tuyen_dung', 'id', $_SESSION['user_id_gbvn'])['see'];
                            if ($see == 0) { 
                            ?>
                            <ul>
                                <li><strong style="color: #fff;">Người liên hệ:</strong> <span style="color: #ffce45;"><?= $ung_vien['name'] ?></span></li>
                                <li style="color: #fff;"><strong>Ngày sinh:</strong> <!-- <?= $ung_vien['birthday'] ?> --><?= date('d/m/Y', strtotime($ung_vien['birthday'])) ?></li>
                                <li style="color: #fff;"><strong>Địa chỉ:</strong> <?= $ho_so['address'] ?></li>
                                
                            </ul>
                            <?php } ?>
                        <?php } else { ?>
                        <ul>
                            <li><strong style="color: #fff; font-size: 14px;">Người liên hệ:</strong> <span style="color: #ffce45; font-size: 16px; font-weight: bold;"><?= $ung_vien['name'] ?></span></li>
                            <li style="color: #fff;"><strong>Ngày sinh:</strong> <!-- <?= $ung_vien['birthday'] ?> --><?= date('d/m/Y', strtotime($ung_vien['birthday'])) ?></li>
                            <li style="color: #fff;"><strong>Địa chỉ:</strong> <?= $ho_so['address'] ?></li>
                            
                        </ul>
                        <?php } ?>

                        <?php 
                            if (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 1) { 
                                $see = $action->getDetail('nha_tuyen_dung', 'id', $_SESSION['user_id_gbvn'])['see'];
                                $send_email = $action->getDetail('nha_tuyen_dung', 'id', $_SESSION['user_id_gbvn'])['send_email'];
                                if ($see == 1) {
                        ?>
                        <div class="col-md-7">
                            <ul>
                                <li><strong style="color: #fff;">Người liên hệ:</strong> <span style="color: #ffce45; font-weight: bold; font-size:16px;"><?= $ung_vien['name'] ?></span></li>
                                <li style="color: #fff;"><strong>Ngày sinh:</strong> <!-- <?= $ung_vien['birthday'] ?> --><?= date('d/m/Y', strtotime($ung_vien['birthday'])) ?></li>
                                <li style="color: #fff;"><strong>Địa chỉ:</strong> <?= $ho_so['address'] ?></li>
                                
                            </ul>
                        </div>
                        <div class="col-md-5">
                            <ul>
                                <li><strong style="color: #fff; font-size: 14px;">SĐT:</strong> <span style="color: #ffce45;font-size: 16px; font-weight: bold;"><?= $ung_vien['phone'] ?></span></li>
                                <li><strong style="color: #fff;">Email:</strong> <span style="color: #fff;"><?= $ung_vien['email'] ?></span></li>
                                <!-- <li style="color: #fff;"><strong>Ngày tạo hồ sơ:</strong> <?= date('d/m/Y', strtotime($ho_so['created_at'])) ?> </li> -->
                                <?php if ($ho_so['cv']!='') { ?>
                                <li style="color: #fff;"><strong>CV: <span style="color: #fff; font-weight: 300;">Tải xuống</span></strong>
                                    
                                    <a href="/images/cv/<?= $ho_so['cv'] ?>" download=""> <i class="fa fa-download" aria-hidden="true"></i></a>
                                    
                                </li>
                                <?php } ?>
                                <li><strong></strong></li>
                            </ul>
                        </div>
                        <div style="clear: both;">
                            
                        </div>
                        <?php 
                                }
                            }
                        ?>
                    </div>
                    <?php if (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 1) { ?>
                    <?php if ($send_email == 1) { ?>
                    <div style="text-align: center;margin-top: 10px;">
                    <!-- <form action="" method="post">
                        <input type="hidden" name="name_uv" value="<?= $ung_vien['name'] ?>">
                        <input type="hidden" name="email_uv" value="<?= $ung_vien['email'] ?>">
                        <input type="hidden" name="phone_uv" value="<?= $ung_vien['phone'] ?>">
                        <input type="hidden" name="position_uv" value="<?= $ho_so['position'] ?>">
                        <button type="submit" name="tuyen_ung_vien" style="border: 0;border-radius: 20px;padding: 10px 20px;background: #499cd6;color: #fff;font-weight: bold;">Gửi thông tin tới ứng viên</button>                        
                    </form> -->
                    <form method="post" action="https://app.zetamail.vn/form.php?form=127" id="frmSS127" onsubmit="return CheckForm127(this);">
  <table border="0" cellpadding="2" class="myForm" style="margin-left: auto;margin-right: auto;">
    <tr>

  <td><input type="hidden" name="email" value="<?= $ung_vien['email'] ?>" /></td>
</tr><input type="hidden" name="format" value="h" /><tr>
  
  <td><script type="text/javascript">
// <![CDATA[
  if (!Application) var Application = {};
  if (!Application.Page) Application.Page = {};
  if (!Application.Page.ClientCAPTCHA) {
    Application.Page.ClientCAPTCHA = {
      sessionIDString: '',
      captchaURL: [],
      getRandomLetter: function () { return String.fromCharCode(Application.Page.ClientCAPTCHA.getRandom(65,90)); },
      getRandom: function(lowerBound, upperBound) { return Math.floor((upperBound - lowerBound + 1) * Math.random() + lowerBound); },
      getSID: function() {
        if (Application.Page.ClientCAPTCHA.sessionIDString.length <= 0) {
          var tempSessionIDString = '';
          for (var i = 0; i < 32; ++i) tempSessionIDString += Application.Page.ClientCAPTCHA.getRandomLetter();
          Application.Page.ClientCAPTCHA.sessionIDString.length = tempSessionIDString;
        }
        return Application.Page.ClientCAPTCHA.sessionIDString;
      },
      getURL: function() {
        if (Application.Page.ClientCAPTCHA.captchaURL.length <= 0) {
          var tempURL = 'https://app.zetamail.vn/admin/resources/form_designs/captcha/index.php?c=';
          
                      tempURL += Application.Page.ClientCAPTCHA.getRandom(1,1000);
                          tempURL += '&ss=' + Application.Page.ClientCAPTCHA.getSID();
                        Application.Page.ClientCAPTCHA.captchaURL.push(tempURL);
                  }
        return Application.Page.ClientCAPTCHA.captchaURL;
      }
    }
  }

  var temp = Application.Page.ClientCAPTCHA.getURL();
  for (var i = 0, j = temp.length; i < j; i++) document.write('<img src="' + temp[i] + '" alt="img' + i + '" />');
// ]]>
</script>
<br/><input type="text" name="captcha" value="" placeholder="Nhập mã bảo mật" /></td>
</tr>
    <tr>
      <!-- <td></td> -->
      <td>
        <input type="submit" value="Gửi thông tin tới ứng viên" style="border: 0;border-radius: 20px;padding: 10px 20px;background: #499cd6;color: #fff;font-weight: bold;margin-top: 10px;" />
      </td>
    </tr>
  </table>
</form>

<script type="text/javascript">
// <![CDATA[

      function CheckMultiple127(frm, name) {
        for (var i=0; i < frm.length; i++)
        {
          fldObj = frm.elements[i];
          fldId = fldObj.id;
          if (fldId) {
            var fieldnamecheck=fldObj.id.indexOf(name);
            if (fieldnamecheck != -1) {
              if (fldObj.checked) {
                return true;
              }
            }
          }
        }
        return false;
      }
    function CheckForm127(f) {
      var email_re = /[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i;
      if (!email_re.test(f.email.value)) {
        alert("Vui lòng nhập email của bạn.");
        f.email.focus();
        return false;
      }
    
        if (f.captcha.value == "") {
          alert("Vui lòng nhập mã bảo mật đã được hiển thị");
          f.captcha.focus();
          return false;
        }
      
        return true;
      }
    
// ]]>
</script>
                    </div>
                	<?php } } ?>

                    <?php if (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 1) {} else { ?>
                        <div style="text-align: center;margin-top: 10px;">
                            <button type="button" style="border: 0;border-radius: 20px;padding: 10px 20px;background: #19a05e;color: #fff;font-weight: bold;" data-toggle="modal" data-target="#myModal">Xem liên hệ</button>
                        </div>
                    <?php } ?>
                </div>

                <!---->
                <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0005.php";?>
            </div>
            <div class="col-sm-4">
                <div class="gb-chitiet-vieclam-right">
                    <?php include DIR_SIDEBAR."MS_SIDEBAR_VIECLAM_0009.php";?>
                    <?php include DIR_SEARCH."MS_SEARCH_VIECLAM_0003.php";?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #19a05e;color: #fff;font-weight: bold;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="font-weight: 300;">NHÀ TUYỂN DỤNG ĐĂNG NHẬP</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="form-group">
            <label for="email">Nhập Email/Số điện thoại:</label>
            <input type="email" class="form-control" id="email">
          </div>
          <div class="form-group">
            <label for="pwd">Mật khẩu:</label>
            <input type="password" class="form-control" id="pwd">
          </div>
          
          <button type="button" class="btn btn-default" onclick="dang_nhap()">ĐĂNG NHẬP</button>
          <p style="text-align: right;"><a href="/dang-ky" title="" style="color: #000;">Đăng ký</a></p>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
    function dang_nhap () {
        var email = document.getElementById("email").value;
        var pass = document.getElementById("pwd").value;
        if (email == '' || pass == '') {
            alert('Hãy nhập đầu đủ thông tin');
            return;
        }

        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var ok = this.responseText;
                // alert(ok);
                if (ok == 'true') {
                    alert('Bạn đã đăng nhập thành công.');
                    location.reload();
                } else {
                    alert('Thông tin đăng nhập không đúng.');
                }
            }
          };
          xhttp.open("GET", "/functions/ajax/dang_nhap_td.php?email="+email+"&pass="+pass, true);
          xhttp.send();
    }
</script>
<script type="text/javascript">
    function set_height_info_1 () {
        var info_1 = document.getElementById("info-uv-2").offsetHeight;
        // alert(info_1);
        document.getElementById("info-uv-1").style.height = info_1 + "px";
    }
    set_height_info_1();
</script>