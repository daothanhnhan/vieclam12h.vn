<?php
    if (isset($_GET['name'])) {
        $rows = $acc->getList_admin_ungvien("ung_vien","type","0","ung_vien.id","desc",$trang, 20, "ung-vien-co-trinh-do");//var_dump($rows);
    } else {
        $rows = $acc->getList("ung_vien","type","0","id","desc",$trang, 20, "ung-vien-co-trinh-do");//var_dump($rows);
    }
    
?>  
    <div class="boxPageNews">
        <h1><a href="index.php?page=them-ung-vien-co-trinh-do">Thêm ứng viên có trình độ</a></h1>
        <div class="row" style="clear: both;">
            <form action="" method="get">
                <input type="hidden" name="page" value="ung-vien-co-trinh-do">
                <div class="col-sm-2">
                    <label for="usr">Tên ứng viên:</label>
                    <input type="text" class="form-control" name="name" id="usr" value="<?= isset($_GET['name']) ? $_GET['name'] : '' ?>">
                </div>
                <div class="col-sm-2">
                    <label for="code">Mã ứng viên:</label>
                    <input type="text" class="form-control" name="code" id="code" value="<?= isset($_GET['code']) ? $_GET['code'] : '' ?>">
                </div>
                
                <div class="col-sm-2">
                    <label for="from">Từ ngày:</label>
                    <input type="date" class="form-control" name="from" id="from" value="<?= isset($_GET['from']) ? $_GET['from'] : '' ?>">
                </div>
                <div class="col-sm-2">
                    <label for="to">Đến ngày:</label>
                    <input type="date" class="form-control" name="to" id="to" value="<?= isset($_GET['to']) ? $_GET['to'] : '' ?>">
                </div>
                <div class="col-sm-4">
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
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Ngày tạo hô sơ</th>
                    <th>Ảnh</th>
                    <th>Hoạt động</th>
                    <th>Hồ sơ</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $d = 0;
                    foreach ($rows['data'] as $row) {
                        $d++;
                        if (isset($_GET['name'])) {
                            $hoso = $action->getDetail('ho_so', 'ung_vien_id', $row['ung_vien_id']);
                        } else {
                            $hoso = $action->getDetail('ho_so', 'ung_vien_id', $row['id']);
                        }
                    ?>
                        <tr>
                            <td><?= $d ?></td>
                            <?php if (isset($_GET['name'])) { ?>
                            <td><?= $row['ung_vien_id']?></td>
                            <?php } else { ?>
                            <td><?= $row['id']?></td>
                            <?php } ?>
                            <td><?= $row['name']?></td>
                            <td><?= $row['email']?></td>
                            <td><?= $row['phone']?></td>
                            <td><?= $hoso['created_at']?></td>
                            <td>
                                <img src="/images/<?= $row['image']=='' ? 'no-photo.png' : $row['image'] ?>" width="100">
                            </td>
                            <?php if (isset($_GET['name'])) { ?>
                            <td style="float: none;"><a href="index.php?page=xoa-ung-vien&id=<?= $row['ung_vien_id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')"><?= $_SESSION['admin_role']==1 ? 'Xóa' : '' ?></a> | <a href="index.php?page=sua-ung-vien&id=<?= $row['ung_vien_id'] ?>" style="float: none;">Sửa</a></td>
                            <td><a href="index.php?page=ho-so&id=<?= $row['ung_vien_id'] ?>">Hồ sơ</a></td>
                            <?php } else { ?>
                            <td style="float: none;"><a href="index.php?page=xoa-ung-vien&id=<?= $row['id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')"><?= $_SESSION['admin_role']==1 ? 'Xóa' : '' ?></a> | <a href="index.php?page=sua-ung-vien&id=<?= $row['id'] ?>" style="float: none;">Sửa</a></td>
                            <td><a href="index.php?page=ho-so&id=<?= $row['id'] ?>">Hồ sơ</a></td>
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