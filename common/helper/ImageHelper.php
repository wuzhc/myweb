<?php

namespace common\helper;


use common\config\Conf;
use common\util\ImageUtil;
use Yii;
use yii\bootstrap\Html;
use yii\web\HttpException;

class ImageHelper
{

    /**
     * Generates image thumb
     * Returns default thumb image when file is not exist
     *
     * @param $filename
     * Format is as follows "/uploads/20160604/677c60f0973e78fc76868c79cf5296dc.jpg"
     * @param int $width default to 320
     * @param int $height default to 140
     * @param bool|true $crop
     * @return string
     * @throws HttpException
     * @throws \yii\base\Exception]
     */
    public static function thumb($filename, $width = 320, $height = 140, $crop = true)
    {
        //Returns filename immediately when url contain 'http'
        if (stripos($filename, 'http') !== false) {
            return $filename;
        }

        $localPath = FileHelper::getLocalPath($filename);
        if (!is_file($localPath)) {
            return self::getDefaultThumb();
        }

        $info = pathinfo($localPath);
        $thumbName = $info['filename'] . '-' . md5( filemtime($localPath) . (int)$width . (int)$height . (int)$crop ) . '.' . $info['extension'];
        $thumbWebUrl = Yii::getAlias('@web') . '/' . 'uploads' . '/thumbs/' . $thumbName;
        if (file_exists($thumbWebUrl)) {
            return $thumbWebUrl;
        }

        $thumbPath = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'thumbs' . DIRECTORY_SEPARATOR . $thumbName;
        if (FileHelper::createDirectory(dirname($thumbPath), 0777)) {
            if (self::copyResizedImage($localPath, $thumbPath, $width, $height, $crop)) {
                return $thumbWebUrl;
            }
        }

        return self::getDefaultThumb();
    }

    /**
     * Returns default thumb
     * @return string
     */
    public static function getDefaultThumb()
    {
        return Yii::getAlias('@web') . '/' . Conf::UPLOAD_DEFAULT_DIR . '/' .Conf::THUMB_DEFAULT;
    }

    /**
     * @param $inputFile
     * @param $outputFile
     * @param $width
     * @param null $height
     * @param bool|true $crop
     * @return bool
     * @throws HttpException
     */
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