<?php
use yii\helpers\Html;

/**  @var yii\web\View $this */

$this->title = 'Zoo App';
?>

<div class="register-index">
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-3">Welcome to Zoo Dashboard!</h1>
        <br>
        <p class="display-6">Discover the wonders of wildlife</p>
        <br>
        <p><?= Html::a('Get Started', ['register/category'], ['class' => 'btn btn-lg btn-primary']) ?></p>
    </div>
    <br>
    <br>

    <div class="body-content">
        <div class="row">

            <div class="col-lg-6" style="border: 1px solid aliceblue;">
                <h2>Our Categories</h2>
                <p>Meet the diverse species we have at our zoo. From majestic lions to colorful parrots, explore the animal kingdom.
                    Read about different types of species present in all Zoos.  
                </p>
                <br>
                <p><?= Html::a('View Species', ['register/category'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>

            <div class="col-lg-6" style="border: 1px solid aliceblue;">
                <h2>Come Visit Us</h2>
                <p>Plan your visit. Get information on tickets, opening hours, and directions. We are open to feedbacks. Feel free to contact us.
                    We would like to hear it from you.
                </p>
                <br>
                <p><?= Html::a('Plan Your Visit', ['register/contact'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>

        </div
    </div>
</div>