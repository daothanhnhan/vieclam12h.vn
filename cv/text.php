<?php
   header('Content-type: image/jpeg');
  $image = imagecreatefromjpeg('bg.jpg');
  $textcolor = imagecolorallocate($image, 255, 0, 0);
  $font_file = 'arial.ttf';
  // $font_file = 'myfont.ttf';
  $custom_text = "Watermark Text";
  imagettftext($image, 100, 0, 0, 100, $textcolor, $font_file, $custom_text);
  // imagestring($image, 60, 50, 50,  'A Simple Text String', $textcolor);
  imagejpeg($image);
 imagedestroy($image); // for clearing memory
?>