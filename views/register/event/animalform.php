<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Add Animal';

$form = ActiveForm::begin(); ?>

<div class="register-animalform">
    <h1 style="color:blue"><?= Html::encode($this->title) ?></h1>

<?= $form->field($model, 'Name')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'zoo_id')->textInput() ?>

<?= $form->field($model, 'Gender')->dropDownList(
    [
        'Male' =>'Male',
        'Female' => 'Female',
    ], 
    ['prompt' => 'Select']
)?>

<?= $form->field($model, 'Species')->dropDownList(
    [
        'Mammal' =>'Mammal',
        'Reptile' => 'Reptile',
        'Bird' => 'Bird',
        'Amphibian' => 'Amphibian',
    ], 
    ['prompt' => 'Select']
)?>

<?= $form->field($model, 'Arrival_Date')->textarea() ?>

<div class="form-group">
    <?= Html::submitButton('Save Animal', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
        
</div>