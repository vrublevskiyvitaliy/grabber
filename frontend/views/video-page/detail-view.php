<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\helpers\VideoHelper;

/**
 * @var $model \frontend\models\VideoPage
 */

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'attribute' => 'startLink.tittle',
            'label' => 'Тема'
        ],
        [
            'attribute' => 'tittle',
            'label' => 'Назва'
        ],
        [
            'attribute' => 'image_url',
            'label' => 'Preview',
            'value' => $this->render('/gallery/preview-gallery', ['model' => $model]),
            'format' => 'raw',
            'contentOptions' => ['style' => ['height' => '400px', 'white-space' =>'pre-wrap']]
        ],
        [
            'attribute' => 'url',
            'value' => Html::a('Watch', VideoHelper::getDownloadUrl($model)),
            'format' => 'raw'
        ]
    ],
]) ?>
