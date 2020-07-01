<?php 
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../pagination/Pagination.php";
	include_once dirname(__FILE__) . "/../action.php";
	$action = new action();

	$ung_vien_moi = $action->getList_ajax('ung_vien', 'type', '1', 'time', 'desc', $_GET['trang'], '20', 'a');
?>
                        <h2 class="gb-page-sanpham_ruouvang-title" style="background-color: #2d9290;color: #fff;"><img src="/images/icons/vieclam12h.jpg" width="31"> Ứng viên mới</h2>
                    <div class="gb-page-sanpham_ruouvang-vieclammoi-scroll">
<?php 
                        foreach ($ung_vien_moi['data'] as $item) { 
                            $ho_so = $action->getDetail('ho_so', 'ung_vien_id', $item['id']);
                        ?>
                        <div class="gb-product_ruouvang-item">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="gb-product_ruouvang-item-img">
                                        <a href="/thong-tin-ung-tuyen/<?= $item['id'] ?>"><img src="/images/<?= $item['image']!='' ? $item['image'] : 'no-photo.png' ?>" alt="" class="img-responsive"></a>
                                    </div>
                                    <div class="gb-product_ruouvang-item-text">
                                        <h2><a href="/thong-tin-ung-tuyen/<?= $item['id'] ?>"><?= $ho_so['position'] ?></a></h2>
                                        <p><?= $item['name'] ?></p>
                                        <div class="kinhnghiem-vieclam">Kinh nghiệm: <span><?= $action->getDetail('kinh_nghiem', 'id', $ho_so['experience'])['name'] ?></span></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4 clear-padding">
                                            <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0002_1.php";?>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="ngaynophoso-sp">
                                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?= date('d/m/Y', strtotime($ho_so['created_at'])) ?>
                                            </p>
                                        </div>
                                        <div class="col-sm-4 clear-padding-left">
                                            <div class="gb-product_ruouvang-item-address">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i> <?php 
                                                $diadiem = json_decode($ho_so['dia_diem']);
                                                echo $action->getDetail('location', 'id', $diadiem[0])['name'] 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                        <div>
                            <?= $ung_vien_moi['paging'] ?>
                        </div>