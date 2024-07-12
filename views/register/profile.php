<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Profile';
$name = Yii::$app->session->get('name');
?>
<div class="register-profile">

    <h1 style="font-style:italic" >    
        User Details
    </h1>
    <hr>

    <div class="user-details">
    <h5>Name : <?= $name ?> </h5>
    </div>

</div>

