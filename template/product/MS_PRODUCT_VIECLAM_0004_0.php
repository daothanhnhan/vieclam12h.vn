<?php 
    if (!isset($_GET['trang'])) {
        header('location: /');
    }

    function count_don ($id) {
        global $conn_vn;
        $sql = "SELECT * FROM thong_tin_tuyen_dung WHERE id = $id";
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);
        $views = $row['views'];
        $views++;

        $sql = "UPDATE thong_tin_tuyen_dung SET views = $views WHERE id = $id";
        $result = mysqli_query($conn_vn, $sql);
    }
    count_don($_GET['trang']);

    $thong_tin = $action->getDetail('thong_tin_tuyen_dung', 'id', $_GET['trang']);
    $nha_tuyen = $action->getDetail('nha_tuyen_dung', 'id', $thong_tin['nha_tuyen_dung_id']);
    //echo $item['salary'];
    // var_dump($thong_tin);
    $kinh_nghiem = array('rỗng', 'Chưa có', 'Dưới 1 năm', '1 năm', '2 năm', '3 năm', '4 năm', '5 năm', '6 năm', '7 năm', '8 năm','9 năm', '10 năm', 'trên 10 năm');
    
    $hinh_thuc = array('rong', 'Toàn thời gian', 'Bán thời gian');
    $gioi_tinh = array('rong', 'Không yêu cầu', 'Nam', 'Nữ');

    $chuyen_nganh = json_decode($thong_tin['career']);//var_dump($chuyen_nganh);

    function ung_tuyen () {
    	global $conn_vn;
        global $thong_tin;
        global $nha_tuyen;
        $action = new action();
        $action_email = new action_email();
    	if (isset($_POST['ung_tuyen'])) {
    		$tuyen = $_POST['tuyen'];
            $ung = $_POST['ung'];
    		$don = $_POST['don'];

            $ung_vien = $action->getDetail('ung_vien', 'id', $ung);
            $ho_so = $action->getDetail('ho_so', 'ung_vien_id', $ung_vien['id']);//var_dump($ho_so);

            

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
            <h1 style="font-size: 22px;">Xin chào '.$nha_tuyen['company'].'</h1>        
            <p style="font-weight:bold; font-size: 16px;"><span style="color: #4f9fda;">Vieclam12h.vn</span> <span style="color: #4f9fda;">trân trọng thông báo:</span></p>
            <p>Quý công ty vừa nhận được một hồ sơ ứng tuyển vào vị trí <span style="color: #0088cc;text-decoration: underline;">'.$ho_so['position'].'</span></p>
            
            <p><span style="color: #6c5db9;">Thông tin chi tiết của ưng viên như sau:</span></p>
            <div style="background-color: #fff2cc;padding: 8px 20px;">
                <p  style="font-weight: bold;"><span style="font-weight: bold;">Họ và tên:</span> '.$ung_vien['name'].'</p>
                <p><span style="font-weight: bold;">Email:</span> <span style="color: #003d99;text-decoration: underline;">'.$ung_vien['email'].'</span></p>
                <p><span style="font-weight: bold;">Số điện thoại:</span> '.$ung_vien['phone'].'</p>
            </div>
            <p>Quý khách vui lòng kiểm tra xem hồ sơ ứng viên tại đây <a style="color: #ff3399; font-weight: bold" href="http://vieclam12h.vn/thong-tin-ung-tuyen/'.$ung.'" target="_blank">Tại đây</a></p>
            <p style="font-style: italic;">Nếu cần hỗ trợ xin vui lòng liên hệ số hotline:
            <span style="text-align: center;font-weight: bold;font-style: italic; color: #ff3399;">0963.788.838</span>
            </p>
        </div>  
    </div>
</div>';//echo $noidung;die;
// <p>Từ ứng viên <span style="color: #0088cc;text-decoration: underline;">'.$ung_vien['name'].'</span></p>
// <p style="background-color: #DCDCDC;text-align: center;color: #696969;padding: 30px;font-style: italic;">Đây là email tự động, vui lòng không trả lời email này</p>
//             <p style="font-weight: bold;text-align: center;">Hệ sinh thái tuyển dụng Việc làm 12h</p>
//             <div style="text-align: center;">
//                 <img src="http://vieclam12h.vn/images/icons/fb.png" alt="" width="51">
//                 <img src="http://vieclam12h.vn/images/icons/g.png" alt="" width="50">
//                 <img src="http://vieclam12h.vn/images/icons/yt3.png" alt="" width="50">
//             </div>
//             <p style="text-align: center;">Liên hệ | Quy định bảo mật | Thỏa thuận sử dụng | Ngừng nhận email</p>
//             <p style="text-align: center;">Copyright &#9400; Việc Làm 12h</p>
//             <p style="text-align: center;">Hotline: +84 246 293 9998 / Website: vieclam12h.vn</p>
            
            $title = 'Hồ sơ ứng tuyển vị trí - '.$ho_so['position'];
            $action_email->email_send($nha_tuyen['email'], $title, $noidung);

    		$sql = "INSERT INTO ung_tuyen (nha_tuyen_dung_id, ung_vien_id, thong_tin_tuyen_dung_id) VALUES ($tuyen, $ung, $don)";
    		$result = mysqli_query($conn_vn, $sql);
    		if ($result) {
    			echo '<script>alert(\'Bạn đã ứng tuyển thành công.\');</script>';
    		} else {
    			echo '<script>alert(\'Có lỗi xảy ra.\');</script>';
    		}
    	}
    }
    ung_tuyen();
