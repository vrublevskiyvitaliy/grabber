<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use frontend\helpers\VideoHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\VideoPageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $title string */
/* @var $showFileSize boolean */

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    [
        'attribute' => 'image',
        'label' => 'Image',
        'content' => function ($model) {
            return Html::img(
                $model->image_url,
                ['width' => 320, 'height' => 240]
            );
        },
    ],
    [
        'attribute' => 'startLinkTitle',
        'label' => 'Type',
        'content' => function ($model) {
            $options = [
                'target' => '_blank',
                'class' => 'inline',
            ];
            $urlParams = [
                'video-page/index',
                'VideoPageSearch' => [
                    'startLinkTitle' => $model->startLink->tittle,
                ]
            ];

            if (!empty(Yii::$app->request->get('pageName'))) {
                $urlParams['pageName'] =  Yii::$app->request->get('pageName');
            }
            $url = Url::to($urlParams);
            return Html::a(
                $model->startLink->tittle,
                $url,
                $options
            );
        },
    ],
    [
        'attribute' => 'tittle',
        'contentOptions' => ['style' => ['max-width' => '580px;', 'height' => '240px', 'white-space' =>'pre-wrap']]
    ],
    [
        'attribute' => 'duration',
        'content' => function ($model) {
            return $model->getPrettyDuration();
        },
    ],
];

if ($showFileSize) {
    $gridColumns[] = [
        'class' => \yii\grid\Column::class,
        'content' => function ($model, $key, $index, $column) {
            $fileSize = $model->getFileSizePrettyString();
            return $fileSize . ' Mb';
        },
    ];
}

$gridColumns[] = [
    'class' => 'yii\grid\ActionColumn',
    'buttons' => [
        'open' => function ($url, $model, $key) {
            $options = [
                'title' => 'Открыть на сайте',
                'aria-label' => 'Открыть на сайте',
                'data-pjax' => '0',
                'target' => '_blank',
                'class' => 'inline',
            ];

            $url = VideoHelper::getDownloadUrl($model);
            return Html::a(
                '<span class="glyphicon glyphicon-hd-video"></span>',
                $url,
                $options
            );
        },
        'rate' => function ($url, $model, $key) {
            $options = [
                'title' => 'Rate',
                'aria-label' => 'Rate',
                'data-pjax' => '0',
                'target' => '_blank',
                'class' => 'inline',
            ];

            $url = Url::to(['rate-video', 'id' => $model->video_page_id]);
            return Html::a(
                '<span class="glyphicon glyphicon-thumbs-up"></span>',
                $url,
                $options
            );
        },
    ],
    'template' => '{open} {view} {rate} {update} {delete}'
];

?>
<div class="video-page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns
    ]); ?>
</div>
