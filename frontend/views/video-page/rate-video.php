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
        <?= $this->render('detail-view', ['model' => $model]) ?>

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
