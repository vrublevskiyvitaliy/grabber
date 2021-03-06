<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\helpers\PathHelper;
use frontend\helpers\SiteHelper;

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
        ['label' => 'Actors', 'url' => ['/actor/index']],
        ['label' => 'Start Pages', 'url' => ['/start-links/index']],
        [
            'label' => 'Listings',
            'items' => SiteHelper::getMenuForNavBar(),
        ],
        [
            'label' => 'Random',
            'items' => [
                [
                    'label' => 'Rate it',
                    'url' => ['/video-page/rate-video']
                ],
                [
                    'label' => 'Watch random',
                    'url' => ['/video-page/watch-random']
                ],
                [
                    'label' => 'Download random',
                    'url' => ['/video-page/download-random']
                ],

            ],
        ]
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
