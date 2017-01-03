<?php

use yii\db\Migration;

class m170102_224547_add_actor_to_video_page_table extends Migration
{
    public function up()
    {
        $this->createTable(
            'actor_to_video_page',
            [
                'actor_to_video_page_id' => $this->primaryKey(),
                'actor_id' => $this->integer()->notNull(),
                'video_page_id' => $this->integer()->notNull(),
            ]
        );

        $this->addForeignKey(
            'fk_actor_to_video_page_actor',
            'actor_to_video_page',
            'actor_id',
            'actor',
            'actor_id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_actor_to_video_page_video_page',
            'actor_to_video_page',
            'video_page_id',
            'video_page',
            'video_page_id',
            'CASCADE',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropTable('actor_to_video_page');

        $this->dropForeignKey(
            'fk_actor_to_video_page_actor',
            'actor_to_video_page'
        );

        $this->dropForeignKey(
            'fk_actor_to_video_page_video_page',
            'actor_to_video_page'
        );
    }
}
