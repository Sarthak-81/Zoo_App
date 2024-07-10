<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Profile';
$name = Yii::$app->session->get('name');
$email = Yii::$app->session->get('email');
?>
<div class="register-profile">
    <h1 style="color: red"><?= Html::encode($this->title) ?></h1>

    <h4 style="font-style:italic" >    
        User Details
    </h4>

    <div class="user-details">
    <h5>Name : <?= $name ?> </h5>
    <h5>Email : <?= $email ?> </h5>
    </div>

</div>

