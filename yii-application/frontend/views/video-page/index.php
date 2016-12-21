<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\VideoPageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Video Pages';
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
            ['class' => 'yii\grid\SerialColumn'],

            'video_page_id',
            'start_link_id',
            'url:url',
            'image_url:url',
            'tittle',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
