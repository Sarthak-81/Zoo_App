<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var string $imageUrl */

$this->title = 'Photo';
?>

<div class="photo-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <div>
        <img src="<?= Html::encode($imageUrl) ?>" alt="Delhizoo" class="img-fluid">
        <img src="<?= Html::encode($image) ?>" alt="Tiger" class="img-fluid">
    </div>
</div>
  

