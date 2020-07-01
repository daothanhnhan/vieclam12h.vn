<?php 
  $list_don_tuyen = $action->getList('thong_tin_tuyen_dung', 'nha_tuyen_dung_id', $_GET['id'], 'id', 'desc', $trang, '20', $_GET['page']);
  // var_dump($list_don_tuyen);
?>
<div class="container">
  <h2>Tin đã đăng</h2>            
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Vị trí tuyển dụng</th>
        <th>Mục đăng tin</th>
        <th>Ngày hết hạn</th>
        <th>Ngày hết hạn</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($list_don_tuyen['data'] as $item) { ?>
      <tr>
        <td><?= $item['position'] ?></td>
        <td><?php 
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
            ?></td>
        <td><?php
                if ($item['home']==1) {
                  echo date('d-m-Y', strtotime($item['home_time']));
                }
              ?></td>
        <td><?php
                if ($item['trang_tuyen']) {
                  echo date('d-m-Y', strtotime($item['tuyen_time']));
                }
              ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<?= $list_don_tuyen['paging'] ?>