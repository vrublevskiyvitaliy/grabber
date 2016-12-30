<?php

namespace frontend\helpers;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

use Yii;

use frontend\models\VideoPage;
use yii\base\Exception;

class PathHelper
{
    public static function getAllVideosFromFolder($folder)
    {
        $allFiles = scandir($folder);

        $videoExtensions = ['.mp4','.webm','.mkv'];

        $videoFiles = [];

        foreach ($allFiles as $file) {
            foreach ($videoExtensions as $ext) {
                $currentExt = substr($file, -strlen($ext));
                if (in_array($currentExt, $videoExtensions)) {
                    $videoFiles[] = $file;
                }
            }
        }

        return $videoFiles;
    }


    public static function getVideoPathForVideoPage(VideoPage $videoPage)
    {
        $path = null;

        $pathToType = Yii::$app->params['downloadFolder'] . $videoPage->startLink->getFolderName() . '/';

        $videos = static::getAllVideosFromFolder($pathToType);

        foreach ($videos as $video) {
            $prefixLen = strlen((string)$videoPage->video_page_id);
            $prefix = substr($video, 0, $prefixLen);
            if ($prefix == (string)$videoPage->video_page_id) {
                $path = $pathToType . $video;
            }
        }
        return $path;
    }

    public static function prepareForShellExecuting($path)
    {
        $path = preg_replace("/[\s_]/", "\ ", $path);
        $path = preg_replace("/[(]/", "\(", $path);
        $path = preg_replace("/[)]/", "\)", $path);
        $path = preg_replace("/[,]/", "\,", $path);
        $path = preg_replace("/[]]/", "\]", $path);
        $path = preg_replace("/[[]/", "\[", $path);

        return $path;
    }

    public static function getFileSizeInMb(VideoPage $videoPage)
    {
        $path = static::getVideoPathForVideoPage($videoPage);

        try {
            $n = filesize($path);
        } catch (Exception $e) {
            $n = 0;
        }


        $n = $n / 1000000;

        return $n;
    }

    public static function getFileSizeInMbPrettyString(VideoPage $videoPage)
    {
        $n = static::getFileSizeInMb($videoPage);

        return number_format($n, 2);
    }

    public static function getDirectorySizeInGb($directory) {
        $size = 0;
        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){
            $size += $file->getSize() / 1000000000;
        }
        return $size;
    }
}