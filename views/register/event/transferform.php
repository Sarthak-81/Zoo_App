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
    $zooList = ArrayHelper::map($zoos, 'id', 'name');
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

<?= $form->field($model, 'Transfer_Date')->textInput() ?>

<div class="form-group">
    <?= Html::submitButton('Confirm Transfer', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
        
</div>