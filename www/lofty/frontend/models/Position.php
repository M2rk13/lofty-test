<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "position".
 *
 * @property int $id
 * @property string $name
 * @property int $salary
 *
 * @property Employee[] $employees
 */
class Position extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'salary'], 'required'],
            [['salary'], 'double'],
            [['name'], 'string', 'max' => 255],
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
            'salary' => 'Salary',
        ];
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['position_id' => 'id']);
    }

    public static function getPositions()
    {
        $positions = self::find()
            ->orderBy(['name' => SORT_ASC])
            ->all();

        $result = [];

        foreach ($positions as $position) {
            $result[$position['id']] = $position['name'];
        }

        return $result;
    }
}
