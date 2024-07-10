<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Add Zoo';

$form = ActiveForm::begin(); ?>

<div class="register-zooform">
    <h1 style="color:blue"><?= Html::encode($this->title) ?></h1>

<?= $form->field($model, 'Name')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'Location')->textInput() ?>

<?= $form->field($model, 'Phone_no')->textInput() ?>

<?= $form->field($model, 'Description')->textarea(['rows' => 3]) ?>

<div class="form-group">
    <?= Html::submitButton('Save Zoo', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
        
</div>