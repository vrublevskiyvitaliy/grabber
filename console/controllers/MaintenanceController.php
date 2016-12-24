<?php

namespace console\controllers;

use Yii;

use \yii\console\Controller;

use frontend\helpers\PathHelper;
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
        $downloadedVideos = VideoPage::findAll(['is_downloaded' => 'yes']);

        foreach ($downloadedVideos as $video) {
            $size = PathHelper::getFileSizeInMb($video);
            if ($size < Yii::$app->params['minVideoSize']) {
                $video->is_downloaded = 'problem';
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

}