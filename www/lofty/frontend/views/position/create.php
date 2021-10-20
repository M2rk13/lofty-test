<?php

use frontend\models\PositionForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $form ActiveForm */
/* @var $position PositionForm */

?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <h1>Введите должность и зарплату</h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($position, 'name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($position, 'salary') ?>

            <div class="form-group">
                <?= Html::submitButton(empty($position->id) ? 'Добавить' : 'Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>