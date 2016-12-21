<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\VideoPage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'start_link_id')->textInput() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tittle')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
