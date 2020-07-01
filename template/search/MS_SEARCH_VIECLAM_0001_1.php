<?php 
      $footer_tinh = $action->getList('location', 'district', '0', 'id', 'asc', '', '', '');
?>
<div class="gb-search-tinhthanh-vieclam" style="margin: 30px 0;">
    <div class="container">
        <h2>TÌM VIỆC LÀM THEO TỈNH THÀNH MIỀN BẮC</h2>
        <hr>
        <ul class="row">
            <?php foreach ($footer_tinh as $item) { ?>
            <li class="col-sm-3"><a href="/index.php?page=tim-kiem&title=&location=<?= $item['id'] ?>"><?= $item['name'] ?></a></li>
            <?php } ?>
        </ul>
    </div>
</div>