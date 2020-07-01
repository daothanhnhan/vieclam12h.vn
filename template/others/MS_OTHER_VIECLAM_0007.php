<?php 
  $list_ung_vien = $action->getList('ung_tuyen', 'nha_tuyen_dung_id', $_SESSION['user_id_gbvn'], 'id', 'desc', $trang, '20', $_GET['page'], $_GET['page']);
  //var_dump($list_ung_vien);
?>
<style>
  .chuot_vao:hover {
    color: #fecc39;
  }
  @media screen and (max-width: 991px) {
    .hidden-td-table {
      display: none;
    }
    .font-size-mb-table-da-luu {
      font-size: 13px;
    }
  }
</style>
<div class="container">
      <h2 style="text-transform: uppercase;font-size: 20px;color: #fecc39;">Danh sách người ứng tuyển</h2>
               
      <table class="table table-bordered font-size-mb-table-da-luu">
        <thead>
          <tr style="background: #5ac18f;">
            <th>Người ứng tuyển</th>
            <th>Vị trí</th>
            <th>Ngày nộp</th>
            <th>Xem</th>
            <th>Lưu</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($list_ung_vien['data'] as $item) { 
          $don = $action->getDetail('thong_tin_tuyen_dung', 'id', $item['thong_tin_tuyen_dung_id']);//var_dump($don);
        ?>
          <tr style="font-weight: normal;">
            <td><a href="/thong-tin-ung-tuyen/<?= $item['ung_vien_id'] ?>" class="chuot_vao"><?= $action->getDetail('ung_vien', 'id', $item['ung_vien_id'])['name'] ?></a></td>
            <td><a href="/thong-tin-ung-tuyen/<?= $item['ung_vien_id'] ?>" class="chuot_vao"><?= $don['position'] ?></a></td>
            <td><a href="/thong-tin-ung-tuyen/<?= $item['ung_vien_id'] ?>" class="chuot_vao"><?= $item['ngay'] ?></a></td>
            <td><a href="/thong-tin-ung-tuyen/<?= $item['ung_vien_id'] ?>" class="chuot_vao">Xem</a></td>
            <td><a style="cursor: pointer;" onclick="luu(<?= $item['id'] ?>)" class="chuot_vao">Lưu hồ sơ</a></td>
            <td><a href="javascript:void()" title="" onclick="xoa_ung_tuyen(<?= $item['id'] ?>)">Xóa</a></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      <div>
        <?= $list_ung_vien['paging'] ?>
      </div>
    </div>

<script>
  function luu (id) {
    // alert(id);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // document.getElementById("demo").innerHTML = this.responseText;
        alert(this.responseText);
      }
    };
    xhttp.open("GET", "/functions/ajax/ho_so_da_luu.php?id="+id, true);
    xhttp.send();
  }

  function xoa_ung_tuyen (id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       // document.getElementById("demo").innerHTML = this.responseText;
       location.reload();
      }
    };
    xhttp.open("GET", "/functions/ajax/xoa_ung_tuyen.php?id="+id, true);
    xhttp.send();
  }
</script>