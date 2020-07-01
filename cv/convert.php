<?php 
$filename = 'mau.jpg';
$image1 = imagecreatefromjpeg($filename);
imagepng($image1, 'mau.png');
?>