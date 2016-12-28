<?php

namespace console\controllers;

use \yii\console\Controller;

use frontend\models\StartLinks;
use frontend\helpers\SiteHelper;

class ParseController extends Controller {

    public function actionParseStartLinks()
    {
        foreach (StartLinks::find()->each(10) as $startLink) {
            $site = $startLink->site;
            $parserName = $site->parser_name;
            $parser = SiteHelper::getParserByName($parserName);
            $parser::addUnknownVideos($startLink);
        }
    }
}