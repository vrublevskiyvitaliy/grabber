<?php

namespace frontend\helpers;

use Yii;

use frontend\models\VideoPage;
use yii\base\Exception;

class PathHelper
{
    public static function getAllVideosFromFolder($folder)
    {
        $allFiles = scandir($folder);

        $videoExtensions = ['.mp4'];

        $videoFiles = [];

        foreach ($allFiles as $file) {
            $currentExt = substr($file, -4);
            if (in_array($currentExt, $videoExtensions)) {
                $videoFiles[] = $file;
            }
        }

        return $videoFiles;
    }


    public static function getVideoPathForVideoPage(VideoPage $videoPage)
    {
        $path = null;

        $pathToType = Yii::$app->params['downloadFolder'] . $videoPage->startLink->getFolderName() . '/';

        $path = $pathToType . $videoPage->video_page_id . '.mp4';

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
}