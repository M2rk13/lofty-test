<?php

namespace frontend\resource;

use app\models\Employee as BaseEmployee;

class Employee extends BaseEmployee
{
    public function fields()
    {
        return [
            'id' => 'id',
            'name' => 'name',
            'birthday' => 'birthday',
            'hiring_date' => 'hiring_date',
            'position' => 'position'
        ];
    }

    public function extraFields()
    {
    }
}