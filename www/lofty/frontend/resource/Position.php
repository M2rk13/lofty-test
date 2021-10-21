<?php

namespace frontend\resource;

use app\models\Position as BasePosition;

class Position extends BasePosition
{
    public function fields()
    {
        return [
            'id' => 'id',
            'name' => 'name',
            'salary' => 'salary',
        ];
    }
}