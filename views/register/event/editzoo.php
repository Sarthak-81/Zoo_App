
<?php

use yii\helpers\Html;
/** @var yii\web\View $this */
use yii\widgets\ActiveForm;

$form = Activeform::begin();
?>

<div class="zoo-edit">


    <h1>Edit Zoo Details</h1>

    <?= $form->field($model, 'name')->textInput(['readOnly' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['readOnly' => true]) ?>

    <?= $form->field($model, 'phone_no')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
