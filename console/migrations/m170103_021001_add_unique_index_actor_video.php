<?php

use yii\db\Migration;

class m170103_021001_add_unique_index_actor_video extends Migration
{
    public function up()
    {
        $this->createIndex(
            'uk_actor_video',
            'actor_to_video_page',
            [
                'actor_id',
                'video_page_id'
            ],
            true
        );
    }

    public function down()
    {
        $this->dropIndex(
            'uk_actor_video',
            'actor_to_video_page'
        );
    }
}
