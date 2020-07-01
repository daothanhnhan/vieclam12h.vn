<?php 
$rows = $action->getList('lien_he','','','id','desc',$trang,20,'lien-he');//var_dump($rows_lien_he);die();
?>
<div class="container">
  <h2>Bảng lên hệ.</h2>            
  <table class="table">
    <thead>
      <tr>
      	<th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <!-- <th>Address</th> -->
        <th>Comment</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($rows['data'] as $item) { ?>
      <tr>
        <td><?php echo $item['name'];?></td>
        <td><?php echo $item['email'];?></td>
        <td><?php echo $item['phone'];?></td>
        <!-- <td><?php echo $item['address'];?></td> -->
        <td><?php echo $item['comment'];?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
<?php
    echo $rows['paging']; 
?>
</div>
