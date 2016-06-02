<?php

namespace common\helper;


use common\util\ImageUtil;
use Yii;
use yii\bootstrap\Html;
use common\helper\FileHelper;
use yii\web\HttpException;

class ImageHelper
{

    /**
     * image thumb
     * @param $filename
     * @param null $width
     * @param null $height
     * @param bool|true $crop
     * @return string
     * @throws HttpException
     * @throws \yii\base\Exception
     */
    public static function thumb($filename, $width = null, $height = null, $crop = true)
    {
        //Returns filename immediately when url contain 'http'
        if (stripos($filename, 'http') !== false) {
            return $filename;
        }

        $filePath = FileHelper::getFilePath($filename);
        if(file_exists($filePath)) {
            $info = pathinfo($filePath);
            $thumbName = $info['filename'] . '-' . md5( filemtime($filePath) . (int)$width . (int)$height . (int)$crop ) . '.' . $info['extension'];
            $thumbFile = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'thumbs' . DIRECTORY_SEPARATOR . $thumbName;
            $thumbWebFile = Yii::getAlias('@web') . '/' . 'uploads' . '/thumbs/' . $thumbName;
            if(file_exists($thumbFile)){
                return $thumbWebFile;
            } elseif (FileHelper::createDirectory(dirname($thumbFile), 0777) && self::copyResizedImage($filename, $thumbFile, $width, $height, $crop)) {
                return $thumbWebFile;
            }
        }

        return '';
    }

    public static function copyResizedImage($inputFile, $outputFile, $width, $height = null, $crop = true)
    {
        if (extension_loaded('gd'))
        {
            $image = new ImageUtil($inputFile);

            if($height) {
                if($width && $crop){
                    $image->cropThumbnail($width, $height);
                } else {
                    $image->resizeToHeight($height);
                }
            } else {
                $image->resizeToWidth($width);
            }

            return $image->save($outputFile);
        }

        elseif(extension_loaded('imagick'))
        {
            $image = new \Imagick($inputFile);

            if ($height && !$crop) {
                $image->resizeImage($width, $height, \Imagick::FILTER_LANCZOS, 1, true);
            } else{
                $image->resizeImage($width, null, \Imagick::FILTER_LANCZOS, 1);
            }

            if ($height && $crop) {
                $image->cropThumbnailImage($width, $height);
            }

            return $image->writeImage($outputFile);
        }
        else {
            throw new HttpException(500, 'Please install GD or Imagick extension');
        }
    }

    /**
     * show image in html
     * @param $fileUrl
     * @return string
     */
    public static function showImageInHtml($fileUrl)
    {
        $fileUrl = \common\helper\FileHelper::getFileWebUrl($fileUrl);
        return Html::img($fileUrl);
    }

}