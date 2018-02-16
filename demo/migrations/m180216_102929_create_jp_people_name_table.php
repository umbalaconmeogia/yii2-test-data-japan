<?php

use yii\db\Migration;

/**
 * Handles the creation of table `jp_people_name`.
 */
class m180216_102929_create_jp_people_name_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('jp_people_name', [
            'id' => $this->primaryKey(),
            'kanji' => $this->string(),
            'kana' => $this->string(),
            'type' => $this->smallInteger(),
        ]);
        $this->createIndex('jp_people_name-kanji-kana-type-idx', 'jp_people_name', ['kanji', 'kana', 'type']);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('jp_people_name');
    }
}
