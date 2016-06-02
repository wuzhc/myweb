<?php

namespace common\helper;


use yii\helpers\FileHelper;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\web\HttpException;
use yii\web\UploadedFile;

class UploadHelper
{
    const UPLOAD_DIR = 'uploads';

    /**
     * upload file to target directory
     * @param UploadedFile $fileInstance
     * @param string $targetDir
     * @return bool|mixed
     * @throws HttpException
     */
    public static function uploadFile(UploadedFile $fileInstance, $targetDir = '')
    {
        if (!($fileInstance instanceof UploadedFile)) {
            return false;
        }

        $filename = self::getUploadPath($targetDir) . DIRECTORY_SEPARATOR;
        $filename .= $fileInstance->baseName . '.' . $fileInstance->extension;

        if (!$fileInstance->saveAs($filename)) {
            throw new HttpException(500, 'Cannot upload file "'.$filename.'". Please check write permissions.');
        }

        return self::getLink($filename);
    }

    /**
     * upload image to target directory
     * @param UploadedFile $fileInstance the instance of file @see {{yii\web\UploadedFile}}
     * @param string $targetDir the file will be save in targetDir if successfully
     * @param string $resizeWidth
     * @param string $resizeHeight
     * @param bool|false $crop
     * @return array|bool
     * @throws HttpException
     */
    public static function uploadImage(UploadedFile $fileInstance, $targetDir = '', $resizeWidth = '', $resizeHeight = '', $crop = true)
    {
        if (!($fileInstance instanceof UploadedFile)) {
            return false;
        }

        $filename = self::getUploadPath($targetDir) . DIRECTORY_SEPARATOR;
        $filename .= $fileInstance->baseName . '.' . $fileInstance->extension;

        if ($crop) {
            $result = ImageHelper::copyResizedImage($fileInstance->tempName, $filename, $resizeWidth, $resizeHeight, $crop);
        } else {
            $result = $fileInstance->saveAs($filename);
        }

        if (!$result) {
            throw new HttpException(500, 'Cannot upload file "'.$filename.'". Please check write permissions.');
        }

        return array('url' => self::getLink($filename), 'title' => $fileInstance->baseName);
    }

    /**
     * get upload path base on web root
     * @param string $targetDir
     * @return string
     * @throws HttpException
     * @throws \yii\base\Exception
     */
    public static function getUploadPath($targetDir = '')
    {
        $path = \Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . self::UPLOAD_DIR;
        $path .= $targetDir ? DIRECTORY_SEPARATOR . $targetDir : '';

        if (!FileHelper::createDirectory($path)) {
            throw new HttpException(500, 'Cannot create "'.$path.'". Please check write permissions.');
        } else {
            return $path;
        }
    }

    public static function getFileName($fileInstanse, $namePostfix = true)
    {
        $baseName = str_ireplace('.'.$fileInstanse->extension, '', $fileInstanse->name);
        $fileName =  StringHelper::truncate(Inflector::slug($baseName, ''), 32, '');
        if($namePostfix || !$fileName) {
            $fileName .= substr(uniqid(md5(rand()), true), 0, 10);
        }
        $fileName .= '.' . $fileInstanse->extension;

        return $fileName;
    }

    public static function getLink($filename)
    {
        return str_replace('\\', '/', str_replace(\Yii::getAlias('@webroot'), '', $filename));
    }
}