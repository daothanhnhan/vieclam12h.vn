<?php 
	if (!isset($_GET['trang'])) {
		header('location: /');
	}
	$don = $action->getDetail('thong_tin_tuyen_dung', 'id', $_GET['trang']);
	$nhatuyen = $action->getDetail('nha_tuyen_dung', 'id', $don['nha_tuyen_dung_id']);
  //////////////
  $level = array('chọn', 'Lao động phổ thông', 'Trung cấp', 'Cao đẳng', 'Đại học', 'Thạc sĩ');
  $sex = array('khong', 'Không yêu cầu', 'Nam', 'Nữ');
  $form = array('khong', 'Toàn thời gian', 'Bán thời gian');
  $experience = array('khong', 'Chưa có kinh nghiệm', '1 năm', '2 năm', '3 năm');
?>
<div class="container">
  <h2>Thông tin của đơn tuyển dụng</h2>
           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Các mục</th>
        <th>Thông tin</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Ảnh đại diện</td>
        <td><img src="/images/<?= $nhatuyen['image'] ?>" width="100"></td>
      </tr>
      <tr>
        <td>Tên công ty</td>
        <td><?= $nhatuyen['company'] ?></td>
      </tr>
      <tr>
        <td>Địa chỉ</td>
        <td><?= $nhatuyen['address'] ?></td>
      </tr>
      <tr>
        <td>Điện thoại</td>
        <td><?= $nhatuyen['phone'] ?></td>
      </tr>
      <tr>
        <td>Người liên hệ</td>
        <td><?= $nhatuyen['name'] ?></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><?= $nhatuyen['email'] ?></td>
      </tr>
      <!-- ho so -->
      <tr>
        <td>Vị trí tuyển dụng</td>
        <td><?= $don['position'] ?></td>
      </tr>
      <tr>
        <td>Mục đăng tin</td>
        <td><?php
        $mucdang = explode(',', $don['career']);
        $d = 0;
        foreach ($mucdang as $item) { 
          $d++;
          if ($d==1) {
            echo $action->getDetail('career', 'id', $item)['name'] ;
          } else {
            echo ', ',$action->getDetail('career', 'id', $item)['name'] ;
          }
        }
        ?></td>
      </tr>
      <tr>
        <td>Chuyên ngành</td>
        <td><?= $don['chuyen_nganh'] ?></td>
      </tr>
      <tr>
        <td>Trình độ yêu cầu</td>
        <td><?= $level[$don['level']] ?></td>
      </tr>
      <tr>
        <td>Số lượng</td>
        <td><?= $don['quatity'] ?></td>
      </tr>
      <tr>
        <td>Giới tính</td>
        <td><?= $sex[$don['sex']] ?></td>
      </tr>
      <tr>
        <td>Hình thức làm việc</td>
        <td><?= $form[$don['form']] ?></td>
      </tr>
      <tr>
        <td>Kinh nghiệm</td>
        <td><?= $experience[$don['experience']] ?></td>
      </tr>
      <tr>
        <td>Mức lương</td>
        <td><?= $don['salary'] ?></td>
      </tr>
      <tr>
        <td>Ngày hết hạn</td>
        <td><?= date('d-m-Y', strtotime($don['ngay'])) ?></td>
      </tr>
      <tr>
        <td>Địa điểm làm việc</td>
        <td><?php
        $diadiem = explode(',', $don['location']);
        $d = 0;
        foreach ($diadiem as $item) { 
          $d++;
          if ($d==1) {
            echo $action->getDetail('location', 'id', $item)['name'] ;
          } else {
            echo ', ',$action->getDetail('location', 'id', $item)['name'] ;
          }
        }
        ?></td>
      </tr>
      <tr>
        <td>Chức vụ</td>
        <td><?= $action->getDetail('office', 'id', $don['office'])['name'] ?></td>
      </tr>
      <tr>
        <td>Yêu cầu độ tuổi</td>
        <td><?= $don['age'] ?></td>
      </tr>

      <tr>
        <td>Mô tả công việc</td>
        <td><?= str_replace("\r\n", "<br>", $don['note']) ?></td>
      </tr>
      <tr>
        <td>Quyên lợi</td>
        <td><?= str_replace("\r\n", "<br>", $don['benefit']) ?></td>
      </tr>
      <tr>
        <td>Yêu cầu công việc</td>
        <td><?= str_replace("\r\n", "<br>", $don['request']) ?></td>
      </tr>
      <tr>
        <td>Yêu cầu hồ sơ</td>
        <td><?= str_replace("\r\n", "<br>", $don['brief']) ?></td>
      </tr>
    </tbody>
  </table>
</div>