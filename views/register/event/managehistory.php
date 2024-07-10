<?php

/** @var yii\web\View $this */

$this->title = 'Transfer Animal from one zoo to another';
?>
<div class="event-history">

<?= $this->render('transferform', [
        'model' => $model,
    ]) ?>

</div>
