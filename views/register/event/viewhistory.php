<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
/** @var yii\web\View $this */

$this->title = 'Transfer History';
?>

<div class="register-history">
    <h1>Transfer History of Animals</h1>
    <br>
    <div class="table">
        <table class="table table table-striped">
            <thead>
                <tr>
                    
                    <th scope="col">Sr No</th>
                    <th scope="col">Name</th>
                    <!-- <th scope="col">Animal ID</th> -->
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Transfer Date</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($transferHistories as $index => $history) : ?>
                    <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= Html::encode($history['name']) ?></td>
                        <td><?= Html::encode($history['from_zoo_id']) ?></td>
                        <td><?= Html::encode($history['to_zoo_id']) ?></td>
                        <td><?= Html::encode($history['reason']) ?></td>
                        <td><?= Html::encode($history['Transfer_Date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
 

<!-- Html::encode($history['animal_id']) 
