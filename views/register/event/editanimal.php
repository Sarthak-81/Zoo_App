
<?php

use yii\helpers\Html;
/** @var yii\web\View $this */
use yii\widgets\ActiveForm;

// $this->title = 'Edit Zoo: ' . Html::encode($zoo->Name);
$form = Activeform::begin();
?>

<div class="animal-edit">
    <h1>Edit Animal Details</h1>

    <?= $form->field($animal, 'Name')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
