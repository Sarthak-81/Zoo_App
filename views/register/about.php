<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
?>
<div class="site-about">
    <h1 style="color: red"><?= Html::encode($this->title) ?></h1>

    <h4 style="font-style:italic">
        This is the About page.
    </h4>

    <p>A user can add Zoo and Animals.
        Zoo have attributes like name, location, phone no, photos, etc.
        Animal can have attributes like name, photos, species, gender, etc.
        User can edit Animal info and Zoo info.
        User can transfer animal from one zoo to another.
        User can manage transfer history of animals.
        One single zoo or animal can have multiple photos.
        User can archeive animal or zoo. 
    </p>
</div>