<?php

use yii\db\Migration;

class m161224_221530_add_parser_name_to_site extends Migration
{
    public function up()
    {
        $this->addColumn('site','parser_name',' varchar(255) NOT NULL');
    }

    public function down()
    {
        if (isset(Yii::$app->db->schema->getTableSchema('site')->columns['parser_name'])) {
            $this->dropColumn('site','parser_name');
        }
        return true;
    }
}
