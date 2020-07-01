<?php 
    $footer_hotline_bac = $action->getList('hotline_bac', '', '', 'id', 'asc', '', '', '');
    $footer_hotline_nam = $action->getList('hotline_nam', '', '', 'id', 'asc', '', '', '');
?>
<div class="gb-hotlinetuvasn-vieclam-home">
    <div class="container">
        <div class="gb-hotlinetuvasn-vieclam-home-title">
            <h4>ĐT 02466.846.068 - 0963.788.838</h4>
        </div>
        <div class="gb-hotlinetuvasn-vieclam-home-item">
            <h3>KHU VỰC  <span>MIỀN BẮC</span></h3>

            <ul class="row">
                <?php foreach ($footer_hotline_bac as $item) { ?>
                <li class="col-md-3 col-xs-12 col-sm-12" style="text-align: center;"><span style="color: #000;font-weight: normal;"><?= $item['phone'] ?> </span> <span style="color: red;"><?= $item['name'] ?></span></li>
                <?php } ?>
            </ul>
        </div>
        <hr style="margin-bottom: 0;">
        <div class="gb-hotlinetuvasn-vieclam-home-item" style="padding-top: 0;">
            <h3>KHU VỰC  <span> MIỀN NAM</span></h3>

            <ul class="row">
                <?php foreach ($footer_hotline_nam as $item) { ?>
                <li class="col-md-3 col-xs-12 col-sm-12" style="text-align: center;"><span style="color: #000;font-weight: normal;"><?= $item['phone'] ?> </span> <span style="color: red;"><?= $item['name'] ?></span></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>