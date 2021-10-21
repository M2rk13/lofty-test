<?php
namespace frontend\models;

use yii\base\Model;

class EmployeeFilter extends Model
{
    public $positions;
    public $search;

    public function attributeLabels(): array
    {
        return [
            'positions' => 'Должность',
            'search' => 'Поиск',
        ];
    }

    public function rules(): array
    {
        return [
            [['positions', 'search'], 'safe'],
        ];
    }
}
