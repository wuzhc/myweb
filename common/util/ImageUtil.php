<?php

namespace common\util;

class ImageUtil {

    private $_image;
    private $_width;
    private $_height;
    private $_type;

    public function __construct($file)
    {
        if (file_exists($file)) {
            list($this->_width, $this->_height, $this->_type) = getimagesize($file);
            $this->_type = image_type_to_mime_type($this->_type);
            switch ($this->_type) {
                case 'image/jpeg' :
                    $this->_image = imagecreatefromjpeg($file);
                    break;
                case 'image/gif' :
                    $this->_image = imagecreatefromgif($file);
                    break;
                case 'image/png' :
                    $this->_image = imagecreatefrompng($file);
                    break;
            }
        }
    }

    /**
     * resizing by height
     * @param $height
     */
    public function resizeToHeight($height)
    {
        $ratio = $height / $this->_height;
        $width = $this->_width * round($ratio);
        $this->resize($width, $height);
    }

    /**
     * resizing by width
     * @param $width
     */
    public function resizeToWidth($width)
    {
        $ratio = $width / $this->_width;
        $height = $this->_height * round($ratio);
        $this->resize($width, $height);
    }

    /**
     * resize
     * @param string $width
     * @param string $height
     */
    public function resize($width = '', $height = '')
    {
        $resizedImage = imagecreatetruecolor($width, $height);
        if ($this->_type == 'image/png') {
            imagealphablending($resizedImage, false);
        }

        imagecopyresampled($resizedImage, $this->_image, 0, 0, 0, 0, $width, $height, $this->_width, $this->_height);
        $this->_image = $resizedImage;
    }

    /**
     * copies code from the project named easyii
     * @param $width
     * @param $height
     * @return bool
     */
    public function cropThumbnail($width, $height)
    {
        if(!$this->_image || !$width || !$height){
            return false;
        }

        $sourceRatio = $this->_width / $this->_height;
        $thumbRatio = $width / $height;

        $newWidth = $this->_width;
        $newHeight = $this->_height;

        if($sourceRatio !== $thumbRatio)
        {
            if($this->_width >= $this->_height){
                if($thumbRatio > 1){
                    $newHeight = $this->_width / $thumbRatio;
                    if($newHeight > $this->_height){
                        $newWidth = $this->_height * $thumbRatio;
                        $newHeight = $this->_height;
                    }
                } elseif($thumbRatio == 1) {
                    $newWidth = $this->_height;
                    $newHeight = $this->_height;
                } else {
                    $newWidth = $this->_height * $thumbRatio;
                }
            } else {
                if($thumbRatio > 1){
                    $newHeight = $this->_width / $thumbRatio;
                } elseif($thumbRatio == 1) {
                    $newWidth = $this->_width;
                    $newHeight = $this->_width;
                } else {
                    $newHeight = $this->_width / $thumbRatio;
                    if($newHeight > $this->_height){
                        $newHeight = $this->_height;
                        $newWidth = $this->_height * $thumbRatio;
                    }
                }
            }
        }

        $resizedImage = imagecreatetruecolor($width, $height);
        imagealphablending($resizedImage, false);

        imagecopyresampled(
            $resizedImage,
            $this->_image,
            0,
            0,
            round(($this->_width - $newWidth) / 2),
            round(($this->_height - $newHeight) / 2),
            $width,
            $height,
            $newWidth,
            $newHeight
        );

        $this->_image = $resizedImage;
    }


    /**
     * save file
     * @param $outfile
     * @param $quality
     * @return bool
     */
    public function save($outfile, $quality = 70)
    {
        switch ($this->_type) {
            case 'image/jpeg' :
                return imagejpeg($this->_image, $outfile, $quality);
                break;
            case 'image/gif' :
                return imagegif($this->_image, $outfile, $quality);
                break;
            case 'image/png' :
                imagesavealpha($this->_image, true); //设置保存 PNG 图像时保存完整的 alpha 通道信息
                return imagepng($this->_image, $outfile, $quality);
                break;
        }
        return false;
    }

}

