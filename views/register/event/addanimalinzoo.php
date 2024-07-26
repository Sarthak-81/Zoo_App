<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Add Animal in ' . Html::encode($zoo['name']);

$form = ActiveForm::begin(); ?>

<div class="register-animalform">
    <h1 style="color:blue"><?= Html::encode($this->title) ?></h1>
    <br>

<?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'gender')-> dropDownList(
    [
        'male' =>'male',
        'female' => 'female',
    ], 
    ['prompt' => 'Select']
)?>

<?= $form->field($model, 'species')-> dropDownList(
    [
        'mammal' =>'mammal',
        'reptile' => 'reptile',
        'bird' => 'bird',
        'amphibian' => 'amphibian',
    ], 
    ['prompt' => 'Select']
)?>

<div class="form-group">
    <?= Html::submitButton('Save Animal', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
        
</div>

 
