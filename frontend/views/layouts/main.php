<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\helpers\PathHelper;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Grabber',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Start Pages', 'url' => ['/start-links/index']],
        [
            'label' => 'Listings',
            'items' => [
                ['label' => 'Downloaded Videos', 'url' => Url::to(['video-page/index', 'page' => 'downloaded'])],
                ['label' => 'General', 'url' => Url::to(['video-page/index', 'page' => 'general'])],
                ['label' => 'Best', 'url' => Url::to(['video-page/index', 'page' => 'best'])],
                ['label' => 'Like', 'url' => Url::to(['video-page/index', 'page' => 'like'])],
                ['label' => 'To download', 'url' => Url::to(['video-page/index', 'page' => 'to-download'])],
                ['label' => 'Problem downloads', 'url' => Url::to(['video-page/index', 'page' => 'problem-downloads'])],
                ['label' => 'Downloading now', 'url' => Url::to(['video-page/index', 'page' => 'downloading'])],
                ['label' => 'All Video Pages', 'url' => ['/video-page/index']],
            ]
        ],
        ['label' => 'Rate it', 'url' => ['/video-page/rate-video']],
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">Used
            <?= number_format(PathHelper::getDirectorySizeInGb(Yii::$app->params['downloadFolder']) ,2) ?>
            Gb</p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
