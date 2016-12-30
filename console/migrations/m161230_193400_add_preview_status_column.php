<?php

use yii\db\Migration;

class m161230_193400_add_preview_status_column extends Migration
{
    public function up()
    {
        $this->addColumn('video_page','preview_status','ENUM (\'no\',\'created\',\'creating\', \'problem\') NOT NULL DEFAULT \'no\'');
    }

    public function down()
    {
        if (isset(Yii::$app->db->schema->getTableSchema('video_page')->columns['preview_status'])) {
            $this->dropColumn('video_page','preview_status');
        }
    }
}
