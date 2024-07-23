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
        font-style: italic;
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
        Welcome, User
    </h2>
    <br>
    <br>
    

    <div class="body-content">
        <div class="row">

            <div class="col-lg-3">
                <div class="first">
                    <a href="<?= Yii::$app->urlManager->createUrl(['register/viewzoo']) ?>">All Zoos</a>
                    <p>List of Zoos that are available with details - Name, Location, Phone number and Description.</p>
                </div>
                <p><?= Html::a('Add Zoo', ['addzoo'], ['class' => 'btn btn-outline-primary']) ?></p>
            </div>

            <div class="col-lg-3">
                <div class="first">
                <a href="<?= Yii::$app->urlManager->createUrl(['register/viewanimal']) ?>">All Animals</a>
                <p>List of Animals that are available with details - Name, Gender, Species, Photo, Zoo name.</p>
                </div>
                <p><?= Html::a('Add Animal', ['addanimal'], ['class' => 'btn btn-outline-primary']) ?></p>
            </div>

            <div class="col-lg-3">
                <div class="first">
                <a href="<?= Yii::$app->urlManager->createUrl(['register/viewhistory']) ?>">Transfer History</a>
                <p>All transfer records of Animal from one Zoo to another with valid reason for the transfer to happen.</p>
                </div>
                <p><?= Html::a('Add Transfer', ['managehistory'], ['class' => 'btn btn-outline-primary']) ?></p>
            </div>

            <div class="col-lg-3">
                <div class="first">
                <a href="<?= Yii::$app->urlManager->createUrl(['register/viewarchive']) ?>">Archive</a>
                <p>All the archive records of Zoos and Animals that have occurred in the past with valid reason.</p>
                </div>
                <p><?= Html::a('Add Archive', ['archive'], ['class' => 'btn btn-outline-primary']) ?></p>
            </div>

        </div </div>

    </div>