<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\VideoPageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Downloaded Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Video Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
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
                    $url = Url::to([
                        'video-page/index-downloaded',
                        'VideoPageSearch' => [
                            'startLinkTitle' => $model->startLink->tittle,
                            'title' => '',
                        ]
                    ]);
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
                'class' => \yii\grid\Column::class,
                'content' => function ($model, $key, $index, $column) {
                    $fileSize = $model->getFileSizePrettyString();
                    return $fileSize . ' Mb';
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        $options = [
                            'title' => 'Открыть на сайте',
                            'aria-label' => 'Открыть на сайте',
                            'data-pjax' => '0',
                            'target' => '_blank',
                            'class' => 'inline',
                        ];

                        $url = $model->url;
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>',
                            $url,
                            $options
                        );
                    },
                ],
            ],
        ],
    ]); ?>
</div>