<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\helpers\VideoHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\VideoPage */

$this->title = 'Rate Video';
$this->params['breadcrumbs'][] = ['label' => 'Video Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-page-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'startLink.tittle',
            'tittle',
            [
                'attribute' => 'image_url',
                'value' => $model->image_url,
                'format' => ['image',['width'=>'400','height'=>'300']],
            ],
            [
                'attribute' => 'url',
                'value' => Html::a('Watch', VideoHelper::getDownloadUrl($model)),
                'format' => 'raw'
            ]
        ],
    ]) ?>

    <div style="text-align: center;">
        <?= Html::a(
            'Skip',
            [
                'rate-video',
            ],
            ['class' => 'btn btn-primary']
        ) ?>
        <?= Html::a(
            'Like',
            [
                'rate-video',
                'id' => $model->video_page_id,
                'status' => 'like'
            ],
            ['class' => 'btn btn-primary']
        ) ?>
        <?= Html::a(
            'Dislike',
            [
                'rate-video',
                'id' => $model->video_page_id,
                'status' => 'dislike'
            ],
            ['class' => 'btn btn-primary']
        ) ?>
        <?= Html::a(
            'Best',
            [
                'rate-video',
                'id' => $model->video_page_id,
                'status' => 'best'
            ],
            ['class' => 'btn btn-primary']
        ) ?>
        <?= Html::a(
            'Hide',
            [
                'rate-video',
                'id' => $model->video_page_id,
                'status' => 'hide'
            ],
            ['class' => 'btn btn-primary']
        ) ?>
    </div>


</div>
