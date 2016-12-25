<?php

namespace console\controllers;

use \yii\console\Controller;

use common\models\DownloadQueue;
use common\components\VideoSaver;

class DownloadController extends Controller {

    public function actionDownloadNow()
    {

        $isConnected = static::isConnectedToTheInternet();
        if ($isConnected) {
            echo "We are connected to the Internet!\n";

            $download = DownloadQueue::find()
                ->where(['download_status' => 'download_now'])
                ->orderBy('add_time desc')
                ->one();

            if (!empty($download)) {
                $videoFile = $download->videoPage;
                $download->download_status = 'downloading';
                $download->save();

                VideoSaver::saveVideoPage($videoFile);

                $download->download_status = 'downloaded';
                $download->save();
            }

        } else {
            echo "We are not connected to the Internet! Need to wait a little! \n";
        }

    }

    private static function isConnectedToTheInternet()
    {
        $connected = @fsockopen("www.example.com", 80);
        if ($connected){
            $is_conn = true; //action when connected
            fclose($connected);
        }else{
            $is_conn = false; //action in connection failure
        }
        return $is_conn;

    }
}