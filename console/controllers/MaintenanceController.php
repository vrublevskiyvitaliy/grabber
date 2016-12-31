<?php

namespace console\controllers;

use Yii;

use \yii\console\Controller;

use frontend\helpers\PathHelper;
use frontend\helpers\VideoHelper;

use frontend\models\VideoPage;

class MaintenanceController extends Controller {

    public function actionCheckForDoubleUrls()
    {
        $doubleVideos = $this->getDoubleUrls(true);

        if (empty($doubleVideos)) {
            echo 'Not Found';
        } else {
            echo 'Found ' . count($doubleVideos) . ' matches.';
        }
    }

    public function actionDeleteDoubleUrls()
    {
        $doubleVideos = $this->getDoubleUrls();

        foreach($doubleVideos as $badId) {
            VideoPage::findOne($badId)->delete();
        }

        echo 'There was deleted ' . count($doubleVideos) . ' videos';
    }


    public function actionCheckDownloaded()
    {
        $downloadedVideos = VideoPage::find()
            ->where(['is_downloaded' => 'yes'])
            ->orWhere(['is_downloaded' => 'problem'])
            ->all();

        foreach ($downloadedVideos as $video) {
            //echo $video->video_page_id . "\n";
            //echo PathHelper::getVideoPathForVideoPage($video) . "\n";
            $size = PathHelper::getFileSizeInMb($video);
            //echo $size . "\n";

            if ($size < Yii::$app->params['minVideoSize']) {
                $video->is_downloaded = 'problem';
                $video->save();
            } else {
                $video->is_downloaded = 'yes';
                $video->save();
            }
        }
        //echo "Checked downloaded videos";
    }

    private function getDoubleUrls($echoResult = false)
    {
        $allVideos = VideoPage::find()->orderBy('video_page_id ASC')->all();

        $doubleVideos = [];
        foreach ($allVideos as $video) {
            $matches = VideoPage::find()
                ->where(['url' => $video->url])
                ->andWhere(['>', 'video_page_id', $video->video_page_id])
                ->all();

            foreach ($matches as $copy) {
                if (in_array($copy->video_page_id, $doubleVideos)) continue;

                if ($echoResult) {
                    echo 'Found match ' . $video->video_page_id . ' to ' . $copy->video_page_id . " \n";
                }

                $doubleVideos[] = $copy->video_page_id;
            }
        }

        return $doubleVideos;
    }

    public function actionSetDurations()
    {
        foreach (VideoPage::find()->all() as $videoPage) {
            $videoPage->save();
        }
    }
}