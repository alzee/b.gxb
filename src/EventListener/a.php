<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

header('Content-type: image/jpeg');

// Create Image From Existing File
$jpg_image = imagecreatefromjpeg(__DIR__ . '/../../public/img/refer_poster0.jpg' );

// Allocate A Color For The Text
$color = imagecolorallocate($jpg_image, 218, 22, 22);

// Set Path to Font File
$font_path = '/usr/share/fonts/dejavu-serif-fonts/DejaVuSerif.ttf';

// Set Text to Be Printed On Image
$text = 'fuck';

// Print Text On Image
imagettftext($jpg_image, 20, 0, 610, 1288, $color, $font_path, $text);

imagejpeg($jpg_image, __DIR__ .  '/../../public/img/poster/refer_poster0.jpg', 100);
imagedestroy($jpg_image);
