<?php 
    include_once dirname(__FILE__) . "/../functions/database.php";
    include_once dirname(__FILE__) . "/../functions/library.php";
    include_once dirname(__FILE__) . "/../functions/action.php";

    $action = new action();

    $ung_vien = $action->getDetail('ung_vien', 'id', $_GET['id']);
    $ho_so = $action->getDetail('ho_so', 'ung_vien_id', $ung_vien['id']);
    // $kinhnghiem = $action->getDetail('ex');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CV</title>
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
    <!-- <link rel="stylesheet" href=""> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style-ruouvang.css">
    <!-- <link href="https://doannguyennet.github.io/iconsfont/linearicons.min.css" rel="stylesheet"/> -->
    <link href="/cv1/style.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/plugin/fonts/font-awesome/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container" id="export_image" style="width: 780px;">
        <div class="gb-chitiet-vieclam">
    <div class="container1">
        <div class="gb-chitiet-vieclam-title">
            <div class="row">
                <div class="col-sm-3 vh-ung-tuyen ung-vien-img" id="info-uv-1" style="height: 148px;">
                    <div class="gb-chitiet-vieclam-img">
                        <img src="/images/<?= $ung_vien['image']!='' ? $ung_vien['image'] : 'no-photo.png' ?>" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="col-sm-9 vh-ung-tuyen" id="info-uv-2">
                    <div class="gb-chitiet-vieclam-noidung">
                        <h1><a href=""><?= $ung_vien['name'] ?></a></h1>
                        <h4><?= $ho_so['position'] ?></h4>
                        <ul>
                            <li><strong>Ngày sinh: <?= date('d/m/Y', strtotime($ung_vien['birthday'])) ?></strong></li>
                            <li><strong>Nơi làm việc: 
                                <?php 
                                $dia_diem = json_decode($ho_so['dia_diem']);
                                $d = 0;
                                foreach ($dia_diem as $item) {
                                    $d++;
                                    if ($d==1) {
                                        echo $action->getDetail('location', 'id', $item)['name'];
                                    } else {
                                        echo ' ,'.$action->getDetail('location', 'id', $item)['name'];
                                    }
                                }
                                ?></strong></li>
                            <li><strong>Ngành nghề: 
                                <?php 
                                $dang = json_decode($ho_so['item']);
                                $d = 0;
                                foreach ($dang as $item) {
                                    $d++;
                                    if ($d==1) {
                                        echo $action->getDetail('career', 'id', $item)['name'];
                                    } else {
                                        echo ' / '.$action->getDetail('career', 'id', $item)['name'];
                                    }
                                }
                                ?></strong></li>
                            
                            <!-- <li><strong>Ngày tạo hồ sơ: </strong>19/10/2019</li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4 hidden-xs hidden-sm" style="display: none;">
                    <div class="gb-chitiet-vieclam-tag">
                        <ul>
                            <li><strong>Lượt xem: </strong> 37</li>
                            
                            <li><strong>Mã tin: </strong> 00422</li>

                            <li><strong>Ngày tạo hồ sơ: </strong> 19/10/2019</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-sm-12">
                <div class="gb-chitiet-vieclam-left">
                    <div class="gb-chitiet-vieclam-left-info">
                        <h3 class="heading-title-vieclam"><i class="fa icon-bookmark" aria-hidden="true" style="color: #000;"></i> Thông tin hồ sơ</h3>
                        
                        <?php 
                        if ($ung_vien['type'] == 0) {
                            include dirname(__FILE__) . "/../template/others/MS_OTHER_VIECLAM_0001.php";
                        } else {
                            include dirname(__FILE__) . "/../template/others/MS_OTHER_VIECLAM_0002.php";
                        }
                        ?>                    
                    </div>
                    <div class="gb-chitiet-vieclam-left-mota">
                        <h3 class="heading-title-vieclam"><i class="fa fa-key" aria-hidden="true" style="color: #000;"></i> Kỹ năng của bản thân</h3>
                        <p>
                            <?php
                            $thong_tin_skill = str_replace("\r\n", "<br>", $ho_so['skill']);
                            echo $thong_tin_skill 
                            ?>     
                        </p>
                    </div>
                    <div class="gb-chitiet-vieclam-left-mota">
                        <h3 class="heading-title-vieclam" style="text-transform: none;"><i class="fa fa-clock-o" aria-hidden="true" style="color: #000;"></i> KINH NGHIỆM LÀM VIỆC <span style="color: red;font-weight: bold;">(<?= $action->getDetail('experience', 'id', $ho_so['experience'])['name'] ?>)</span></h3>
                        <p>
                            <?php
                            $thong_tin_work = str_replace("\r\n", "<br>", $ho_so['work_progress']);
                            echo $thong_tin_work 
                            ?></p>
                    </div>
                    <div class="gb-chitiet-vieclam-left-mota">
                        <h3 class="heading-title-vieclam"><i class="fa fa-hourglass-end" aria-hidden="true" style="color: #000;"></i> Mục tiêu nghề nghiệp</h3>
                        <p>
                         - Mong muốn tìm được chỗ làm ổn định lâu dài<br>
                         - Mong muốn tìm được chỗ làm có cơ hội thăng tiến tốt<br>
                         - Mong muốn tìm được chỗ làm có mức lương tốt<br>
                         - Mong muốn tìm được nơi có cơ hội cống hiến bản thân tốt<br>
                            <?php
                            $thong_tin_item = str_replace("\r\n", "<br>", $ho_so['muc_tieu']);
                            echo $thong_tin_item 
                            ?></p>
                    </div>

                    <div class="gb-chitiet-vieclam-left-contact" id="xem-lien-he" style="display: none;">
                        <h3 class="heading-title-vieclam" style="color: #fff;">Thông tin liên hệ</h3>
                                                <ul>
                            <li><strong style="color: #fff; font-size: 14px;">Người liên hệ:</strong> <span style="color: #ffce45; font-size: 16px; font-weight: bold;">Nguyễn Mai Ly</span></li>
                            <li style="color: #fff;"><strong>Ngày sinh:</strong> <!-- 1995-06-18 -->18/06/1995</li>
                            <li style="color: #fff;"><strong>Địa chỉ:</strong> văn chương tôn đức thắng</li>
                            
                        </ul>
                        
                                            </div>
                                        
                     
                        
                                    </div>

                <!---->
                
            </div>
            <div class="col-sm-4">
                
            </div>
        </div>
    </div>
</div>
    </div>
<br/>
<form method="POST" enctype="multipart/form-data" action="export.php" id="myForm">
   <input type="hidden" name="img_val" id="img_val" value="" />  
</form>
 
 <div style="text-align: center;">
     <button id="save_image">Lưu thành file ảnh</button>
 </div>


<script type="text/javascript" src="build/html2canvas.js"></script>
<script type="text/javascript">
$('document').ready(function(){
    $("#save_image").click(function(){
         html2canvas($('#export_image'), {
                onrendered: function(canvas) {
                    $('#img_val').val(canvas.toDataURL("image/png"));
                    //Submit the form manually
                    document.getElementById("myForm").submit();
                }
            });
    });
});
</script>

</body>
</html>
