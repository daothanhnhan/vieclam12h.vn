<?php 
	if (!isset($_SESSION['user_id_gbvn'])) {
		header('location: /');
	}

	$bang_gia_3 = $action->getList('bang_gia_3', '', '', 'id', 'asc', '', '', '');
	$bang_gia_4 = $action->getList('bang_gia_4', '', '', 'id', 'asc', '', '', '');
	$ntd = $action->getDetail('nha_tuyen_dung', 'id', $_SESSION['user_id_gbvn']);

  $book_home_time = $action->getList('book_home_time', 'ntd_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
  $book_tuyen_time = $action->getList('book_tuyen_time', 'ntd_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
?>
<div class="container">
  <h2>Bảng giá hiển thị trang chủ</h2>
  <p>Hạn hết hiển thị: <?= $ntd['home_time'] ?></p>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Số tuần</th>
        <th>Giá tiền</th>
        <th>Mua</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($bang_gia_3 as $item) { ?>
      <tr>
        <td><?= number_format($item['week']) ?></td>
        <td><?= number_format($item['price']) ?> VNĐ</td>
        <td><a title="" style="cursor: pointer;" onclick="book_home(<?= $item['id'] ?>, <?= $_SESSION['user_id_gbvn'] ?>)">Mua ngay</a></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

<div class="container">
  <h2>Các gói đã mua</h2>
  <!-- <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>             -->
  <table class="table">
    <thead>
      <tr>
        <th>Số tuần</th>
        <th>Giá</th>
        <th>Kích hoạt</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      foreach ($book_home_time as $item) { 
        $goi = $action->getDetail('bang_gia_3', 'id', $item['home_time_id']);
      ?>
      <tr>
        <td><?= number_format($goi['week']) ?></td>
        <td><?= number_format($goi['price']) ?> VNĐ</td>
        <td><?= $item['state']==0 ? 'Chưa kích hoạt' : 'Đã kích hoạt' ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<hr>
<hr>
<hr>
<div class="container">
  <h2>Bảng giá hiển thị trang tuyển dụng</h2>
  <p>Hạn hết hiển thị: <?= $ntd['tuyen_time'] ?></p>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Số tuần</th>
        <th>Giá tiền</th>
        <th>Mua</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($bang_gia_4 as $item) { ?>
      <tr>
        <td><?= number_format($item['week']) ?></td>
        <td><?= number_format($item['price']) ?> VNĐ</td>
        <td><a title="" style="cursor: pointer;" onclick="book_tuyen(<?= $item['id'] ?>, <?= $_SESSION['user_id_gbvn'] ?>)">Mua ngay</a></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

<div class="container">
  <h2>Các gói đã mua</h2>
  <!-- <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>             -->
  <table class="table">
    <thead>
      <tr>
        <th>Số tuần</th>
        <th>Giá</th>
        <th>Kích hoạt</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      foreach ($book_tuyen_time as $item) { 
        $goi = $action->getDetail('bang_gia_4', 'id', $item['tuyen_time_id']);
      ?>
      <tr>
        <td><?= number_format($goi['week']) ?></td>
        <td><?= number_format($goi['price']) ?> VNĐ</td>
        <td><?= $item['state']==0 ? 'Chưa kích hoạt' : 'Đã kích hoạt' ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<script>
	function book_home (goi_id, ntd_id) {
        // alert(goi_id);alert(ntd_id);
        var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		     // document.getElementById("demo").innerHTML = this.responseText;
		     	alert(this.responseText);
		    }
		  };
		  xhttp.open("GET", "/functions/ajax/book_home.php?goi_id="+goi_id+"&ntd_id="+ntd_id, true);
		  xhttp.send();
	}

	function book_tuyen (goi_id, ntd_id) {
        // alert(goi_id);alert(ntd_id);
        var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		     // document.getElementById("demo").innerHTML = this.responseText;
		     	alert(this.responseText);
		    }
		  };
		  xhttp.open("GET", "/functions/ajax/book_tuyen.php?goi_id="+goi_id+"&ntd_id="+ntd_id, true);
		  xhttp.send();
	}
</script>