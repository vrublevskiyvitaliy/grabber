<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\VideoPage */
/* @var $searchModel frontend\models\ActorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = $model->video_page_id;
$this->params['breadcrumbs'][] = ['label' => 'Video Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['video_page_id'] = $model->video_page_id;
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'actor_name',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>