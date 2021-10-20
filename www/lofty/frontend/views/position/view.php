<?php

use frontend\models\PositionForm;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $form ActiveForm */
/* @var $position PositionForm */

?>


<div>
    <h1>Должность <?= $position->name ?></h1>
    <br>
    <div class="wrapper wrapper-view">
        <div>Название должности</div>
        <div><?= $position->name ?></div>
        <div>Заработная плата</div>
        <div><?= round($position->salary, 2) ?></div>
        <div>
            <a href="<?= Url::to(['position/edit', 'id' => $position->id]) ?>">
                <button>Редактировать ✎</button>
            </a>
        </div>
        <div>
            <a href="<?= Url::to(['position/delete', 'id' => $position->id]) ?>">
                <button>Удалить ❌</button>
            </a>
        </div>
    </div>


</div>