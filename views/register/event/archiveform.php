<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Archive Entity';

$form = ActiveForm::begin(); ?>

<div class="event-transfer-form">
    <h1 style="color:blue"><?= Html::encode($this->title) ?></h1>

    <br>

<?= $form->field($model, 'Entity_Type')->dropDownList(
    [
        'Zoo' =>'Zoo',
        'Animal' => 'Animal',
    ], 
    ['prompt' => 'Select']
) ?>

<?= $form->field($model, 'Name')->textInput() ?>

<?= $form->field($model, 'Reason')->textInput() ?>


<div class="form-group">
    <?= Html::submitButton('Confirm Archive', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
        
</div>