?>

<div class="gb-chitiet-vieclam">
    <div class="container">
        <div class="gb-chitiet-vieclam-title">
            <div class="row an-chuyen-vien">
                <div class="col-sm-1">
                    <div class="gb-img-lien-he">
                        <img src="/images/<?= $rowConfig['banner4'] ?>" alt="" class="img-responsive" style="border-radius: 50%;">
                    </div>
                </div>
                <div class="col-sm-11" style="padding-left: 0;">
                    <div class="gb-text-lien-he">
                        <p>Chuyên viên hỗ trợ tư vấn nhà tuyển dụng</p>
                        <ul>
                            <li><?= $rowConfig['content_home11'] ?></li>
                            <li><i class="fa fa-phone-square" aria-hidden="true"></i> <?= $rowConfig['content_home10'] ?></li>
                            <li><i class="fa fa-envelope" aria-hidden="true"></i> <?= $rowConfig['content_home2'] ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr style="margin-bottom: 0px;">
            <div class="row">
                <div class="col-sm-2 vh-tuyen-dung img-nha-tuyen-dung">
                    <div class="gb-chitiet-vieclam-img">
                        <img src="/images/<?= $nha_tuyen['image'] ?>" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="col-sm-6 vh-tuyen-dung">
                    <div class="gb-chitiet-vieclam-noidung">
                        <h1><?= $thong_tin['position'] ?></h1>
                        <h4><a href=""><?= $nha_tuyen['company'] ?></a></h4>
                        <ul>
                            <li><strong>Nơi làm việc: <?php
                            $thong_tin_diadiem = json_decode($thong_tin['location']);
                            $d = 0;
                            foreach ($thong_tin_diadiem as $item1) {
                                $d++;
                                if ($d==1) {
                                    echo $action->getDetail('location', 'id', $item1)['name'];
                                } else {
                                    echo ', '.$action->getDetail('location', 'id', $item1)['name'];
                                }
                            }
                            $item['salary'] = $thong_tin['salary'];
                            ?></strong></li>
                            <li><strong>Mức lương:</strong> <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0002.php";?></li>
                            <li><strong>Hạn nộp hồ sơ: </strong><?= date('d/m/Y', strtotime($thong_tin['ngay'])) ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="gb-chitiet-vieclam-tag">
                        <ul>
                            <li><strong>Quy mô: <?= $nha_tuyen['quy_mo'] ?></strong> </li>
                            <li><strong>Website:<a target="_blank" href="<?= $nha_tuyen['website'] ?>"> <?= $nha_tuyen['website'] ?></a></strong> </li>
                            <li><strong>Lượt xem: </strong> <?= $thong_tin['views'] ?></li>
                            <li><strong>Mã tin: </strong> 10<?= $nha_tuyen['id'] ?></li>
                            <li><strong>Ngày duyệt: </strong> <?= date('d/m/Y', strtotime($thong_tin['created_at'])) ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr style="margin-top: 0px;">
        <div class="row">
            <div class="col-sm-8">
                <div class="gb-chitiet-vieclam-left">
                    <div class="gb-chitiet-vieclam-left-info">
                        <h3 class="heading-title-vieclam"><i class="fa fa-bullhorn" aria-hidden="true"></i> Thông tin tuyển dụng</h3>
                        <ul class="row">
                            <div class="col-sm-6">
                                <li class="col-sm-12"><strong>Số lượng cần tuyển:</strong> <?= $thong_tin['quatity'] ?></li>
                                <li class="col-sm-12"><strong>Yêu cầu giới tính:</strong> <?= $gioi_tinh[$thong_tin['sex']] ?></li>
                                <li class="col-sm-12"><strong>Yêu cầu bằng cấp:</strong> <?= $bang_cap[$thong_tin['level']] ?></li>
                                
                                <li class="col-sm-12"><strong>Yêu cầu ngoại ngữ:</strong> <?= $action->getDetail('ngoai_ngu', 'id',$thong_tin['ngoai_ngu_tin_hoc'])['name'] ?></li>
                            </div>
                            <div class="col-sm-6">
                                <li class="col-sm-12"><strong>Yêu cầu KN:</strong> <span style="color: red;font-weight: bold;"><?= $kinh_nghiem[$thong_tin['experience']] ?></span></li>
                                <li class="col-sm-12"><strong>Loại hình công việc:</strong> <?= $hinh_thuc[$thong_tin['form']] ?></li>
                                <li class="col-sm-12"><strong>Chức vụ:</strong>  <?= $action->getDetail('office', 'id', $thong_tin['office'])['name'] ?></li>
                                <li class="col-sm-12"><strong>Ngành nghề:</strong> 
                                    <span style="color: #000;">
                                    <?php 
                                        $count_chng = count($chuyen_nganh);
                                        $d = 0;
                                        foreach ($chuyen_nganh as $item) {
                                            $d++;
                                            if ($d != $count_chng) {
                                                $phay = ' / ';
                                            } else {
                                                $phay = '';
                                            }
                                            echo $action->getDetail('career', 'id', $item)['name'].$phay;
                                        }
                                    ?>
                                    </span>
                                </li>
                            </div>
                        </ul>
                    </div>
                    <div class="gb-chitiet-vieclam-left-mota">
                        <h3 class="heading-title-vieclam"><i class="fa fa-laptop" aria-hidden="true"></i> Mô tả công việc</h3>
                        <p>
                            <?php
                            $thong_tin_note = str_replace("\r\n", "<br>", $thong_tin['note']);
                            echo $thong_tin_note 
                            ?>
                        </p>
                    </div>
                    <div class="gb-chitiet-vieclam-left-mota">
                        <h3 class="heading-title-vieclam"><i class="fa fa-usd" aria-hidden="true"></i> Quyền lợi được hưởng</h3>
                        <p>
                            <?php
                            $thong_tin_benefit = str_replace("\r\n", "<br>", $thong_tin['benefit']);
                            echo $thong_tin_benefit 
                            ?>
                        </p>
                    </div>
                    <div class="gb-chitiet-vieclam-left-mota">
                        <h3 class="heading-title-vieclam"><i class="fa fa-meh-o" aria-hidden="true"></i> Yêu cầu công việc</h3>
                        <p>
                            <?php
                            $thong_tin_request = str_replace("\r\n", "<br>", $thong_tin['request']);
                            echo $thong_tin_request 
                            ?>
                        </p>
                    </div>

                    <div class="gb-chitiet-vieclam-left-mota">
                        <h3 class="heading-title-vieclam"><i class="fa fa-sticky-note-o" aria-hidden="true"></i> Yêu cầu hồ sơ</h3>
                        <p>
                            <?php
                            $thong_tin_brief = str_replace("\r\n", "<br>", $thong_tin['brief']);
                            echo $thong_tin_brief 
                            ?>
                        </p>
                    </div>

                    <div class="gb-chitiet-vieclam-left-contact" style="background-color: #d55c58;">
                        <h3 class="heading-title-vieclam" style="color: #fff;">Thông tin liên hệ</h3>
                        <ul>
                            <li><strong style="color: #fff;">Người liên hệ:</strong> <span style="color: #ffce45;"><?= $nha_tuyen['name'] ?></span></li>
                            <li style="color: #fff;"><strong>Địa chỉ công ty:</strong> <?= $nha_tuyen['address'] ?></li>
                            
                            <!-- <li style="color: #fff;"><strong>Số điện thoại:</strong> <?= $nha_tuyen['phone'] ?></li>
                            <li style="color: #fff;"><strong>Email:</strong> <?= $nha_tuyen['email'] ?></li> -->
                            <li style="color: #fff;"><strong>Hạn nộp hồ sơ:</strong> <?= date('d/m/Y', strtotime($thong_tin['ngay'])) ?> </li>
                            
                            
                            <li><strong></strong></li>
                        </ul>
                    </div>
                    <?php if (isset($_SESSION['user_id_gbvn']) && $_SESSION['user_type_gbvn'] == 2) { ?>
                    <form action="" method="post">
                        <input type="hidden" name="don" id="don" value="<?= $thong_tin['id'] ?>">
                        <input type="hidden" name="tuyen" id="tuyen" value="<?= $nha_tuyen['id'] ?>">
                        <input type="hidden" name="ung" id="ung" value="<?= $_SESSION['user_id_gbvn'] ?>">
                        <!-- <button type="submit" name="ung_tuyen" class="btn-nophosoungtuyen" style="">Nộp hồ sơ ứng tuyển</button>                         -->
                    </form>
                    <form method="post" action="https://app.zetamail.vn/form.php?form=127" id="frmSS127" onsubmit="return CheckForm127(this);">
  <table border="0" cellpadding="2" class="myForm" style="margin-left: auto;margin-right: auto;">
    <tr>

  <td><input type="hidden" name="email" value="<?= $nha_tuyen['email'] ?>" /></td>
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
        <input type="submit" value="Nộp hồ sơ ứng tuyển" style="border: 0;border-radius: 20px;padding: 10px 20px;background: #499cd6;color: #fff;font-weight: bold;margin-top: 10px;" />
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

        var don = document.getElementById("don").value;
        var tuyen = document.getElementById("tuyen").value;
        var ung = document.getElementById("ung").value;
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             // document.getElementById("demo").innerHTML = this.responseText;
             // alert('thành công.')
            }
          };
          xhttp.open("GET", "/functions/ajax/ung_tuyen.php?don="+don+"&tuyen="+tuyen+"&ung="+ung, true);
          xhttp.send();
      
        return true;
      }
    
// ]]>
</script>
                    <?php } else { ?>
                        <div style="text-align: center;margin-top: 10px;">
                            <button type="button" style="border: 0;border-radius: 20px;padding: 10px 20px;background: #19a05e;color: #fff;font-weight: bold;" data-toggle="modal" data-target="#myModal">Đăng ký ngay</button>
                        </div>
                	<?php } ?>
                </div>

                <!---->
                <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0005_1.php";?>
            </div>
            <div class="col-sm-4">
                <div class="gb-chitiet-vieclam-right">
                    <?php include DIR_SIDEBAR."MS_SIDEBAR_VIECLAM_0002.php";?>
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
        <h4 class="modal-title" style="font-weight: 300;">ỨNG VIÊN ĐĂNG NHẬP</h4>
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
          xhttp.open("GET", "/functions/ajax/dang_nhap_uv.php?email="+email+"&pass="+pass, true);
          xhttp.send();
    }
</script>