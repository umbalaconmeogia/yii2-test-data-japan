<?php

use yii\db\Migration;

/**
 * Handles the creation of table `employee`.
 */
class m180216_122736_create_employee_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('employee', [
            'id' => $this->primaryKey(),
            'company_id' => 'INTEGER REFERENCES company(id)',
            'name' => $this->string(),
            'postal_code' => $this->string(),
            'address' => $this->string(),
            'tel' => $this->string(),
            'fax' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('employee');
    }
}
