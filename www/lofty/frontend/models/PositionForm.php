<?php

namespace frontend\models;

use yii\base\Model;
use app\models\Position;

/**
 * Signup form
 */
class PositionForm extends Model
{
    public $id;
    public $name;
    public $salary;

    public function attributeLabels(): array
    {
        return [
            'name' => 'Должность',
            'salary' => 'Зарплата'
        ];
    }

    public function rules(): array
    {
        return [

            [['name','salary'], 'safe'],
            [['name'], 'required', 'message' => 'Введите название должности'],
            [['salary'], 'required', 'message' => 'Введите заработную плату на должности'],

            ['name', 'string', 'max' => 255, 'tooLong' => 'Название должности не должно превышать 255 символов'],
            ['name', 'unique', 'targetClass' => Position::class, 'message' => 'Должность с таким названием уже существует', 'filter' => function ($query) {
                if (!$this->id !== null) {
                    $query->andWhere(['not', ['id'=>$this->id]]);
                }
            }],

            ['salary', 'double', 'message' => 'Заработная плата должна быть введена числом: 134.45'],
        ];
    }

    public function createRecord(): ?bool
    {
        if (!$this->validate()) {
            return null;
        }

        $position = new Position();
        $position->name = $this->name;
        $position->salary = $this->salary;

        return $position->save();
    }

    public function updateRecord(Position $position): ?bool
    {
        if (!$this->validate()) {
            return null;
        }

        $position->updateAttributes(['name' => $this->name, 'salary' => $this->salary]);

        return $position->save();
    }

}
