<?php 
	if (!isset($_SESSION['user_id_gbvn'])) {
		header('location: /');
	}

	$goi_diem = $action->getList('goi_diem', '', '', 'id', 'asc', '', '', '');
	$ntd = $action->getDetail('nha_tuyen_dung', 'id', $_SESSION['user_id_gbvn']);

  $goi_mua = $action->getList('book_diem', 'nha_tuyen_dung_id', $_SESSION['user_id_gbvn'], 'id', 'asc', '', '', '');
?>
<div class="container">
  <h2>Bảng giá gói mua</h2>
  <p>Ban có: <?= $ntd['diem'] ?> điểm</p>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Điểm</th>
        <th>Giá tiền</th>
        <th>Mua</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($goi_diem as $item) { ?>
      <tr>
        <td><?= number_format($item['diem']) ?></td>
        <td><?= number_format($item['gia']) ?> VNĐ</td>
        <td><a title="" style="cursor: pointer;" onclick="mua_diem(<?= $item['id'] ?>, <?= $_SESSION['user_id_gbvn'] ?>)">Mua ngay</a></td>
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
        <th>Điểm</th>
        <th>Giá</th>
        <th>Kích hoạt</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      foreach ($goi_mua as $item) { 
        $goi = $action->getDetail('goi_diem', 'id', $item['goi_diem_id']);
      ?>
      <tr>
        <td><?= number_format($goi['diem']) ?></td>
        <td><?= number_format($goi['gia']) ?> VNĐ</td>
        <td><?= $item['state']==0 ? 'Chưa kích hoạt' : 'Đã kích hoạt' ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<script>
	function mua_diem (goi_id, ntd_id) {
        // alert(goi_id);alert(ntd_id);
        var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		     // document.getElementById("demo").innerHTML = this.responseText;
		     	alert(this.responseText);
		    }
		  };
		  xhttp.open("GET", "/functions/ajax/mua_diem.php?goi_id="+goi_id+"&ntd_id="+ntd_id, true);
		  xhttp.send();
	}
</script>