<?php

use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = 'Transfer History';
?>

<div class="register-archive">
    <h1>Archived Records</h1>
    <br>
    <div class="table">
        <table class="table table table-striped">
            <thead>
                <tr>
                    <th scope="col">Sr No</th>
                    <th scope="col">Entity Type</th>
                    <th scope="col">Name</th>
                    <th scope="col">Entity ID</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Date of Archive</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($archive as $index => $archives) : ?>
                    <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= Html::encode($archives['entity_type']) ?></td>
                        <td><?= Html::encode($archives['name']) ?></td>
                        <td><?= Html::encode($archives['entity_id']) ?></td>
                        <td><?= Html::encode($archives['reason']) ?></td>
                        <td><?= Html::encode($archives['Archive_Date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>