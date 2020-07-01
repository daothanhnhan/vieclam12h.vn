<?php 
    $search_career = $action->getList('career', '', '', 'id', 'asc', '', '', '');
    $search_location = $action->getList('location', '', '', 'id', 'asc', '', '', '');
    $search_office = $action->getList('office', '', '', 'id', 'asc', '', '', '');
    $search_luong = $action->getList('luong', '', '', 'id', 'asc', '', '', '');
    $search_hinh_thuc = $action->getList('hinh_thuc', '', '', 'id', 'asc', '', '', '');
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
<style>
 
</style>
<div class="gb-search-filter-vieclam  hidden-sm hidden-xs">
    <div class="container">
        <form action="/index.php" method="get" accept-charset="utf-8">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group input-icons">
                        <input type="hidden" name="page" value="tim-kiem-2">
                        <input type="hidden" name="home" value="1">
                        <i class="fa fa-search icon"></i>
                        <input type="text" name="title" value="<?= isset($_GET['title']) ? $_GET['title'] : '' ?>" placeholder="Tên công ty, vị trí tuyển dụng ..." class="form-control input-field">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group search-diadiemheader">
                                <select name="career" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                                    <option value="0" data-icon="glyphicon icon-hammer-wrench">Tìm theo ngành nghề</option>
                                    <?php foreach ($search_career as $item) { ?>
                                    <option value="<?= $item['id'] ?>" <?php if (isset($_GET['career'])) {if ($_GET['career']==$item['id']) {echo 'selected';}} ?> ><?= $item['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group search-diadiemheader">
                                <select name="location" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                                    <option value="0" data-icon="icon-map-marker">Tìm theo địa điểm</option>
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
                    <span style="color: #fff;display: <?= $_GET['page']!='tim-kiem-2' ? 'none' : ''; ?>;">Bạn đang tìm kiếm việc làm trang chủ</span>
                    <button id="btn-tim" type="button" data-toggle="collapse" data-target="#demo" style="">Tìm kiếm nâng cao</button>
                </div>
            </div>
            <div id="demo" class="row collapse" style="margin-bottom: 4px;">
                <div class="col-sm-4">
                    <div class="form-group search-diadiemheader">
                        <select name="sex" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="0" data-icon="icon-man-woman">Tất cả giới tính</option>
                            <option value="2">Nam</option>
                            <option value="3">Nữ</option>
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
                            <option value="6">THCS/THPT</option>
                            <option value="7">Chứng chỉ nghề</option>
                            <option value="8">Bằng lái ô tô</option>
                            <option value="9">Bằng lái Xúc, Nâng</option>
                            <option value="1">Trung cấp</option>
                            <option value="2">Cao đẳng</option>
                            <option value="3">Đại học</option>
                            <option value="4">Thạc sĩ</option>
                            <option value="5">Tiến sĩ</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group search-diadiemheader">
                        <select name="office" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="0" data-icon="icon-clipboard-user">Tất cả Chức vụ</option>
                            <?php foreach ($search_office as $item) { ?>
                            <option value="<?= $item['id'] ?>" ><?= $item['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group search-diadiemheader">
                        <select name="luong" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="0" data-icon="icon-cash-dollar">Tất cả lương</option>
                            <?php foreach ($search_luong as $item) { ?>
                            <option value="<?= $item['id'] ?>" ><?= $item['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group search-diadiemheader">
                        <select name="form" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="0" data-icon="icon-store">Tất cả loại hình công việc</option>
                            <?php foreach ($search_hinh_thuc as $item) { ?>
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