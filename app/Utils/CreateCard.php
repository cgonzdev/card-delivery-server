<?php

$message = 'This is a example message';

$imageCard = 'example_image.jpg';
$font = public_path('fonts/Roboto/Roboto-Medium.ttf');
$imagePath = storage_path('app/public/images/example.jpg');
$image = imagecreatefromjpeg($imagePath);
$color = imagecolorallocate($image, 255 ,255, 255);
$size = 30;
$angle = 0;
$x1 = 100;
$y1 = 100;

imagettftext($image, $size, $angle, $x1, $y1, $color, $font, $message);

header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
