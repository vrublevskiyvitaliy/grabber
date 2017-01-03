<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\VideoPage */
/* @var $searchModel frontend\models\ActorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = $model->video_page_id;
$this->params['breadcrumbs'][] = ['label' => 'Video Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['video_page_id'] = $model->video_page_id;
?>

<p>
    <?= Html::a('Add', ['add-actor', 'id' => $model->video_page_id], ['class' => 'btn btn-primary']) ?>
</p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'actor_name',
        [
            'class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    $options = [
                        'target' => '_blank',
                        'class' => 'inline',
                    ];

                    $url = Url::to(['actor/view', 'id' => $model->actor_id]);
                    return Html::a(
                        'View',
                        $url,
                        $options
                    );
                },
                'delete' => function ($url, $model, $key) {
                    $url = Url::to([
                        'video-page/delete-actor',
                        'actor_id' => $model->actor_id,
                        'video_page_id' => $this->params['video_page_id']
                    ]);
                    return Html::a(
                        'Delete',
                        $url
                    );
                },
            ],
            'template' => '{view} {delete}'
        ],
    ],
]); ?>