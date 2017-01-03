<?php

use yii\db\Migration;

class m170102_224132_add_actors_table extends Migration
{
    public function up()
    {
        $this->createTable(
            'actor',
            [
                'actor_id' => $this->primaryKey(),
                'actor_name' => $this->string(255)->notNull(),
            ]
        );


    }

    public function down()
    {
        $this->dropTable('actor');
    }
}
