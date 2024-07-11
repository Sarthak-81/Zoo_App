<?php

use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = 'All Zoos';
?>

<div class="register-view-zoo">
    <h1 style="color: brown"><?= Html::encode($this->title) ?></h1>

    <div class="row">
    <?php foreach ($zoos as $zoo): ?>
    <!-- <div class="col-lg-3"> -->
        <div class="card" style="width: 18rem;">
            <img src="<?= Yii::$app->urlManager->baseUrl ?> + "/Photos/Tiger.jpg" class="card-img-top" alt="Image">
            <div class="card-body">
                <h5 style="font-weight: bolder;" class="card-title"><?= Html::encode($zoo['Name']) ?></h5>
                <p class="card-text">Location: <?= Html::encode($zoo['Location']) ?></p>
                <p class="card-text">Phone: <?= Html::encode($zoo['Phone_no']) ?></p>
                <p class="card-text">Description: <?= Html::encode($zoo['Description']) ?></p>
                <?= Html::a('Edit', ['editzoo', 'id' => $zoo['id']], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Photo', ['#', 'id' => $zoo['id']], ['class' => 'btn btn-info']) ?> 
            </div>
        <!-- </div> -->
    </div>
<?php endforeach; ?>
    </div>
</div>

 

