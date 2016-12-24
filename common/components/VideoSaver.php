<?php

namespace common\components;

use Yii;

use frontend\models\VideoPage;
use frontend\models\DownloadedVideo;

use frontend\helpers\VideoHelper;

class VideoSaver
{
    public static function saveVideoPage(VideoPage $videoPage)
    {
        $url = VideoHelper::getDownloadUrl($videoPage);

        $path = Yii::$app->params['downloadFolder'] . $videoPage->startLink->getFolderName();

        shell_exec(' mkdir ' . $path);

        $out = shell_exec(' /usr/local/bin/youtube-dl ' . '--output "' . $path . '/' . $videoPage->video_page_id . '.%(ext)s" ' . $url);

        $downloadedVideo = new DownloadedVideo();
        $downloadedVideo->video_page_id = $videoPage->video_page_id;
        $downloadedVideo->log = $out;

        $downloadedVideo->save();

        $videoPage->is_downloaded = 'yes';
        $videoPage->save();
    }
}