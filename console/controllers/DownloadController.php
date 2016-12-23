<?php

namespace console\controllers;

use \yii\console\Controller;

class DownloadController extends Controller {

    public function actionDownload()
    {
        $isConnected = static::isConnectedToTheInternet();
        if ($isConnected) {
            echo "We are connected to the Internet!\n";
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