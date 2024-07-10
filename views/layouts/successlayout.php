<?php

/** @var yii\web\View $this */

use app\assets\AppAsset;
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
<body style="background-color: beige;">
<?php $this->beginBody() ?>

<header id="header">

<?php
$name = Yii::$app->session->get('name');
NavBar::begin([
  'brandLabel' => 'Home',
  'brandUrl' => ['register/user'],
  'options' => [
      'class' => 'navbar navbar-expand-lg navbar-dark bg-dark',
  ],
]);

$menuItems = [
  ['label'=> $name, 'url'=> ['register/profile']],
  ['label'=> 'Logout', 'url' => ['register/logout']],
];

echo Nav::widget([
  'options' => ['class' => 'navbar-nav'],
  'items' => $menuItems,
]);

NavBar::end();
?>

</header>

<main id="main">
    <div class="container">
        <?= $content ?>
    </div>
</main>

<footer style="margin-top: 18vh;">
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