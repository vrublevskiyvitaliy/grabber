<?php

use yii\db\Migration;

class m161225_075449_add_downloading_status extends Migration
{
    public function up()
    {
        $this->alterColumn('download_queue','download_status','ENUM (\'download_now\',\'download_regularly\',\'downloaded\', \'downloading\')');
    }

    public function down()
    {
        $this->alterColumn('download_queue','download_status','ENUM (\'download_now\',\'download_regularly\',\'downloaded\')');

        return true;
    }
}
