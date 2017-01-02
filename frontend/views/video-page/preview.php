<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\VideoPage */

$this->title = $model->video_page_id;
$this->params['breadcrumbs'][] = ['label' => 'Video Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['video_page_id'] = $model->video_page_id;
?>
<?= $this->render('/gallery/preview-gallery', ['model' => $model]) ?>