<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\helpers\VideoHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\VideoPage|null */

$this->title = 'Rate Video';
$this->params['breadcrumbs'][] = ['label' => 'Video Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-page-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (empty($model)): ?>
        <p>Всі відео вже були оцінені!</p>
    <?php else: ?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute' => 'startLink.tittle',
                    'label' => 'Тема'
                ],
                [
                    'attribute' => 'tittle',
                    'label' => 'Назва'
                ],
                [
                    'attribute' => 'image_url',
                    'label' => 'Preview',
                    'value' => $this->render('/gallery/preview-gallery', ['model' => $model]),
                    'format' => 'raw',
                    'contentOptions' => ['style' => ['height' => '400px', 'white-space' =>'pre-wrap']]
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
    <?php endif; ?>
</div>
