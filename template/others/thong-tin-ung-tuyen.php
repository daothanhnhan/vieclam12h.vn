<?php 
	if (!isset($_GET['trang'])) {
		header('location: /');
	}
	$info = $action->getDetail('ung_vien', 'id', $_GET['trang']);
	$hoso = $action->getDetail('ho_so', 'ung_vien_id', $_GET['trang']);
  $trinhdo = array('khong', 'Trung cấp', 'Cao đẳng', 'Đại học', 'Thạc sĩ');
?>
<div class="container">
  <h2>Thông tin của ứng viên</h2>
           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Các mục</th>
        <th>Thông tin</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Họ và tên</td>
        <td><?= $info['name'] ?></td>
      </tr>
      <tr>
        <td>Ngày sinh</td>
        <td><?= date('d-m-Y', strtotime($info['birthday'])) ?></td>
      </tr>
      <tr>
        <td>Điện thoại</td>
        <td><?= $info['phone'] ?></td>
      </tr>
      <!-- <tr>
        <td>Nơi sinh</td>
        <td><?= $info['born'] ?></td>
      </tr> -->
      <tr>
        <td>Giới tính</td>
        <td><?= $info['sex']==1 ? 'Nam' : 'Nữ' ?></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><?= $info['email'] ?></td>
      </tr>
      <!-- ho so -->
      <?php if ($hoso != null) { ?>
      <tr>
        <td>Loại hình lao động</td>
        <td><?= $info['type']==0 ? 'Lao động có trình độ' : 'Lao động phổ thông' ?></td>
      </tr>
      <tr>
        <td>Vị trí ứng tuyển</td>
        <td><?= $hoso['position'] ?></td>
      </tr>
      
      <?php if ($info['type']==0) { ?>
      <tr>
        <td>Tốt nghiệp trường</td>
        <td><?= $hoso['school'] ?></td>
      </tr>
      <tr>
        <td>Chuyên ngành</td>
        <td><?= $hoso['career'] ?></td>
      </tr>
      <tr>
        <td>Năm tốt nghiệp</td>
        <td><?= $hoso['year'] ?></td>
      </tr>
      <tr>
        <td>Chuyên ngành</td>
        <td><?= $hoso['career'] ?></td>
      </tr>
      <tr>
        <td>Trình độ</td>
        <td><?= $trinhdo[$hoso['level']] ?></td>
      </tr>
      <tr>
        <td>Xếp loại</td>
        <td><?= $hoso['xep_loai'] ?></td>
      </tr>
  	  <?php } ?>
  	  <tr>
        <td>Mục tiêu nghề nghiệp</td>
        <td><?= $hoso['muc_tieu'] ?></td>
      </tr>
      <tr>
        <td>Tình trạng hôn nhân</td>
        <td><?= $action->getDetail('hon_nhan', 'id', $hoso['hon_nhan'])['name']; ?></td>
      </tr>
      <tr>
        <td>Mục đăng tin</td>
        <td><?php
        $dangtin = explode(',', $hoso['item']);
        foreach ($dangtin as $item) {
        	echo $action->getDetail('career', 'id', $item)['name'].',';
        }
        ?></td>
      </tr>
      <tr>
        <td>Địa điểm làm việc</td>
        <td><?php
        $diadiem = explode(',', $hoso['dia_diem']);
        foreach ($diadiem as $item) {
        	echo $action->getDetail('location', 'id', $item)['name'].',';
        }
        ?></td>
      </tr>
      <tr>
        <td>Kỹ năng của bản thân</td>
        <td><?= str_replace("\r\n", "<br>", $hoso['skill']) ?></td>
      </tr>
      <tr>
        <td>Quá trình làm việc</td>
        <td><?= str_replace("\r\n", "<br>", $hoso['work_progress']) ?></td>
      </tr>
      <tr>
        <td>Kinh nghiệm</td>
        <td><?= $experience[$hoso['experience']] ?></td>
      </tr>
      <tr>
        <td>Mức lươn mong muốn</td>
        <td><?= $hoso['salary'] ?></td>
      </tr>
      <tr>
        <td>Hình thức làm việc</td>
        <td><?= $hoso['form']==1 ? 'Toàn thời gian' : 'Bán thời gian' ?></td>
      </tr>
      <tr>
        <td>Chỗ ở hiện nay</td>
        <td><?= $hoso['address'] ?></td>
      </tr>
      <tr>
        <td>CV đính kèm</td>
        <td><a href="/images/cv/<?= $hoso['cv'] ?>" download>Download</a></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>