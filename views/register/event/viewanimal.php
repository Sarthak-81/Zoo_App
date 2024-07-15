<?php

use yii\helpers\Html;

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'All Animals';
?>

<div class="register-view-zoo">
    <h1 style="color: brown"><?= Html::encode($this->title) ?></h1>
    <br>
    <div class="row">
        <?php foreach ($animals as $animal) : ?>
            <div class="card" style="width: 18rem;">
                <?php if (!empty($animal['photos'])) : ?>
                    <?php $photoUrl = Url::to('@web/uploads/animal/' . $animal['photos'][0]['photo_url']); ?>
                    <img src="<?= $photoUrl ?>" class="card-img-top" alt="Animal Photo">
                <?php else : ?>
                    <img src="<?= Url::to('@web/uploads/animal/elephant.jpg') ?>" class="card-img-top" alt="Default Photo">
                <?php endif; ?>
                <div class="card-body">
                    <h5 style="font-weight: bolder;" class="card-title"><?= Html::encode($animal['name']) ?></h5>
                    <p class="card-text">Gender: <?= Html::encode($animal['gender']) ?></p>
                    <p class="card-text">Species: <?= Html::encode($animal['species']) ?></p>
                    <p class="card-text">Arrival Date: <?= Html::encode($animal['arrival_date']) ?></p>
                    <p class="card-text">Zoo no: <?= Html::encode($animal['zoo_id']) ?></p>
                    <?= Html::a('Edit', ['editanimal', 'id' => $animal['id']], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('View Photos', ['#'], ['class' => 'btn btn-info']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

                <?= $imageUrl = Url::to('@web/uploads/animal/Tiger.jpg'); ?>
                <img src="<?= $imageUrl ?>" class="card-img-top" alt="img">

<!-- I want while viewanimal.php is rendering via actionViewanimal, photo associated with different animals should also render -->

