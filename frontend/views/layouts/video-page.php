<?php

use yii\helpers\Html;

/**
 * @var $content string
 */

$this->beginContent('@app/views/layouts/main.php');?>
<div class="box-header">
    <h1 class="h4-1 inline"><?= Html::encode($this->title) ?></h1>
</div>

<div class="row">
    <div class="">
        <?php
        $sideMenuItems = [
            [
                'label' => 'Видео',
                'url' => ['video-page/view', 'id' => $this->params['video_page_id']],
            ],
            [
                'label' => 'Предпросмотр',
                'url' => ['video-page/index'],
            ],
        ];
        ?>
        <?=
        $this->render('//layouts/side-menu', [
            'menuItems' => $sideMenuItems,
            'menuClasses' => 'sub-side-menu mt-32'
        ]);
        ?>
    </div>

    <div class="content-container">
        <?= $content ?>
    </div>
</div>
<?php $this->endContent(); ?>