<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Actor */
/* @var $searchModel frontend\models\VideoPageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->actor_id;
$this->params['breadcrumbs'][] = ['label' => 'Actors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->actor_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->actor_id], [
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
            'actor_id',
            'actor_name',
        ],
    ]) ?>

    <h2>All Video Pages: </h2>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'startLink.tittle',
            'tittle',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        $options = [
                            'target' => '_blank',
                            'class' => 'inline',
                        ];

                        $url = Url::to(['video-page/view', 'id' => $model->video_page_id]);
                        return Html::a(
                            'View',
                            $url,
                            $options
                        );
                    },
                ],
                'template' => '{view}'
            ]
        ],
    ]); ?>

</div>
