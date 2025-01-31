<?php

use yii\helpers\Html;

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'All Zoos';

?>

<div class="register-view-zoo">
    <h1 style="color: brown"><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <?php foreach ($zoos as $zoo) : ?>
            <div class="card" style="width: 18rem;"> 
                <?php $photoUrl = Url::to('@web/uploads/zoo/Delhizoo.jpg'); ?>
                <img src="<?= $photoUrl ?>" class="card-img-top" alt="Zoo Photo">
                <div class="card-body">
                    <h5 style="font-weight: bolder;" class="card-title"><?= Html::encode($zoo['name']) ?></h5>
                    <p class="card-text">Location: <?= Html::encode($zoo['location']) ?></p>
                    <p class="card-text">Phone: <?= Html::encode($zoo['phone_no']) ?></p>
                    <p class="card-text">Description: <?= Html::encode($zoo['description']) ?></p>
                    <?= Html::a('Edit', ['editzoo', 'id' => $zoo['id']], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Add Animal', ['addinzoo', 'id' => $zoo['id']], ['class' => 'btn btn-info']) ?>
                    <?= Html::a('Archive', ['archivezoo', 'id' => $zoo['id']], ['class' => 'btn btn-danger']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>