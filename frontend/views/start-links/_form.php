<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\StartLinks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="start-links-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tittle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'site_id')->textInput() ?>

    <?= $form->field($model, 'search_depth')->textInput() ?>

    <?= $form->field($model, 'is_active')->dropDownList([ 'no' => 'No', 'yes' => 'Yes', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
