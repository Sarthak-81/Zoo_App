<?php

use yii\helpers\Html;

/** @var yii\web\View $this */



$this->title = 'User';
$name = Yii::$app->session->get('name');
$email = Yii::$app->session->get('email');
$this->registerCss("
    .first a {
        color: #000000;
        text-decoration: none; 
        font-weight: bold;
        font-size: 25px;
    }
    .first a:hover {
        color: #0056b3;
        text-decoration: underline; 
    }
    .first p {
        font-size: 18px;
    }
    .display-5 {
    margin-top: -4  0px;
    }
");
?>
<div class="site-user">

    <h2 class="display-5" style="font-style:bold">
        Welcome, <?= $name ?>
    </h2>
    <br>
    <br>
    

    <div class="body-content">
        <div class="row">

            <div class="col-lg-3">
                <div class="first">
                    <a href="<?= Yii::$app->urlManager->createUrl(['register/viewzoo']) ?>">All Zoos</a>
                    <p>List of zoos that are available with details - Name, Location, Phone number and Description.</p>
                </div>
                <p><?= Html::a('Add Zoo', ['addzoo'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>

            <div class="col-lg-3">
                <div class="first">
                <a href="<?= Yii::$app->urlManager->createUrl(['register/viewanimal']) ?>">All Animals</a>
                <p>List of animals that are available a with details - Name, Zoo no, Gender, Species, Photo and Arrival Date.</p>
                </div>
                <p><?= Html::a('Add Animal', ['addanimal'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>

            <div class="col-lg-3">
                <div class="first">
                <a href="<?= Yii::$app->urlManager->createUrl(['register/viewhistory']) ?>">Transfer History</a>
                <p>All transfer records of animals from one zoo to another with valid reason for the transfer of animal to happen.</p>
                </div>
                <p><?= Html::a('Create Transfer', ['managehistory'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>

            <div class="col-lg-3">
                <div class="first">
                <a href="#">Archive</a>
                <p>All the archive records of zoos and animals that have occurred in the past with valid reason.</p>
                </div>
                <p><?= Html::a('Add Archive', ['archieve'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>

        </div </div>

    </div>