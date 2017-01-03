<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $actor frontend\models\Actor */
/* @var $form yii\widgets\ActiveForm */
$this->params['video_page_id'] = $model->video_page_id;

?>

<div >
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($actor, 'actor_name')
        ->textInput([
            'maxlength' => true,
            'class' => 'text-input maximized'
        ])
    ?>

    <div class="form-group">
        <?= Html::submitButton(
            'Add',
            ['class' => 'btn btn-primary btn-orange']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?php $this->registerJsFile('js/video-page/add-actor.js',
    [
        'depends' => [
            \yii\web\JqueryAsset::className(),
        ],
    ]
); ?>