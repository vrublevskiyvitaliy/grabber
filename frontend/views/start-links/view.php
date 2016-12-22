<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\StartLinks */

$this->title = $model->start_link_id;
$this->params['breadcrumbs'][] = ['label' => 'Start Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="start-links-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->start_link_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->start_link_id], [
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
            'start_link_id',
            'url:url',
            'tittle',
        ],
    ]) ?>

</div>
