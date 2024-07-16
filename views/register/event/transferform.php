<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Transfer Animal';

$form = ActiveForm::begin(); ?>

<div class="event-transfer-form">
    <h1 style="color:blue"><?= Html::encode($this->title) ?></h1>

<?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'animal_id')->textInput() ?>

<?= $form->field($model, 'from_zoo_id')->textInput() ?>

<?= $form->field($model, 'to_zoo_id')->textInput() ?>

<?= $form->field($model, 'reason')->textInput() ?>

<?= $form->field($model, 'Transfer_Date')->textInput() ?>

<div class="form-group">
    <?= Html::submitButton('Confirm Transfer', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
        
</div>