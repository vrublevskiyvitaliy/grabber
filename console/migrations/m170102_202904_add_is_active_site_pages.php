<?php

use yii\db\Migration;

class m170102_202904_add_is_active_site_pages extends Migration
{
    public function up()
    {
        $this->addColumn('start_links','is_active','ENUM (\'no\', \'yes\') NOT NULL DEFAULT \'yes\'');
    }

    public function down()
    {
        if (isset(Yii::$app->db->schema->getTableSchema('start_links')->columns['is_active'])) {
            $this->dropColumn('start_links','is_active');
        }
    }
}
