<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\StartLinks */

$this->title = 'Update Start Links: ' . $model->start_link_id;
$this->params['breadcrumbs'][] = ['label' => 'Start Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->start_link_id, 'url' => ['view', 'id' => $model->start_link_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="start-links-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
