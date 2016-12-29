<?php

namespace console\controllers;

use Yii;

use \yii\console\Controller;

use frontend\helpers\PathHelper;
use frontend\models\VideoPage;


class PreviewController extends Controller {

    public function actionCreate()
    {
        $video_page_id = 86;
        $videoPage = VideoPage::findOne($video_page_id);
        $pathToVideo = PathHelper::getVideoPathForVideoPage($videoPage);
        $pathToPhoto = Yii::$app->params['downloadFolder'] . 'tmp/86.jpg';

        $pathToProject = '/Users/vitaliyvrublevskiy/PhpstormProjects/grabber/';
        $out = shell_exec($pathToProject . 'preview ' . $pathToVideo . ' 400 3 1 ' . $pathToPhoto);
        echo $out;
    }

}