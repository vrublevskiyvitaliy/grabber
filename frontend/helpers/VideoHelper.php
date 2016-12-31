<?php

namespace frontend\helpers;

use Yii;

use frontend\models\Site;
use frontend\models\VideoPage;
use yii\base\Exception;

class VideoHelper
{
    public static function getDownloadUrl(VideoPage $videoPage)
    {
        $site = $videoPage->startLink->site;// Site::findOne(Yii::$app->params['mainSiteId']);

        $currentUrl = $videoPage->url;

        $currentHost = parse_url($currentUrl, PHP_URL_HOST);
        $siteHost = parse_url($site->url, PHP_URL_HOST);

        $currentUrl = str_replace($currentHost, $siteHost, $currentUrl);

        return $currentUrl;
    }

    public static function getDuration(VideoPage $videoPage)
    {
        $duration = null;

        $out = shell_exec(' /usr/local/bin/youtube-dl ' . ' --skip-download --get-duration ' . $videoPage->url);

        try {
            $numbers = explode(':', $out);
            $length = count($numbers);
            if ($length > 0 && $length <= 3) {
                if ($length >= 1) {
                    $duration = intval($numbers[$length - 1]);
                }
                if ($length >= 2) {
                    $duration += intval($numbers[$length - 2]) * 60;
                }
                if ($length == 3) {
                    $duration += intval($numbers[$length - 3]) * 60 * 60;
                }

            }

        } catch (Exception $e) {

        }

        return $duration;
    }
}