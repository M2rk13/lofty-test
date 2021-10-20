<?php

use frontend\models\EmployeeForm;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $form ActiveForm */
/* @var $employee EmployeeForm */

?>


<div>
    <h1>Должность <?= $employee->name ?></h1>
    <br>
    <div class="wrapper wrapper-view">
        <div>ФИО</div>
        <div><?= $employee->name ?></div>
        <div>Возраст</div>
        <div><?= date_diff(new DateTime(), new DateTime($employee->birthday))->y ?></div>
        <div>Дата найма</div>
        <div><?= date('d.M.y', strtotime($employee->hiring_date)) ?></div>
        <div>Должность</div>
        <div><?= $employee->position->name ?></div>
        <div>
            <a href="<?= Url::to(['employee/edit', 'id' => $employee->id]) ?>">
                <button>Редактировать ✎</button>
            </a>
        </div>
        <div>
            <a href="<?= Url::to(['employee/delete', 'id' => $employee->id]) ?>">
                <button>Удалить ❌</button>
            </a>
        </div>
    </div>
</div>