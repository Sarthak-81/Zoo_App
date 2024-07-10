<?php

use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = 'All Animals';
?>

<div class="register-view-zoo">
    <h1 style="color: brown"><?= Html::encode($this->title) ?></h1>

    <div class="row">
    <?php foreach ($animals as $animal): ?>
    <!-- <div class="col-lg-3"> -->
        <div class="card" style="width: 18rem;">
            <img src="" class="card-img-top" alt="Image">
            <div class="card-body">
                <h5 style="font-weight: bolder;" class="card-title"><?= Html::encode($animal['Name']) ?></h5>
                <p class="card-text">Gender: <?= Html::encode($animal['Gender']) ?></p>
                <p class="card-text">Species: <?= Html::encode($animal['Species']) ?></p>
                <p class="card-text">Arrival Date: <?= Html::encode($animal['Arrival_Date']) ?></p>
                <p class="card-text">Zoo no: <?= Html::encode($animal['zoo_id']) ?></p>
                <?= Html::a('Edit', ['editanimal'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Photo', ['zoo/edit'], ['class' => 'btn btn-info']) ?>
            </div>
        <!-- </div> -->
    </div>
<?php endforeach; ?>

    </div>
</div>
