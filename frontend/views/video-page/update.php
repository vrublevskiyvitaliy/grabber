<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\VideoPage */

$this->title = 'Update Video Page: ' . $model->video_page_id;
$this->params['breadcrumbs'][] = ['label' => 'Video Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->video_page_id, 'url' => ['view', 'id' => $model->video_page_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="video-page-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
