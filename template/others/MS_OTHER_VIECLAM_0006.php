<?php 
  $list_don_tuyen = $action->getList('thong_tin_tuyen_dung', 'nha_tuyen_dung_id', $_SESSION['user_id_gbvn'], 'id', 'desc', $trang, '20', $_GET['page'], $_GET['page']);
  // var_dump($list_don_tuyen);
?>
<style>
  .chuot_vao:hover {
    color: #fecc39;
  }
  @media screen and (max-width: 991px) {
    .hidden-td-table {
      display: none;
    }
    .font-size-mb-table-tin-dang {
      font-size: 13px;
    }
  }
</style>
<div class="container">
      <h2 style="text-transform: uppercase;font-size: 20px;color: #fecc39;">TIN ĐÃ ĐĂNG</h2>
               
      <table class="table table-bordered font-size-mb-table-tin-dang">
        <thead>
          <tr style="background: #5ac18f;">
            <th>Vị chí tuyển dụng</th>
            <th>Mục đăng tin</th>
            
            <th class="hidden-td-table">Xem</th>
            <th class="hidden-td-table">Sửa tin</th>
            <th>Làm mới</th>
            <th class="hidden-td-table">Ngày hết hạn</th>
            <th class="hidden-td-table">Ngày hết hạn</th>
            <th class="hidden-td-table">Xóa</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($list_don_tuyen['data'] as $item) { ?>
          <tr style="font-weight: normal;">
            <td class="chuot_vao"><a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>" class="chuot_vao"><?= $item['position'] ?></a></td>
            <td class="chuot_vao"><a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>" class="chuot_vao"><?php 
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
            ?></a></td>
            
            <td class="chuot_vao hidden-td-table"><a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>" class="chuot_vao">Xem</a></td>
            <td class="chuot_vao hidden-td-table"><a href="/don-tuyen-dung/<?= $item['id'] ?>" class="chuot_vao">Sửa tin</a></td>
            <td class="chuot_vao"><a href="javascript:void()" onclick="lam_moi(<?= $item['id'] ?>)" title="" class="chuot_vao">Làm mới</a></td>
            <td class="hidden-td-table">
              <?php
                if ($item['home']==1) {
                  echo date('d-m-Y', strtotime($item['home_time']));
                }
              ?>
            </td>
            <td class="hidden-td-table">
              <?php
                if ($item['trang_tuyen']) {
                  echo date('d-m-Y', strtotime($item['tuyen_time']));
                }
              ?>
            </td>
            <td><a href="javascript:void()" title="" onclick="xoa_don(<?= $item['id'] ?>)">Xóa</a></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      <div>
        <?= $list_don_tuyen['paging'] ?>
      </div>
    </div>
<script>
  function lam_moi (id) {
        // alert(id);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            // document.getElementById("demo").innerHTML = this.responseText;
            // alert(this.responseText);
            alert('Bạn đã làm mới tin thành công.');
          }
        };
        xhttp.open("GET", "/functions/ajax/lam_moi.php?id="+id, true);
        xhttp.send();
  }

  function xoa_don (id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       // document.getElementById("demo").innerHTML = this.responseText;
       location.reload();
      }
    };
    xhttp.open("GET", "/functions/ajax/xoa_don.php?id="+id, true);
    xhttp.send();
  }
</script>