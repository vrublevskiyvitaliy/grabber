<?php

use yii\db\Migration;

use frontend\models\Site;

class m161224_225702_add_site_youtube extends Migration
{
    public function up()
    {
        $site = new Site();
        $site->url = 'https://www.youtube.com';
        $site->parser_name = 'Youtube';
        $site->save();
    }

    public function down()
    {
        Site::findOne(['url' => 'https://www.youtube.com'])->delete();
        return true;
    }
}
