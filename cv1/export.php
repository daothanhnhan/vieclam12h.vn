<?php
// Xu ly form
if (isset($_POST['img_val']))
{
    $img_val = $_POST['img_val'];
 
    //Get the base-64 string from data
    $filteredData = substr($img_val, strpos($img_val, ",")+1);
 
    //Decode the string
    $unencodedData = base64_decode($filteredData);
 
    //Save the image
    $url = 'upload/info_cv.png';
    file_put_contents($url, $unencodedData);
     
    //notice this content-type, it will force a download since browsers think that's what they should do with .exe files
    header('Content-Description: File Transfer');
    header("Content-type: application/octet-stream");
    header("Content-disposition: attachment; filename= info_cv.png");
    readfile($url);
}