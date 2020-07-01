<?php
    $rows = $acc->getList("thong_tin_tuyen_dung","nha_tuyen_dung_id",$_GET['nha_tuyen_dung_id'],"id","asc",$trang, 20, "don-tuyen");//var_dump($rows);
?>	
    <div class="boxPageNews">
        <h1><a href="index.php?page=them-don-tuyen&nha_tuyen_dung_id=<?= $_GET['nha_tuyen_dung_id'] ?>">Thêm đơn tuyển</a></h1>
        <p style="clear:both;"><a href="index.php?page=nha-tuyen-dung">Quay lại</a></p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Ngày tạo</th>
                    <th>Trang chủ</th>
                    <th>Trang tuyển</th>
                    <th>Hoạt động</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $d = 0;
                    foreach ($rows['data'] as $row) {
                        $d++;
                    ?>
                        <tr>
                            <td><?= $d ?></td>
                            <td><?= $row['position']?></td>
                            <td><?= $row['created_at']?></td>
                            <td><?= $row['home_time']?></td>
                            <td><?= $row['tuyen_time']?></td>
                            <td style="float: none;"><a href="index.php?page=xoa-don-tuyen&id=<?= $row['id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')"><?= $_SESSION['admin_role']==1 ? 'Xóa' : '' ?></a> | <a href="index.php?page=sua-don-tuyen&id=<?= $row['id'] ?>" style="float: none;">Sửa</a></td>
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