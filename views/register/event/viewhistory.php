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
                    <th scope="col">Animal ID</th>
                    <th scope="col">From Zoo ID</th>
                    <th scope="col">To Zoo ID</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Date of Transfer</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($transferHistories as $index => $history) : ?>
                    <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= Html::encode($history['Animal']) ?></td>
                        <td><?= Html::encode($history['animal_id']) ?></td>
                        <td><?= Html::encode($history['From_zoo_id']) ?></td>
                        <td><?= Html::encode($history['To_zoo_id']) ?></td>
                        <td><?= Html::encode($history['Reason']) ?></td>
                        <td><?= Html::encode($history['Transfer_Date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>