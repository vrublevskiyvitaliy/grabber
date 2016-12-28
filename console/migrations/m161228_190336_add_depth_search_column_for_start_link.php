<?php

use yii\db\Migration;

class m161228_190336_add_depth_search_column_for_start_link extends Migration
{
    public function up()
    {
        $this->addColumn('start_links', 'search_depth', 'int NOT NULL DEFAULT 1');
    }

    public function down()
    {
        if (isset(Yii::$app->db->schema->getTableSchema('start_links')->columns['search_depth'])) {
            $this->dropColumn('start_links','search_depth');
        }
        return true;
    }


}
