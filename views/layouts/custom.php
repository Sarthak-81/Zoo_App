<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100" style="background-color:aquamarine;" >
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => 'Zoo Website',
        'brandUrl' => ['/'],
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['register/index']],
            ['label' => 'About', 'url' => ['register/about']],
            ['label' => 'Signup', 'url' => ['register/signup']],
            ['label' => 'Login', 'url' => ['register/login']],
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
<footer style="margin-top: 18vh">
    <div class="container">
        <div class="row">
            <hr>
                <h4>Contact Information</h4>
                <p><strong>Address:</strong> I-thum tower, Noida, India</p>
                <p><strong>Email:</strong> info@zoo.com</p>
                <p><strong>Phone:</strong> +123 456 7890</p>
            </div>
        </div>
        <hr>
        <p class="text-center">&copy; <?= date('Y') ?> My Zoo Website. All rights reserved.</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
