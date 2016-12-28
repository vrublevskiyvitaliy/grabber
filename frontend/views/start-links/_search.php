<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\StartLinksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="start-links-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'start_link_id') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'tittle') ?>

    <?= $form->field($model, 'site_id') ?>

    <?= $form->field($model, 'search_depth') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
