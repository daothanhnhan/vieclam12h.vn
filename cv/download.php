<?php 
$vnum = 'test';
header("Content-disposition: attachment; filename=".$vnum.".jpg");
  header('Content-Description: File Transfer');
  readfile("".$vnum.".jpg");
?>