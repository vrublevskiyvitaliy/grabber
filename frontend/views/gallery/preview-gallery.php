<?php

use yii\helpers\Url;

/**
 * @var $model \frontend\models\VideoPage
 */

$url = Url::to(['site/gallery-image', 'id' => $model->video_page_id]);

?>
    <div>
        <?php if ($model->preview_status == 'created'): ?>
            <div class="video-preview" data-frames="50" data-source="<?= $url ?>"></div>
        <?php else: ?>
            <p>Скоро з'явиться!</p>
        <?php endif; ?>
    </div>
<?php $this->registerJsFile('js/video-page/video-preview.js',
    [
        'depends' => [
            \yii\web\JqueryAsset::className(),
        ],
    ]
); ?>