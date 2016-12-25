<?php

use yii\db\Migration;

use frontend\models\Site;

class m161225_114326_rename_site_parser_name extends Migration
{
    public function up()
    {
        $site = Site::findOne(['parser_name' => 'Youtube']);
        $site->parser_name = 'YoutubeSearch';
        $site->save();
    }

    public function down()
    {
        $site = Site::findOne(['parser_name' => 'YoutubeSearch']);
        $site->parser_name = 'Youtube';
        $site->save();
    }
}
