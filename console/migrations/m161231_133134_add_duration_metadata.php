<?php

use yii\db\Migration;

class m161231_133134_add_duration_metadata extends Migration
{
    public function up()
    {
        $this->addColumn('video_page','duration','int DEFAULT NULL');
    }

    public function down()
    {
        if (isset(Yii::$app->db->schema->getTableSchema('video_page')->columns['duration'])) {
            $this->dropColumn('video_page','duration');
        }
    }
}
