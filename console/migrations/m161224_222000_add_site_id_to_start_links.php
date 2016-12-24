<?php

use yii\db\Migration;

class m161224_222000_add_site_id_to_start_links extends Migration
{
    public function up()
    {
        $this->addColumn('start_links','site_id', 'int NOT NULL');

        $this->addForeignKey(
            'fk_start_link_to_site_id',
            'start_links',
            'site_id',
            'site',
            'site_id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        if (isset(Yii::$app->db->schema->getTableSchema('start_links')->columns['site_id'])) {
            $this->dropColumn('start_links','site_id');
            $this->dropForeignKey(
                'fk_start_link_to_site_id',
                'start_links'
            );
        }
        return true;
    }

}
