<?php

use app\models\Employee;
use app\models\Position;
use yii\db\Migration;
use Faker\Factory;

/**
 * Class m211021_085636_fill_with_fake_data
 */
class m211021_085636_fill_with_fake_data extends Migration
{
    const MIN_SALARY = 10000;
    const MAX_SALARY = 150000;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = Factory::create();

        $positions = [];
        $employees = [];

        $i = 0;

        while ($i < 10) {
            $positions[] = [$faker->company(), random_int(self::MIN_SALARY, self::MAX_SALARY)];
            $i++;
        }

        Yii::$app->db
            ->createCommand()
            ->batchInsert('position', ['name', 'salary'], $positions)
            ->execute();

        $i = 0;

        while ($i < 50) {
            $employees[] = [
                $faker->name(),
                $faker->date('Y-m-d', '2000-01-01'),
                $faker->date('Y-m-d'),
                random_int(1, 10),
            ];

            $i++;
        }

        Yii::$app->db
            ->createCommand()
            ->batchInsert('employee', ['name', 'birthday', 'hiring_date', 'position_id'], $employees)
            ->execute();

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db
            ->createCommand()
            ->delete('employee')
            ->execute();

        Yii::$app->db
            ->createCommand()
            ->delete('positions')
            ->execute();
    }
}
