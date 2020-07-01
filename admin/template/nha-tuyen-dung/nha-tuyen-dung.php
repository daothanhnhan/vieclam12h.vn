<?php
    if (isset($_GET['name'])) {
        $rows = $acc->getList_admin_nhatuyen("nha_tuyen_dung","","","nha_tuyen_dung.id","desc",$trang, 20, "nha-tuyen-dung");
    } else {
        $rows = $acc->getList("nha_tuyen_dung","","","id","desc",$trang, 20, "nha-tuyen-dung");//var_dump($rows);
    }
    $trinhdo = $acc->getList('level_2', '', '', 'id', 'asc', '', '', '');
    $level = isset($_GET['level']) ? $_GET['level'] : '0';

    function set_color ($id) {
        global $conn_vn;
        $action = new action_page();
        $don_tuyen = $action->getList('thong_tin_tuyen_dung', 'nha_tuyen_dung_id', $id, '', '', '');//var_dump($don_tuyen);
        $color = '';
        $date = $don_tuyen[0]['ngay'];
        $now = date("Y-m-d");
        $now = strtotime($now);
        foreach ($don_tuyen as $item) {
            if ($item['ngay'] < $date) {
                $date = $item['ngay'];
            }
        }
        $date = strtotime($date);
        $mau = 0;
        foreach ($don_tuyen as $item) {
            if ($item['home']==1 || $item['trang_tuyen']==1) {
                $mau = 1;
                break;
            }
        }
        if ($mau == 1) {
            if ($now > $date) {
                $color = "color:red; font-weight: bold;";
            } else {
                $vang = $date - $now;
                if ($vang <= 259200) {
                    $color = "color:#ffbe00; font-weight: bold;";
                } else {
                    $color = "color:#19a05e; font-weight: bold;";
                }
            }
        }
        // echo $color;
        // echo $date;
        return $color;
    }
    // set_color(51);
    function get_so_don ($id) {
        global $conn_vn;
        $action = new action_page();
        $don_tuyen = $action->getList('thong_tin_tuyen_dung', 'nha_tuyen_dung_id', $id, '', '', '');
        $so_ldpt = 0;
        $so_bc = 0;
        foreach ($don_tuyen as $item) {
            if ($item['level']==6 || $item['level']==7 || $item['level']==8 || $item['level']==9) {
                $so_ldpt++;
            } else {
                $so_bc++;
            }
        }
        return $so_ldpt.' ldpt, '.$so_bc.' bc';
    }
    // get_so_don(51);
    // var_dump($_SESSION);
?>  
    <div class="boxPageNews">
        <h1><a href="index.php?page=them-nha-tuyen-dung">Thêm nhà tuyển dụng</a></h1>
        <div class="row" style="clear: both;">
            <form action="" method="get">
                <input type="hidden" name="page" value="nha-tuyen-dung">
                <div class="col-sm-2">
                    <label for="usr">Tên công ty:</label>
                    <input type="text" class="form-control" name="name" id="usr" value="<?= isset($_GET['name']) ? $_GET['name'] : '' ?>">
                </div>
                <div class="col-sm-2">
                    <label for="code">Mã công ty:</label>
                    <input type="text" class="form-control" name="code" id="code" value="<?= isset($_GET['code']) ? $_GET['code'] : '' ?>">
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                      <label for="sel1">Trình độ:</label>
                      <select class="form-control" name="level" id="sel1">
                        <option value="0">Tất cả</option>
                        <option value="6" <?= 6==$level ? 'selected' : '' ?> >THCS/THPT</option>
                        <option value="7" <?= 7==$level ? 'selected' : '' ?> >Chứng chỉ nghề</option>
                        <option value="8" <?= 8==$level ? 'selected' : '' ?> >Bằng lái ô tô</option>
                        <option value="9" <?= 9==$level ? 'selected' : '' ?> >Bằng lái Xúc, Nâng</option>
                        <option value="1" <?= 1==$level ? 'selected' : '' ?> >Trung cấp</option>
                        <option value="2" <?= 2==$level ? 'selected' : '' ?> >Cao đẳng</option>
                        <option value="3" <?= 3==$level ? 'selected' : '' ?> >Đại học</option>
                        <option value="4" <?= 4==$level ? 'selected' : '' ?> >Thạc sĩ</option>
                        <option value="5" <?= 5==$level ? 'selected' : '' ?> >Tiến sĩ</option>
                      </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <label for="from">Từ ngày:</label>
                    <input type="date" class="form-control" name="from" id="from" value="<?= isset($_GET['from']) ? $_GET['from'] : '' ?>">
                </div>
                <div class="col-sm-2">
                    <label for="to">Đến ngày:</label>
                    <input type="date" class="form-control" name="to" id="to" value="<?= isset($_GET['to']) ? $_GET['to'] : '' ?>">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-default">Lọc</button>
                </div>
            </form>
        </div>
        <div class="paging">             
          <?= $rows['paging'] ?>
    </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã</th>
                    <th>Tên Công ty</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Ảnh</th>
                    <th>Hoạt động</th>
                    <th>Đơn tuyển</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $d = 0;
                    foreach ($rows['data'] as $row) {
                        $d++;
                        if (isset($_GET['name'])) {
                            $nha_tuyen_dung_id = $row['nha_tuyen_dung_id'];
                        } else {
                            $nha_tuyen_dung_id = $row['id'];
                        }
                        $so_don = $action->getList('thong_tin_tuyen_dung', 'nha_tuyen_dung_id', $nha_tuyen_dung_id, 'id', 'asc', '', '', '');
                        $so_don = count($so_don);
                        $color = set_color($nha_tuyen_dung_id);
                        $co_sodon = get_so_don($nha_tuyen_dung_id);
                    ?>
                        <tr>
                            <td><?= $d ?></td>
                            <?php if (isset($_GET['name'])) { ?>
                            <td><?= $row['nha_tuyen_dung_id'] ?></td>
                            <?php } else { ?>
                            <td><?= $row['id'] ?></td>
                            <?php } ?>
                            <td style="<?= $color ?>"><?= $row['company']?></td>
                            <td><?= $row['email']?></td>
                            <td><?= $row['phone']?></td>
                            <td>
                                <img src="/images/<?= $row['image']=='' ? 'no-photo.png' : $row['image'] ?>" width="100">
                            </td>
                            <?php if (isset($_GET['name'])) { ?>
                            <td style="float: none;"><a href="index.php?page=xoa-nha-tuyen-dung&id=<?= $row['nha_tuyen_dung_id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')">Xóa</a> | <a href="index.php?page=sua-nha-tuyen-dung&id=<?= $row['nha_tuyen_dung_id'] ?>" style="float: none;">Sửa</a></td>
                            <td><a href="index.php?page=don-tuyen&nha_tuyen_dung_id=<?= $row['nha_tuyen_dung_id'] ?>"><?= $co_sodon ?> </a></td>
                            <?php } else { ?>
                            <td style="float: none;"><a href="index.php?page=xoa-nha-tuyen-dung&id=<?= $row['id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')"><?= $_SESSION['admin_role']==1 ? 'Xóa' : '' ?></a> | <a href="index.php?page=sua-nha-tuyen-dung&id=<?= $row['id'] ?>" style="float: none;">Sửa</a></td>
                            <td><a href="index.php?page=don-tuyen&nha_tuyen_dung_id=<?= $row['id'] ?>"><?= $co_sodon ?> </a></td>
                            <?php } ?>
                            
                        </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>
      
        <div class="paging">             
          <?= $rows['paging'] ?>
    </div>
    </div>
    <p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ GoldBridge Việt Nam</p>             