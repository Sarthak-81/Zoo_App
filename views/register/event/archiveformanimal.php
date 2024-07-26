 <?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Archive Animal';

$form = ActiveForm::begin(); ?>

<div class="event-transfer-form">
    <h1 style="color:blue"><?= Html::encode($this->title) ?></h1>
    <p style="color: red"> <b style="color: yellowgreen">Warning:</b> Creating an archive will permanently delete this Animal.</p>
    <br>

<?= $form->field($model, 'entity_type')->textInput(['value' => "Animal", 'readOnly' => true]) ?>

<?= $form->field($model, 'name')->textInput(['readOnly' => true])?>

<?= $form->field($model, 'reason')->textInput(['autofocus' => true]) ?>

<div class="form-group">
    <?= Html::submitButton('Confirm Archive', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
        
</div>
