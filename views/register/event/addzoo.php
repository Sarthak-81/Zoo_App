<?php


/** @var yii\web\View $this */

$this->title = 'Add Zoo';

$this->registerCss('
 .zoo-add {
        background-image: url("https://unsplash.com/photos/a-flock-of-flamingos-are-standing-in-the-water-G0nufZ3LToE");
        background-size: cover;
        background-position: center;
        background-color: rgba(255, 255, 255, 0.5); 
        padding: 20px;
    }
');

?>
<div class="zoo-add">

    <?= $this->render('zooform', [
        'model' => $model,
    ]) ?>
</div>
