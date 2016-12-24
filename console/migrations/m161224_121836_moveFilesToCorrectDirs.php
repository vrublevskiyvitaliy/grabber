<?php

use yii\db\Migration;

use frontend\helpers\PathHelper;

use frontend\models\VideoPage;

class m161224_121836_moveFilesToCorrectDirs extends Migration
{
    public function up()
    {
        // create all folders
        $downloadedFiles = VideoPage::find()
            ->where(['is_downloaded' => 'yes'])
            ->all();

        /*
        $folders = [];
        foreach ($downloadedFiles as $file) {
            $title = $file->startLink->folderName;
            if (!in_array($title, $folders)) {
                $folders[] = $title;
            }
        }

        foreach ($folders as $folder) {
            echo $folder . "\n";
            $out = shell_exec(' mkdir ' . Yii::$app->params['downloadFolder'] . $folder);
        }
        */

        foreach ($downloadedFiles as $file) {
            $path = PathHelper::getVideoPathForVideoPage($file);
            $path = PathHelper::prepareForShellExecuting($path);

            $out = shell_exec(' cp ' . $path . ' ' .
                Yii::$app->params['downloadFolder'] . $file->startLink->folderName . '/' . $file->video_page_id . '.mp4'
            );


            echo $file->video_page_id . ' ' . $out . "\n";

            shell_exec(' rm ' . $path);
        }
    }

    public function down()
    {

        return true;
    }
}
