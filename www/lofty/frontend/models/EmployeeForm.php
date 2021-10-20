<?php

namespace frontend\models;

use app\models\Employee;
use yii\base\Model;
use app\models\Position;

/**
 * Signup form
 */
class EmployeeForm extends Model
{
    public $id;
    public $name;
    public $birthday;
    public $hiring_date;
    public $position_id;

    public function attributeLabels(): array
    {
        return [
            'name' => 'ФИО',
            'birthday' => 'Дата рождения',
            'hiring_date' => 'Дата найма',
            'position_id' => 'Должность',
        ];
    }

    public function rules(): array
    {
        return [

            [['name', 'salary'], 'safe'],
            [['name'], 'required', 'message' => 'Введите ФИО сотрудника'],
            [['birthday'], 'required', 'message' => 'Укажите дату рождения'],
            [['hiring_date'], 'required', 'message' => 'Укажите дату найма'],
            [['position_id'], 'required', 'message' => 'Выберите должность'],

            ['name', 'string', 'max' => 255, 'tooLong' => 'ФИО не должно превышать 255 символов'],
        ];
    }

    public function createRecord(): ?bool
    {
        if (!$this->validate()) {
            return null;
        }

        $employee = new Employee();

        $employee->setAttributes(
            [
                'name' => $this->name,
                'birthday' => $this->birthday,
                'hiring_date' => $this->hiring_date,
                'position_id' => $this->position_id,
            ]
        );

        return $employee->save();
    }


    public function updateRecord(Employee $employee): ?bool
    {
        if (!$this->validate()) {
            return null;
        }

        $employee->updateAttributes(
            [
                'name' => $this->name,
                'birthday' => $this->birthday,
                'hiring_date' => $this->hiring_date,
                'position_id' => $this->position_id,
            ]
        );

        return $employee->save();
    }

}
