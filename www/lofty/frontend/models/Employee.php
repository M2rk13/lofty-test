<?php

namespace app\models;

use frontend\models\EmployeeFilter;
use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $name
 * @property string $birthday
 * @property string $hiring_date
 * @property int $position_id
 *
 * @property Position $position
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * Get Employees with (optional)filtration and (optional)sort
     *
     * @param EmployeeFilter $filters
     * @param null $sortDirection
     * @return \yii\db\ActiveQuery
     */
    public static function getEmployees(EmployeeFilter $filters, $sortDirection = null): \yii\db\ActiveQuery
    {
        $employees = self::find()
            ->andFilterWhere(['like', 'name', $filters->search])
            ->andFilterWhere(['position_id' => $filters->positions]);

        if  ($sortDirection) {
            $employees->orderBy($sortDirection);
        }

        return $employees;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'birthday', 'hiring_date', 'position_id'], 'required'],
            [['birthday', 'hiring_date'], 'safe'],
            [['position_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Position::className(), 'targetAttribute' => ['position_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'birthday' => 'Birthday',
            'hiring_date' => 'Hiring Date',
            'position_id' => 'Position ID',
        ];
    }

    /**
     * Gets query for [[Position]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Position::className(), ['id' => 'position_id']);
    }
}
