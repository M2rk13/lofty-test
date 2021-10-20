<?php

use yii\db\Migration;

/**
 * Class m211020_070838_add_tables
 */
class m211020_070838_add_tables extends Migration
{
    public const TABLE_NAME_EMPLOYEES = 'employee';
    public const TABLE_NAME_POSITIONS = 'position';
    public const FK_NAME_EMPLOYEES_POSITIONS = 'fk-employees-positions';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME_EMPLOYEES, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'birthday' => $this->date()->notNull(),
            'hiring_date' => $this->date()->notNull(),
            'position_id' => $this->integer()->notNull(),
        ]);

        $this->createTable(self::TABLE_NAME_POSITIONS, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'salary' => $this->double()->notNull(),
        ]);

        $this->addForeignKey(
            self::FK_NAME_EMPLOYEES_POSITIONS,
            self::TABLE_NAME_EMPLOYEES,
            'position_id',
            self::TABLE_NAME_POSITIONS,
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(self::FK_NAME_EMPLOYEES_POSITIONS, self::TABLE_NAME_EMPLOYEES);
        $this->dropTable(self::TABLE_NAME_EMPLOYEES);
        $this->dropTable(self::TABLE_NAME_POSITIONS);
    }
}
