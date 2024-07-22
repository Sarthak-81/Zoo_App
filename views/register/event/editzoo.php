
<?php

use yii\helpers\Html;
/** @var yii\web\View $this */
use yii\widgets\ActiveForm;

// $this->title = 'Edit Zoo: ' . Html::encode($zoo->Name);
$form = Activeform::begin();
?>

<div class="zoo-edit">


    <h1>Edit Zoo Details</h1>

    <?= $form->field($model, 'Phone_no')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'Description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
