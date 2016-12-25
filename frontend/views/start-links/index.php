<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\StartLinksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Start Links';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="start-links-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Start Links', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'tittle',
            'site.parser_name',
            [
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
                        $url = $model->url;
                        return Html::a(
                            '<span class="glyphicon glyphicon-hd-video"></span>',
                            $url,
                            $options
                        );
                    },
                ],
                'template' => '{open} {view} {update} {delete}'
            ],
        ],
    ]); ?>
</div>
