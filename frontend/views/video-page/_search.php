<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\VideoPageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-page-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'video_page_id') ?>

    <?= $form->field($model, 'start_link_id') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'image_url') ?>

    <?= $form->field($model, 'tittle') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
