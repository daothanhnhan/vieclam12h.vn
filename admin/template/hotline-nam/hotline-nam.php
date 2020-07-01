<?php
    $rows = $acc->getList("hotline_nam","","","id","asc",$trang, 20, "hotline-nam");//var_dump($rows);
?>	
    <div class="boxPageNews">
        <h1><a href="index.php?page=them-hotline-nam">Thêm Hotline miền Nam</a></h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Điện thoại</th>
                    <th>Tên</th>
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
                            <td><?= $row['phone']?></td>
                            <td>
                                <?= $row['name']?>
                            </td>
                            <td style="float: none;"><a href="index.php?page=xoa-hotline-nam&id=<?= $row['id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')">Xóa</a> | <a href="index.php?page=sua-hotline-nam&id=<?= $row['id'] ?>" style="float: none;">Sửa</a></td>
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