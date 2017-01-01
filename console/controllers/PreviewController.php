<?php

namespace console\controllers;

use Yii;

use \yii\console\Controller;

use frontend\models\VideoPage;

use frontend\helpers\VideoHelper;
use frontend\helpers\PathHelper;

class PreviewController extends Controller
{

    public function actionCreate()
    {
        $isConnected = static::isConnectedToTheInternet();
        if (!$isConnected) return;

        //$video_page_id = 90;
        $video_page_id = static::getVideoPageToMakePreview();

        if (empty($video_page_id)) {
            return;
        }

        $videoPage = VideoPage::findOne($video_page_id);

        $videoPage->preview_status = 'creating';
        $videoPage->save();

        $url = VideoHelper::getDownloadUrl($videoPage);

        $path = Yii::$app->params['downloadFolder'] . 'tmp';

        $out = shell_exec(' /usr/local/bin/youtube-dl ' . '--output "' . $path . '/' . $videoPage->video_page_id . '.%(ext)s" ' . $url);

        //echo $out . "\n";

        $videos = PathHelper::getAllVideosFromFolder($path);

        $name = (string)$videoPage->video_page_id;
        foreach ($videos as $video) {
            $prefix = substr($video, 0, strlen($name));
            if ($prefix == $name) {
                $name = $video;
                break;
            }
        }

        $pathToVideo = $path . '/' . $name;

        $pathToPhoto = Yii::$app->params['downloadFolder'] . 'gallery/' . $video_page_id . '.jpg';
        $pathToPhoto2 = Yii::$app->params['downloadFolder'] . 'preview/' . $video_page_id . '.jpg';

        $pathToProject = '/Users/vitaliyvrublevskiy/PhpstormProjects/grabber/';
        $out .= "\n" . shell_exec($pathToProject . 'preview ' . $pathToVideo . ' 400 50 1 ' . $pathToPhoto);
        //echo $out . "\n";
        $out .= "\n" . shell_exec($pathToProject . 'preview ' . $pathToVideo . ' 400 5 10 ' . $pathToPhoto2);
        //echo $out . "\n";

        $out .= "\n" . shell_exec('/bin/rm ' . $pathToVideo);
        echo $out;

        if (static::checkIfPreviewWasCreated($videoPage)) {
            $videoPage->preview_status = 'created';
        } else {
            $videoPage->preview_status = 'problem';
        }
        $videoPage->save();
    }

    private static function isConnectedToTheInternet()
    {
        $connected = @fsockopen("www.example.com", 80);
        if ($connected) {
            $is_conn = true;
            fclose($connected);
        } else {
            $is_conn = false;
        }
        return $is_conn;
    }

    private static function getVideoPageToMakePreview()
    {
        $creatingNow = VideoPage::find()
            ->where(['preview_status' => 'creating'])
            ->count();

        if ($creatingNow > 0) {
            return null;
        }

        $videoPage = VideoPage::find()
            ->where(['is_hidden' => 'no'])
            ->andWhere(['preview_status' => 'no'])
            ->orderBy('create_time')
            ->one();

        if (!empty($videoPage)) {
            return $videoPage->video_page_id;
        }

        return null;
    }

    private static function checkIfPreviewWasCreated($videoPage)
    {
        $folder1 = Yii::$app->params['downloadFolder'] . 'gallery';
        $folder2 = Yii::$app->params['downloadFolder'] . 'preview';

        $allFiles1 = scandir($folder1);
        $allFiles2 = scandir($folder2);

        $file = $videoPage->video_page_id . '.jpg';

        return in_array($file, $allFiles1) && in_array($file, $allFiles2);
    }
}