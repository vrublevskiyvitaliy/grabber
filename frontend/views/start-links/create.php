<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\StartLinks */

$this->title = 'Create Start Links';
$this->params['breadcrumbs'][] = ['label' => 'Start Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="start-links-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
