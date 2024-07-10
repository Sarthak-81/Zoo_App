<?php

/** @var yii\web\View $this */

$this->title = 'Add Animal';
?>
<div class="animal-add">

<?= $this->render('animalform', [
        'model' => $model,
    ]) ?>

</div>
