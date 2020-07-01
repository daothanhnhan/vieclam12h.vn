<?php 
  $message_login_1 = '';
  $message_login_2 = '';
  function dang_nhap_td () {
    global $message_login_1;
    global $conn_vn;
    if (isset($_POST['dangnhap_td'])) {
      $email = $_POST['email'];
      $pass = $_POST['pass'];
      // $type = $_POST['type'];
      
        $sql = "SELECT * FROM nha_tuyen_dung Where email = '$email' Or phone = '$email'";
        $result = mysqli_query($conn_vn, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 0) {
            $message_login_1 = "<div class='alert alert-danger'>Mật khẩu hoặc Tên đăng nhập không đúng</div>";
        } else {
            $row = mysqli_fetch_assoc($result);
            $pass_hash = $row['password'];
            if (password_verify($pass, $pass_hash)) {
              $_SESSION['user_id_gbvn'] = $row['id'];
              $_SESSION['user_email_gbvn'] = $row['email'];
              $_SESSION['user_name_gbvn'] = $row['company'];
              $_SESSION['user_type_gbvn'] = 1;
              // echo '<script type="text/javascript">alert(\'Bạn đã đăng nhập thành công!\'); window.location.href = "/dang-ky-nha-tuyen-dung";</script>';
              echo '<script type="text/javascript">alert(\'Bạn đã đăng nhập thành công!\'); window.location.href = "/";</script>';
            } else {
              $message_login_1 = "<div class='alert alert-danger'>Mật khẩu hoặc Tên đăng nhập không đúng</div>";
            }
        }
      
    }
  }
  dang_nhap_td();

  function dang_nhap_uv () {
    global $message_login_2;
    global $conn_vn;
    if (isset($_POST['dangnhap_uv'])) {
      $email = $_POST['email'];
      $pass = $_POST['pass'];
      // $type = $_POST['type'];
      
        $sql = "SELECT * FROM ung_vien Where email = '$email' Or phone = '$email'";
        $result = mysqli_query($conn_vn, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 0) {
            $message_login_2 = "<div class='alert alert-danger'>Mật khẩu hoặc Tên đăng nhập không đúng</div>";
        } else {
            $row = mysqli_fetch_assoc($result);
            $pass_hash = $row['password'];
            if (password_verify($pass, $pass_hash)) {
              $_SESSION['user_id_gbvn'] = $row['id'];
              $_SESSION['user_phone_gbvn'] = $row['phone'];
              $_SESSION['user_name_gbvn'] = $row['name'];
              $_SESSION['user_type_gbvn'] = 2;
              echo '<script type="text/javascript">alert(\'Bạn đã đăng nhập thành công!\'); window.location.href = "/";</script>';
            } else {
              $message_login_2 = "<div class='alert alert-danger'>Mật khẩu hoặc Tên đăng nhập không đúng</div>";
            }
        }
      
    }
  }
  dang_nhap_uv();
?>
<div class="container" style="padding-top: 30px; padding-bottom: 30px;">
  <div class="row">
    <div class="col-sm-4">
      <div class="dangnhapnhatuyendung">
        <?= $message_login_1 ?>
        <form action="" method="post">
          <h4>Nhà tuyển dụng</h4>
          <div class="form-group">
            <label for="email"> Nhập Email/Số điện thoại:</label>
            <input type="text" name="email" class="form-control" id="email" required placeholder="Đăng nhập Email hoặc số điện thọai">
          </div>
          <div class="form-group">
            <label for="pwd">Mật khẩu:</label>
            <input type="password" name="pass" class="form-control" id="pwd" required>
          </div>
          <button type="submit" name="dangnhap_td" class="btn btn-default">Đăng nhập</button>
          <p style="text-align: right;"><a href="/quen-mat-khau-ntd" title="" style="color: #fff;">Quên mật khẩu</a></p>
        </form>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="dangnhapnhaungvien">
        <?= $message_login_2 ?>
        <form action="" method="post">
          <h4>Ứng viên có trình độ</h4>
          <div class="form-group">
            <label for="email">Nhập Email/Số điện thoại:</label>
            <input type="text" name="email" class="form-control" id="email" required  placeholder="Đăng nhập Email hoặc số điện thọai">
          </div>
          <div class="form-group">
            <label for="pwd">Mật khẩu:</label>
            <input type="password" name="pass" class="form-control" id="pwd" required>
          </div>
          
          <button type="submit" name="dangnhap_uv" class="btn btn-default">Đăng nhập</button>
          <p style="text-align: right;"><a href="/quen-mat-khau-ung-vien" title="" style="color: #fff;">Quên mật khẩu</a></p>
        </form>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="dangnhapnhaungvien1">
        <?= $message_login_2 ?>
        <form action="" method="post">
          <h4>Ứng viên phổ thông</h4>
          <div class="form-group">
            <label for="email">Nhập Số điện thoại:</label>
            <input type="text" name="email" class="form-control" id="email" required  placeholder="Đăng nhập số điện thọai">
          </div>
          <div class="form-group">
            <label for="pwd">Mật khẩu:</label>
            <input type="password" name="pass" class="form-control" id="pwd" required>
          </div>
          
          <button type="submit" name="dangnhap_uv" class="btn btn-default">Đăng nhập</button>
          <p>&nbsp;</p>
        </form>
      </div>
    </div>
  </div>
    
</div>