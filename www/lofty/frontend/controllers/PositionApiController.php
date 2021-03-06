<?php

namespace frontend\controllers;

use frontend\resource\Position;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class PositionApiController extends ActiveController
{
    public $modelClass = Position::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class,
        ];

        return $behaviors;
    }
}