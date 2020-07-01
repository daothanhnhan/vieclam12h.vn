<?php 
    $search_career = $action->getList('career', '', '', 'id', 'asc', '', '', '');
    $search_location = $action->getList('location', '', '', 'id', 'asc', '', '', '');
    $search_vi_tri = $action->getList('office', '', '', 'id', 'asc', '', '', '');
    $search_ngng = $action->getList('ngoai_ngu_1', '', '', 'id', 'asc', '', '', '');
    $search_luong = $action->getList('luong', '', '', 'id', 'asc', '', '', '');
    $search_name = array();
	foreach ($search_location as $key => $row)
	{
        $search_name[$key] = $row['name'];
	}
	array_multisort($search_name, SORT_ASC, $search_location);//var_dump($search_location);
    $search_experience = $action->getList('experience', '', '', 'id', 'asc', '', '', '');
    $search_level = $action->getList('level', '', '', 'id', 'asc', '', '', '');
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<link href="https://doannguyennet.github.io/iconsfont/linearicons.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<style>
@media screen and (max-width: 991px) {
.gb-search-filter-vieclam {
    display: none;
}
}
i.icon-earth:before {
    content: '\e884';
}
</style>
<div class="gb-search-filter-vieclam">
    <div class="container">
        <form action="/index.php" method="get" accept-charset="utf-8">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group input-icons">
                        <input type="hidden" name="page" value="tim-kiem-ung-vien-1">
                        <i class="fa fa-search icon"></i>
                        <input type="text" name="title" value="<?= isset($_GET['title']) ? $_GET['title'] : '' ?>" placeholder="Tên ứng viên, vị trí tuyển dụng ...." class="form-control input-field">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group search-diadiemheader">
                                <select name="career" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                                    <option value="0" data-icon="icon-hammer-wrench">Tất cả ngành nghề</option>
                                    <?php foreach ($search_career as $item) { ?>
                                    <option value="<?= $item['id'] ?>" <?php if (isset($_GET['career'])) {if ($_GET['career']==$item['id']) {echo 'selected';}} ?> ><?= $item['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group search-diadiemheader">
                                <select name="location" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                                    <option value="0" data-icon="icon-map-marker">Tất cả địa điểm</option>
                                    <option value="72" <?php if (isset($_GET['location'])) {if ($_GET['location']==72) {echo 'selected';}} ?> >Hà Nội</option>
                                    <option value="71" <?php if (isset($_GET['location'])) {if ($_GET['location']==71) {echo 'selected';}} ?> >Hồ Chí Minh</option>
                                    <?php 
                                    foreach ($search_location as $item) { 
                                        if ($item['id'] == 71 || $item['id'] == 72) { } else { 
                                    ?>
                                    <option value="<?= $item['id'] ?>" <?php if (isset($_GET['location'])) {if ($_GET['location']==$item['id']) {echo 'selected';}} ?> ><?= $item['name'] ?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button class="btn btn-timkiem-vieclam">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <span style="color: #fff;display: <?= $_GET['page']!='tim-kiem-ung-vien-1' ? 'none' : ''; ?>;">Bạn đang tìm kiếm ứng viên phổ thông</span>
                    <button type="button" id="btn-tim" data-toggle="collapse" data-target="#demo3">Tìm kiếm nâng cao</button>
                </div>
            </div>
            <div id="demo3" class="row collapse">
                <div class="col-sm-4">
                    <div class="form-group search-diadiemheader">
                        <select name="sex" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="2" data-icon="icon-man-woman">Tất cả giới tính</option>
                            <option value="1">Nam</option>
                            <option value="0">Nữ</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group search-diadiemheader">
                        <select name="experience" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="0" data-icon="glyphicon glyphicon-time">Tất cả kinh nghiêm</option>
                            <?php foreach ($search_experience as $item) { ?>
                            <option value="<?= $item['id'] ?>" ><?= $item['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group search-diadiemheader">
                        <select name="level" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="0" data-icon="icon-graduation-hat">Tất cả trình độ</option>
                            
                            <option value="6" >THCS/THPT</option>
                            <option value="7" >Chứng chỉ nghề</option>
                            <option value="8" >Bằng lái ô tô</option>
                            <option value="9" >Bằng lái Xúc, Nâng</option>
                            
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group search-diadiemheader">
                        <select name="office" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="0" data-icon="icon-clipboard-user">Tất cả vị trí</option>
                            <?php foreach ($search_vi_tri as $item) { ?>
                            <option value="<?= $item['id'] ?>" ><?= $item['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group search-diadiemheader">
                        <select name="lang" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="0" data-icon="icon-earth">Tất cả ngoại ngữ</option>
                            <?php foreach ($search_ngng as $item) { ?>
                            <option value="<?= $item['id'] ?>" ><?= $item['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group search-diadiemheader">
                        <select name="luong" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="0" data-icon="icon-cash-dollar">Tất cả mức lương</option>
                            <?php foreach ($search_luong as $item) { ?>
                            <option value="<?= $item['id'] ?>" ><?= $item['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>