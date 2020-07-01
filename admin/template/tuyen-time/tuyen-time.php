<?php
    $rows = $acc->getList("bang_gia_4","","","id","asc",$trang, 20, "tuyen-time");//var_dump($rows);
?>	
    <div class="boxPageNews">
        <h1><a href="index.php?page=them-tuyen-time">Thêm gói hiển thị trang tuyển</a></h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tuần</th>
                    <th>Giá</th>
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
                            <td><?= number_format($row['week'])?></td>
                            <td>
                                <?= number_format($row['price'])?> vnđ
                            </td>
                            <td style="float: none;"><a href="index.php?page=xoa-tuyen-time&id=<?= $row['id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')">Xóa</a> | <a href="index.php?page=sua-tuyen-time&id=<?= $row['id'] ?>" style="float: none;">Sửa</a></td>
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
    <p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ Cafelink Việt Nam</p>             