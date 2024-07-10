<?php 

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Contact Us';
?>
<div class="site-contact">
    <h1 style="color: red"><?= Html::encode($this->title) ?></h1>

        <p>
            Feel free to contact us. We love to hear it from you. 
        </p>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'subject') ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
</div>
