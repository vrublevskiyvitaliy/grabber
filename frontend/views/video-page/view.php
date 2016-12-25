<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\helpers\VideoHelper;

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
        <?= Html::a('Rate this video', ['rate-video', 'id' => $model->video_page_id], ['class' => 'btn btn-primary']) ?>
    </p>

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
                'value' => Html::a('Watch', VideoHelper::getDownloadUrl($model), ['target' => '_blank']),
                'format' => 'raw',
            ]
        ],
    ]) ?>

    <?php if($model->is_downloaded == 'yes'): ?>
        <?= Html::a('Open', ['open', 'id' => $model->video_page_id], ['class' => 'btn btn-primary']) ?>
        <br><br>
        <p> File size: <?= $model->getFileSizePrettyString() ?>  Mb </p>

        <?php if (!empty($model->lastDownloadFile)): ?>
            <?= Html::a('Log', '#', ['class' => 'btn btn-primary log_hidden', 'id' => 'js_log_toggle']) ?>
            <div id="js_log" class="hidden">
                <?= DetailView::widget([
                    'model' => $model->lastDownloadFile,
                    'attributes' => [
                        [
                            'attribute' => 'log',
                            'value' => $model->lastDownloadFile->prettyLog,
                            'format' => 'raw'
                        ],
                    ],
                ]) ?>
            </div>
        <?php endif; ?>

        <?= Html::a(
            'Delete file',
            [
                'delete-video-file',
                'id' => $model->video_page_id
            ],
            [
                'class' => 'btn btn-primary',
                'data' => [
                    'confirm' => 'Точно видалити?',
                ],
            ]
        ) ?>

    <?php elseif ($model->isDownloadingRightNow()): ?>
        <p>It's downloading right now!</p>
    <?php elseif (!$model->isInDownloadQueue()): ?>
        <?= Html::a(
            'Download',
            [
                'download',
                'id' => $model->video_page_id
            ],
            [
                'class' => 'btn btn-primary',
            ]) ?>
    <?php else:?>
        <p>It's going to be downloaded soon!</p>
    <?php endif; ?>

</div>
<?php $this->registerJsFile('js/video-page/view.js',
    [
        'depends' => [
            \yii\web\JqueryAsset::className(),
        ],
    ]
); ?>