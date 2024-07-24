<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\History;

$this->title = 'Transfer Animal';

$form = ActiveForm::begin(); ?>

<div class="event-transfer-form">
    <h1 style="color:blue"><?= Html::encode($this->title) ?></h1>

<?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

<?php
    $zoos = History::getAllZoos();
    $zooList = ArrayHelper::map($zoos, 'name', 'name'); // both key and value are name
    ?>

    <?= $form->field($model, 'from_zoo_id')->dropDownList(
        $zooList,
        ['prompt' => 'Select Zoo']
    ) ?>

    <?php
    $zoos = History::getAllZoos();
    $zooList = ArrayHelper::map($zoos, 'id', 'name');
    ?>

    <?= $form->field($model, 'to_zoo_id')->dropDownList(
        $zooList,
        ['prompt' => 'Select Zoo']
    ) ?>

<?= $form->field($model, 'reason')->textInput() ?>

<?= $form->field($model, 'transfer_date')->textInput() ?>

<div class="form-group">
    <?= Html::submitButton('Confirm Transfer', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
        
</div>
<!-- I want when users enters name of animal, spring should check if animal exists in animal table, if it exists then save name in db and save animal_id from the name of animal entered by user -->
<!-- From shows list of zoos, it should save zooid in from_zoo_id field by name of the zoo same with To -->
<!-- Also when animal gets transfered from one zoo to another the zoo_id field in animal table should gets updated -->