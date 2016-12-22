<?php

namespace frontend\helpers;

use Yii;

use frontend\models\Site;
use frontend\models\VideoPage;

class VideoHelper
{
    public static function getDownloadUrl(VideoPage $videoPage)
    {
        $site = Site::findOne(Yii::$app->params['mainSiteId']);

        $currentUrl = $videoPage->url;

        $currentHost = parse_url($currentUrl, PHP_URL_HOST);
        $siteHost = parse_url($site->url, PHP_URL_HOST);

        $currentUrl = str_replace($currentHost, $siteHost, $currentUrl);

        return $currentUrl;
    }
}