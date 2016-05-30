<?php

namespace common\helper;


use common\util\ImageUtil;
use Yii;
use yii\helpers\FileHelper;
use yii\web\HttpException;

class ImageHelper
{

    public static function thumb($filename, $width = null, $height = null, $crop = true)
    {
        $filename = str_replace(Yii::$app->request->hostInfo, '', $filename);
        if($filename && file_exists(($filename = Yii::getAlias('@webroot') . $filename)))
        {
            $info = pathinfo($filename);
            $thumbName = $info['filename'] . '-' . md5( filemtime($filename) . (int)$width . (int)$height . (int)$crop ) . '.' . $info['extension'];
            $thumbFile = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'thumbs' . DIRECTORY_SEPARATOR . $thumbName;
            $thumbWebFile = '/' . 'uploads' . '/thumbs/' . $thumbName;
            if(file_exists($thumbFile)){
                return $thumbWebFile;
            }
            elseif (FileHelper::createDirectory(dirname($thumbFile), 0777) && self::copyResizedImage($filename, $thumbFile, $width, $height, $crop)) {
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

}