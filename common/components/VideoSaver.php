<?php

namespace common\components;

use frontend\models\VideoPage;
use frontend\helpers\VideoHelper;
use frontend\models\DownloadedVideo;

class VideoSaver
{
    public static function saveVideoPage(VideoPage $videoPage)
    {
        $url = VideoHelper::getDownloadUrl($videoPage);

        $out = shell_exec(' /usr/local/bin/youtube-dl ' . $url);

        $downloadedVideo = new DownloadedVideo();
        $downloadedVideo->video_page_id = $videoPage->video_page_id;
        $downloadedVideo->log = $out;

        $downloadedVideo->save();

        $videoPage->is_downloaded = 'yes';
        $videoPage->save();
    }
}