<?php 
include_once "img.php";
// create a transparent base image that we will merge the cropped images into.
$img = new Img('./mau.png');
// $img->create(400, 400, false);
// $image = imagecreatefromjpeg('bg.jpg');

// first image; crop and merge with base.
// $img2 = new Img('./59pS7.png');
$img2 = new Img('./bg1.png');
// $img2->circleCrop();
// $img->merge($img2, 0, 0);
//////////////////////////////
// $file = 'bg.jpg';
$file = 'https://vieclam12h.vn/images/157147297728750b504fbca5e2fcad.jpg';
list($x, $y) = getimagesize($file);

// code snippet from above goes here
// horizontal rectangle
if ($x > $y) {
    $square = $y;              // $square: square side length
    $offsetX = ($x - $y) / 2;  // x offset based on the rectangle
    $offsetY = 0;              // y offset based on the rectangle
}
// vertical rectangle
elseif ($y > $x) {
    $square = $x;
    $offsetX = 0;
    $offsetY = ($y - $x) / 2;
}
// it's already a square
else {
    $square = $x;
    $offsetX = $offsetY = 0;
}
// so we get the square side and the offsets
// echo $y;die;
$endSize = 185;
$tn = imagecreatetruecolor($endSize, $endSize);
$image = imagecreatefromjpeg($file);
imagecopyresampled($tn, $image, 0, 0, $offsetX, $offsetY, $endSize, $endSize, $square, $square);
imagejpeg($tn, 'target1.jpg', 100); 
/////////////////////////////////
$filename = 'target1.jpg';
$image1 = imagecreatefromjpeg($filename);
imagepng($image1, 'target1.png');
//////////////////////////////

// second image; crop and merge with base.
$img3 = new Img('./target1.png');
$img3->circleCrop();
$img->merge($img3, 625, 110);
///////////////
$img->text();

$img->render();
?>