<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\helpers\VideoHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\VideoPage */

$this->title = $model->video_page_id;
$this->params['breadcrumbs'][] = ['label' => 'Video Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="video-page-view">

    <?= $this->render('detail-view', ['model' => $model]) ?>
    <?= Html::a('Next', ['watch-random'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Open', ['open', 'id' => $model->video_page_id, 'action' => 'watch-random'], ['class' => 'btn btn-primary']) ?>

</div>
