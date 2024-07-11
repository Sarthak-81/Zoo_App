<?php

/** @var yii\web\View $this */

$this->title = 'Archive Zoo or Animal';
?>
<div class="event-archive">

<?= $this->render('archiveform', [
        'model' => $model,
    ]) ?>

</div>
