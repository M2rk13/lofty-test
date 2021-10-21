<?php

use frontend\models\EmployeeForm;
use yii\db\Query;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $form ActiveForm */
/* @var $employee EmployeeForm */
/* @var $positions Query */

?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <h1>Введите должность и зарплату</h1>

    <div class="row">
        <div class="col-lg-5">
            <?php

            $form = ActiveForm::begin([
                'id' => 'form-signup',
                'errorCssClass' => 'has-error',
                'fieldConfig' => [
                    'errorOptions' => ['tag' => 'span', 'class' => 'registration__text-error']
                ]
            ]);

            echo $form->field($employee, 'name');
            echo $form->field($employee, 'birthday')->widget(DatePicker::className(),['dateFormat' => 'yyyy-MM-dd' ,'options'=>['class'=>'form-control']]);
            echo $form->field($employee, 'hiring_date')->widget(DatePicker::classname(), ['dateFormat' => 'yyyy-MM-dd' ,'options'=>['class'=>'form-control']]);
            echo $form->field($employee, 'position_id')->dropdownList($positions, ['prompt' => '']);

            echo Html::submitButton(empty($employee->id) ? 'Добавить' : 'Сохранить', ['class' => 'btn btn-primary']);

            $form = ActiveForm::end();

            ?>
        </div>
    </div>
</div>