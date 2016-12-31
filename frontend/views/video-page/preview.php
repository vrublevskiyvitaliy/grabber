<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\helpers\VideoHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\VideoPage */

$this->title = $model->video_page_id;
$this->params['breadcrumbs'][] = ['label' => 'Video Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['video_page_id'] = $model->video_page_id;
$url = Url::to(['site/gallery-image', 'id' => $model->video_page_id]);

?>
<div class="video-page-view">
    <?php if ($model->preview_status == 'created'): ?>
        <div class="video-preview" data-frames="50" data-source="<?= $url ?>"></div>
    <?php else: ?>
        <p>Скоро з'явиться!</p>
    <?php endif; ?>
</div>
<?php $this->registerJsFile('js/video-page/video-preview.js',
    [
        'depends' => [
            \yii\web\JqueryAsset::className(),
        ],
    ]
); ?>