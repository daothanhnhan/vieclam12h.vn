<?php 
  $list_ung_vien = $action->getList('ung_tuyen', 'nha_tuyen_dung_id', $_GET['id'], 'id', 'desc', $trang, '20', $_GET['page']);
  //var_dump($list_ung_vien);
?>
<div class="container">
  <h2>Hồ sơ ứng tuyển</h2>
           
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Người ứng tuyển</th>
        <th>Vị trí</th>
        <th>Ngày nộp</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach ($list_ung_vien['data'] as $item) { 
          $don = $action->getDetail('thong_tin_tuyen_dung', 'id', $item['thong_tin_tuyen_dung_id']);//var_dump($don);
        ?>
      <tr>
        <td><?= $action->getDetail('ung_vien', 'id', $item['ung_vien_id'])['name'] ?></td>
        <td><?= $don['position'] ?></td>
        <td><?= $item['ngay'] ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<?= $list_ung_vien['paging'] ?>