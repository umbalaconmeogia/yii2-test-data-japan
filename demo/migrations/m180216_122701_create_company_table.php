<?php

use yii\db\Migration;

/**
 * Handles the creation of table `company`.
 */
class m180216_122701_create_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('company', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'postal_code' => $this->string(),
            'prefecture' => $this->string(),
            'city' => $this->string(),
            'town' => $this->string(),
            'tel' => $this->string(),
            'fax' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('company');
    }
}
