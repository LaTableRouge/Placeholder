<?php
    $path = 'path/to/your/pictures';

    $files = scandir($path);
    $files = array_diff(scandir($path), array('.', '..'));
    $files = array_values($files);

    if (isset($files) && sizeof($files) !== 0) {
        $sizes = isset($_GET['size']) ? $_GET['size'] : '1000/1000';
        $sizes = explode("/", $sizes);

        $newWidth = $sizes[0];
        $newHeight = $sizes[1];

        $filePath = "{$path}/{$files[array_rand($files)]}";

        //resize and crop image by center
        function resize_crop_image($max_width, $max_height, $source_file){
            $imgsize = getimagesize($source_file);
            $width = $imgsize[0];
            $height = $imgsize[1];
            $mime = $imgsize['mime'];

            switch($mime){
                case 'image/gif':
                    $image_create = "imagecreatefromgif";
                    $image_return = "imagegif";
                    $header = 'image/gif';
                    break;

                case 'image/png':
                    $image_create = "imagecreatefrompng";
                    $image_return = "imagepng";
                    $header = 'image/png';
                    break;

                case 'image/jpeg':
                    $image_create = "imagecreatefromjpeg";
                    $image_return = "imagejpeg";
                    $header = 'image/jpeg';
                    break;

                case 'image/webp':
                    $image_create = "imagecreatefromwebp";
                    $image_return = "imagewebp";
                    $header = 'image/webp';
                    break;

                default:
                    return false;
                    break;
            }

            $image = $image_create($source_file);

            $color = imagecolorallocate($image, 255, 255, 255);
            $string = "";
            $fontSize = 10;
            $text_padding_x = 10;
            $text_padding_y = 10;

            $thumb_width = $max_width;
            $thumb_height = $max_height;

            $width = imagesx($image);
            $height = imagesy($image);

            $original_aspect = $width / $height;
            $thumb_aspect = $thumb_width / $thumb_height;

            if ($original_aspect >= $thumb_aspect){
               // If image is wider than thumbnail (in aspect ratio sense)
               $new_height = $thumb_height;
               $new_width = $width / ($height / $thumb_height);
            }else{
               // If the thumbnail is wider than the image
               $new_width = $thumb_width;
               $new_height = $height / ($width / $thumb_width);
            }

            $thumb = imagecreatetruecolor($thumb_width, $thumb_height);

            // Resize and crop
            imagecopyresampled(
                $thumb,
                $image,
                0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                0, 0,
                $new_width, $new_height,
                $width, $height
            );
            header("Content-Type: {$header}");
            imagestring($thumb, $fontSize, $text_padding_x, $text_padding_y, $string, $color);
            $image_return($thumb);
        }
        //usage example
        resize_crop_image($newWidth, $newHeight, $filePath);
    }
?>
