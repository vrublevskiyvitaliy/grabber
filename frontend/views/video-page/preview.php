<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\helpers\VideoHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\VideoPage */

$this->title = $model->video_page_id;
$this->params['breadcrumbs'][] = ['label' => 'Video Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['video_page_id'] = $model->video_page_id;

?>
<div class="video-page-view">

    <div class="video-preview" data-frames="100" data-source="http://i.imgur.com/BX0pV4J.jpg"></div>

</div>
<?php $this->registerJsFile('js/video-page/video-preview.js',
    [
        'depends' => [
            \yii\web\JqueryAsset::className(),
        ],
    ]
); ?>