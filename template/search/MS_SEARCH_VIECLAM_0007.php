<style>
@media screen and (min-width: 991px) {
	.tim-kiem-mobile {
		display: none;
	}
}
</style>
<div class="container tim-kiem-mobile">

<div class="row" style="margin-bottom: 10px;margin-right: -15px;margin-left: -15px;">
    <div class="col-xs-5" style="width: 37%;">
        <button style="background: #9e9e9e;color: #fff;border:0;border-radius: 13px;font-size: 16px;" data-toggle="collapse" data-target="#demo-mb">Lọc việc làm</button>
    </div>
    <div class="col-xs-4">
        <a href="/dang-nhap" title="" style="background: #0091cf;color: #fff;border-radius: 10px;padding: 4px 6px;font-weight: bold;">Đăng nhập</a>
    </div>
    <div class="col-xs-3" style="width: 29%;">
        <a href="/dang-ky" title="" style="background: #fc205c;color: #fff;border-radius: 10px;padding: 4px 7px;font-weight: bold;">Đăng ký</a>
    </div>
    
</div>
<form action="/index.php" id="demo-mb" class="collapse" method="get" accept-charset="utf-8" style="height: 0;">
	<div class="row">
        <div class="col-md-12" style="display: none;">
            <div class="form-group input-icons">
                <input type="hidden" name="page" value="tim-kiem">
                <input type="hidden" name="home" value="2">
                <i class="fa fa-search icon"></i>
                <input type="text" name="title" value="<?= isset($_GET['title']) ? $_GET['title'] : '' ?>" placeholder="Tên công ty, vị trí tuyển dụng ..." class="form-control input-field">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group search-diadiemheader input-icons">
                <i class="icon-hammer-wrench icon"></i>
                <select name="career" id="career" onchange="select_career(this)" class="selectpicker1 form-control select-padding-left" data-show-subtext="true" data-live-search="true">
                    <option value="0" data-icon="glyphicon glyphicon-wrench">Tìm theo ngành nghề</option>
                    <?php foreach ($search_career as $item) { ?>
                    <option value="<?= $item['id'] ?>" <?php if (isset($_GET['career'])) {if ($_GET['career']==$item['id']) {echo 'selected';}} ?> ><?= $item['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group search-diadiemheader input-icons">
                <i class="icon-map-marker icon"></i>
                <select name="location" id="location" onchange="select_location(this)" class="selectpicker1 form-control select-padding-left" data-show-subtext="true" data-live-search="true">
                    <option value="0" data-icon="glyphicon glyphicon-map-marker">Tìm theo địa điểm</option>
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
        <div class="col-sm-12">
            <div class="form-group search-diadiemheader input-icons">
                <i class="icon-man-woman icon"></i>
                <select name="sex" id="sex" onchange="select_sex(this)" class="selectpicker1 form-control select-padding-left" data-show-subtext="true" data-live-search="true">
                    <option value="0" data-icon="glyphicon glyphicon-user">Tất cả giới tính</option>
                    <option value="2">Nam</option>
                    <option value="3">Nữ</option>
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group search-diadiemheader input-icons">
                <i class="glyphicon glyphicon-time icon"></i>
                <select name="experience" id="experience" onchange="select_experience(this)" class="selectpicker1 form-control select-padding-left" data-show-subtext="true" data-live-search="true">
                    <option value="0" data-icon="glyphicon glyphicon-time">Tất cả kinh nghiêm</option>
                    <?php foreach ($search_experience as $item) { ?>
                    <option value="<?= $item['id'] ?>" ><?= $item['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group search-diadiemheader input-icons">
                <i class="icon-graduation-hat icon"></i>
                <select name="level" id="level" onchange="select_level(this)" class="selectpicker1 form-control select-padding-left" data-show-subtext="true" data-live-search="true">
                    <option value="0" data-icon="glyphicon glyphicon-education">Tất cả trình độ</option>
                    
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
        <div class="col-sm-12">
            <div class="form-group search-diadiemheader input-icons">
                <i class="icon-clipboard-user icon"></i>
                <select name="office" id="office" onchange="select_office(this)" class="selectpicker1 form-control select-padding-left" data-show-subtext="true" data-live-search="true">
                    <option value="0" data-icon="glyphicon glyphicon-briefcase">Tất cả Chức vụ</option>
                    <?php foreach ($search_office as $item) { ?>
                    <option value="<?= $item['id'] ?>" ><?= $item['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-12" style="display: none;">
            <div class="form-group search-diadiemheader input-icons">
                <select name="luong" class="selectpicker1 form-control select-padding-left" data-show-subtext="true" data-live-search="true">
                    <option value="0" data-icon="glyphicon glyphicon-usd">Tất cả lương</option>
                    <?php foreach ($search_luong as $item) { ?>
                    <option value="<?= $item['id'] ?>" ><?= $item['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-12" style="display: none;">
            <div class="form-group search-diadiemheader input-icons">
                <select name="form" class="selectpicker1 form-control select-padding-left" data-show-subtext="true" data-live-search="true">
                    <option value="0" data-icon="glyphicon glyphicon-th-large">Tất cả loại hình công việc</option>
                    <?php foreach ($search_hinh_thuc as $item) { ?>
                    <option value="<?= $item['id'] ?>" ><?= $item['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <button class="btn btn-timkiem-vieclam" style="background: #1b91d1;color:#fff;border-radius: 13px;">Tìm kiếm</button>
            </div>
        </div>
    </div>
</form>
</div>

<script>
    function select_career (data) {
        // alert(data.value);
        var element = document.getElementById("career");
        var val = data.value;
        if (val == 0) {
            element.classList.remove("select-bold");
        } else {
            element.classList.add("select-bold");
        }
    }

    function select_location (data) {
        // alert(data.value);
        var element = document.getElementById("location");
        var val = data.value;
        if (val == 0) {
            element.classList.remove("select-bold");
        } else {
            element.classList.add("select-bold");
        }
    }

    function select_sex (data) {
        // alert(data.value);
        var element = document.getElementById("sex");
        var val = data.value;
        if (val == 0) {
            element.classList.remove("select-bold");
        } else {
            element.classList.add("select-bold");
        }
    }

    function select_experience (data) {
        // alert(data.value);
        var element = document.getElementById("experience");
        var val = data.value;
        if (val == 0) {
            element.classList.remove("select-bold");
        } else {
            element.classList.add("select-bold");
        }
    }

    function select_level (data) {
        // alert(data.value);
        var element = document.getElementById("level");
        var val = data.value;
        if (val == 0) {
            element.classList.remove("select-bold");
        } else {
            element.classList.add("select-bold");
        }
    }

    function select_office (data) {
        // alert(data.value);
        var element = document.getElementById("office");
        var val = data.value;
        if (val == 0) {
            element.classList.remove("select-bold");
        } else {
            element.classList.add("select-bold");
        }
    }
</script>