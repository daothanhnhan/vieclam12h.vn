<?php
    $rows = $acc->getList("book_diem","","","id","desc",$trang, 20, "book-diem");//var_dump($rows);
?>	
    <div class="boxPageNews">
        <!-- <h1><a href="index.php?page=them-thuong-hieu">Thêm</a></h1> -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên nhà tuyển dụng</th>
                    <th>Gói điểm</th>
                    <th>Hoạt động</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $d = 0;
                    foreach ($rows['data'] as $row) {
                        $d++;
                        $ntd = $action->getDetail('nha_tuyen_dung', 'id', $row['nha_tuyen_dung_id']);
                        $goi = $action->getDetail('goi_diem', 'id', $row['goi_diem_id']);
                    ?>
                        <tr>
                            <td><?= $d ?></td>
                            <td><?= $ntd['company']?></td>
                            <td>
                                <?= number_format($goi['diem']) ?> điểm
                            </td>
                            <!-- <td style="float: none;"><a href="index.php?page=xoa-thuong-hieu&id=<?= $row['id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')">Xóa</a> | <a href="index.php?page=sua-thuong-hieu&id=<?= $row['id'] ?>" style="float: none;">Sửa</a></td> -->
                            <td><input type="checkbox" onclick="kich_hoat(<?= $row['id'] ?>)" <?= $row['state']==1 ? 'checked' : '' ?> ></td>
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

<script>
    function kich_hoat (id) {
        // alert(id);
        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             // document.getElementById("demo").innerHTML = this.responseText;
             alert(this.responseText);
            }
          };
          xhttp.open("GET", "/functions/ajax/kich_hoat.php?id="+id, true);
          xhttp.send();
    }
</script>