<?php

use yii\db\Migration;

class m161224_182228_checkForBadDownloads extends Migration
{
    public function up()
    {
        $this->alterColumn('video_page','is_downloaded','ENUM (\'yes\',\'no\', \'problem\')');
    }

    public function down()
    {
        $this->alterColumn('video_page','is_downloaded','ENUM (\'yes\',\'no\')');
        return true;
    }
}
