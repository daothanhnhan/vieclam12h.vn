<?php 
$file = 'bg.jpg';
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
?>
<?php 
function square_thumbnail_with_proportion($src_file,$destination_file,$square_dimensions,$jpeg_quality=90)
{
    // Step one: Rezise with proportion the src_file *** I found this in many places.

    $src_img=imagecreatefromjpeg($src_file);

    $old_x=imageSX($src_img);
    $old_y=imageSY($src_img);

    $ratio1=$old_x/$square_dimensions;
    $ratio2=$old_y/$square_dimensions;

    if($ratio1>$ratio2)
    {
        $thumb_w=$square_dimensions;
        $thumb_h=$old_y/$ratio1;
    }
    else    
    {
        $thumb_h=$square_dimensions;
        $thumb_w=$old_x/$ratio2;
    }

    // we create a new image with the new dimmensions
    $smaller_image_with_proportions=ImageCreateTrueColor($thumb_w,$thumb_h);

    // resize the big image to the new created one
    imagecopyresampled($smaller_image_with_proportions,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 

    // *** End of Step one ***

    // Step Two (this is new): "Copy and Paste" the $smaller_image_with_proportions in the center of a white image of the desired square dimensions

    // Create image of $square_dimensions x $square_dimensions in white color (white background)
    $final_image = imagecreatetruecolor($square_dimensions, $square_dimensions);
    $bg = imagecolorallocate ( $final_image, 255, 255, 255 );
    imagefilledrectangle($final_image,0,0,$square_dimensions,$square_dimensions,$bg);

    // need to center the small image in the squared new white image
    if($thumb_w>$thumb_h)
    {
        // more width than height we have to center height
        $dst_x=0;
        $dst_y=($square_dimensions-$thumb_h)/2;
    }
    elseif($thumb_h>$thumb_w)
    {
        // more height than width we have to center width
        $dst_x=($square_dimensions-$thumb_w)/2;
        $dst_y=0;

    }
    else
    {
        $dst_x=0;
        $dst_y=0;
    }

    $src_x=0; // we copy the src image complete
    $src_y=0; // we copy the src image complete

    $src_w=$thumb_w; // we copy the src image complete
    $src_h=$thumb_h; // we copy the src image complete

    $pct=100; // 100% over the white color ... here you can use transparency. 100 is no transparency.

    imagecopymerge($final_image,$smaller_image_with_proportions,$dst_x,$dst_y,$src_x,$src_y,$src_w,$src_h,$pct);

    imagejpeg($final_image,$destination_file,$jpeg_quality);
    // imagejpeg($final_image);

    // destroy aux images (free memory)
    imagedestroy($src_img); 
    imagedestroy($smaller_image_with_proportions);
    imagedestroy($final_image);
}

// square_thumbnail_with_proportion('bg.jpg', 'target.jpg', 600, 100);
?>