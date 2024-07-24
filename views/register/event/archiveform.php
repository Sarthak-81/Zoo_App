 <!-- $zoos = Archive::getAllZoos();
 $zooList = ArrayHelper::map($zoos, 'id', 'name');

 $animals = Archive::getAllAnimals(); 
 $animalList = ArrayHelper::map($animals, 'id', 'name'); -->

<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Archive';

$form = ActiveForm::begin(); ?>

<div class="event-transfer-form">
    <h1 style="color:blue"><?= Html::encode($this->title) ?></h1>
    <p style="color: yellowgreen"> <b>NOTE</b> - Creating an archive will permanently delete an entity.</p>
    <br>

<?= $form->field($model, 'entity_type')->dropDownList(
    [
        'Zoo' =>'Zoo',
        'Animal' => 'Animal',
    ], 
    ['prompt' => 'Select']
) ?>

<!-- want to add a dropdown menu based on entity type -->
<?= $form->field($model, 'name')->textInput()?>

<?= $form->field($model, 'reason')->textInput() ?>

<div class="form-group">
    <?= Html::submitButton('Confirm Archive', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
        
</div>




