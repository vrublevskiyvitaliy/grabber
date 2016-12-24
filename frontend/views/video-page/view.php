<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\VideoPage */

$this->title = $model->video_page_id;
$this->params['breadcrumbs'][] = ['label' => 'Video Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-page-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->video_page_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->video_page_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'video_page_id',
            'start_link_id',
            'url:url',
            'image_url:url',
            'tittle',
        ],
    ]) ?>

    <?php if($model->is_downloaded == 'yes'): ?>
        <?= Html::a('Open', ['open', 'id' => $model->video_page_id], ['class' => 'btn btn-primary']) ?>
        <br><br>
        <p> File size: <?= $model->getFileSize() ?>  Mb </p>

        <?php if (!empty($model->lastDownloadFile)): ?>
            <?= DetailView::widget([
                'model' => $model->lastDownloadFile,
                'attributes' => [
                    'log',
                ],
            ]) ?>
        <?php endif; ?>

        <?= Html::a('Delete file', ['delete-video-file', 'id' => $model->video_page_id], ['class' => 'btn btn-primary']) ?>
    <?php else: ?>
        <?= Html::a('Download', ['download', 'id' => $model->video_page_id], ['class' => 'btn btn-primary']) ?>
    <?php endif; ?>

</div>
