<?php 
  function quen_mk () {
    global $conn_vn;
    $action_email = new action_email();
    if (isset($_POST['gui'])) {
      $email = $_POST['email'];
      $sql = "SELECT * FROM nha_tuyen_dung WHERE email = '$email'";
      $result = mysqli_query($conn_vn, $sql);
      $num = mysqli_num_rows($result);
      if ($num == 0) {
        echo '<script>alert(\'Email này không tồn tại.\');</script>';
        return false;
      } else {
        $row = mysqli_fetch_assoc($result);
        $ntd_id = $row['id'];
        $noi_dung = '<p>Xin Chào Bạn!</p>';
        $noi_dung .= '<p>Bạn hoặc ai đó đã yêu cầu đổi mật khẩu đăng nhập trên website '.$_SERVER['SERVER_NAME'].'</p>';
        $noi_dung .= '<p>Nếu bạn đã yêu cầu, vui lòng vào đường link dưới đây còn nếu bạn không yêu cầu vui lòng bỏ qua thư này!</p>';
        $noi_dung .= '<p><a href="'.$_SERVER['SERVER_NAME'].'/doi-mat-khau-ntd/'.$ntd_id.'">Link đổi mật khẩu: '.$_SERVER['SERVER_NAME'].'/doi-mat-khau-ntd/'.$ntd_id.'</a></p>';

        $action_email->email_send($email, 'Quên mật khẩu', $noi_dung);
        echo '<script>alert(\'Vào email của bạn để đổi mật khẩu.\');</script>';
      }
    }
  }
  quen_mk();
?>

<div class="container" style="margin-top: 90px;margin-bottom: 200px;">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <h1 style="font-size: 30px;margin-bottom: 20px;">Quên mật khẩu</h1>
    <form action="" method="post">
      <div class="form-group">
        <label for="email">Nhập địa chỉ Email:</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>
      
      <button type="submit" name="gui" class="btn btn-default">Gửi email</button>
    </form> 
  </div>
  <div class="col-md-2"></div>
</div>