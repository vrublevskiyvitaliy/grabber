<?php

namespace frontend\helpers;

use frontend\models\VideoPage;
use Yii;

class PathHelper
{
    public static function getAllVideosFromDefaultFolder()
    {
        $allFiles = scandir(Yii::$app->params['downloadFolder']);

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

        $allVideoFiles = static::getAllVideosFromDefaultFolder();

        $title = $videoPage->tittle;

        foreach ($allVideoFiles as $video) {
            $tmp = substr($video, 0, strlen($title));
            if ($tmp == $title) {
                $path = Yii::$app->params['downloadFolder'] . $video;
                break;
            }
        }

        return $path;
    }

    public static function prepareForShellExecuting($path)
    {
        $path = preg_replace("/[\s_]/", "\ ", $path);

        return $path;
    }
}