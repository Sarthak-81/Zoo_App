<?php

use yii\helpers\Html;
/** @var yii\web\View $this */
use yii\widgets\ActiveForm;
use app\models\Zoo;

$this->title = 'Edit Zoo: ' . Html::encode($zoo->Name);
?>

<div class="zoo-edit">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($zoo, 'Name')->textInput() ?>

    <?= $form->field($zoo, 'Location')->textInput() ?>

    <?= $form->field($zoo, 'Phone_no')->textInput() ?>

    <?= $form->field($zoo, 'Description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
