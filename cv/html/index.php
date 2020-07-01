<head>
       <meta charset="utf-8"> <!--Thiết lập bảng mã trang web-->
       <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
       <title>Convert html to image using canvas</title>
    </head>
<div id="export_image" style="background: #ccc;">
       <h1 style="color:red">Convert html to image using canvas</h1>
       <?php
        $lists = array(
                     array(
                        'name' => 'Nobita',
                        'email' => 'nobitacnt@gmail.com',
                        'phone' => '0123.456.789',
                     ),
                     array(
                        'name' => 'Xuka',
                        'email' => 'xuka@gmail.com',
                        'phone' => '0222.333.444',
                     ),
                    array(
                        'name' => 'Chaien',
                        'email' => 'chaien@gmail.com',
                        'phone' => '0111.333.444',
                    ),
        )
        ?>
         
        <img alt="" src="test.jpg" style="margin:10px 0px">
         
         
        <table border="1">
            <thead>
                <tr>
                    <td>Tên</td>
                    <td>Email</td>
                    <td>Số điện thoại</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lists as $row):?>
                <tr>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['email']?></td>
                    <td><?php echo $row['phone']?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>   
</div>
<br/>
<form method="POST" enctype="multipart/form-data" action="export.php" id="myForm">
   <input type="hidden" name="img_val" id="img_val" value="" />  
</form>
 
<button id="save_image">Lưu thành file ảnh</button>

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