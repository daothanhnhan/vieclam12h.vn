<?php 
    $tuongtu_career = json_decode($thong_tin['career']);
    $tuongtu_career = $tuongtu_career[0];
    // $viec_tuongtu = $action->getList('thong_tin_tuyen_dung', 'career', $tuongtu_career, 'id', 'desc', '', '12', '');
    if ($thong_tin['level'] == 1) {
        $arr_viec = array(
            array('level', '=', 1),
            array('career', 'like', "'%\"$tuongtu_career\"%'")
        );
    } else {
        $arr_viec = array(
            array('level', '!=', 1),
            array('career', 'like', "'%\"$tuongtu_career\"%'")
        );
    }
    $viec_tuongtu = $action->getList_arr('thong_tin_tuyen_dung',$arr_viec,'id','desc','','12', '');
?>
<div class="gb-home-product-relate">
    <div class="gb-home-product-relate-title">
        <h4>Việc làm tương tự đang tuyển gấp</h4>
    </div>
    <div class="row">
        <?php 
        foreach ($viec_tuongtu as $item) { 
            $info_nha = $action->getDetail('nha_tuyen_dung', 'id', $item['nha_tuyen_dung_id']);
        ?>
        <div class="col-md-6">
            <div class="gb-product_ruouvang-item">
                <div class="gb-product_ruouvang-item-img">
                    <a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><img src="/images/<?= $info_nha['image']!='' ? $info_nha['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                </div>
                <div class="gb-product_ruouvang-item-text">
                    <h2><a href="/thong-tin-tuyen-dung/<?= $item['id'] ?>"><?= $item['position'] ?></a></h2>
                    <p><?= $info_nha['company'] ?></p>
                    <!--PRICE-->
                    <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0002.php";?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
