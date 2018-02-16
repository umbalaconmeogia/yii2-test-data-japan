<?php

use yii\db\Migration;

/**
 * Handles the creation of table `jp_address`.
 */
class m180216_102928_create_jp_address_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('jp_address', [
            'id' => $this->primaryKey(),
            'address_cd' => $this->string(),
            'prefecture_cd' => $this->string(),
            'city_ward_town_village_cd' => $this->string(),
            'town_area_cd' => $this->string(),
            'zipcode' => $this->string(),
            'office_flag' => $this->string(),
            'abolition_flag' => $this->string(),
            'prefecture' => $this->string(),
            'prefecture_kana' => $this->string(),
            'city_ward_town_village' => $this->string(),
            'city_ward_town_village_kana' => $this->string(),
            'town_area' => $this->string(),
            'town_area_kana' => $this->string(),
            'town_area_complement' => $this->string(),
            'kyoto_street_name' => $this->string(),
            'aza_cho_me' => $this->string(),
            'aza_cho_me_kana' => $this->string(),
            'remarks' => $this->string(),
            'office_name' => $this->string(),
            'office_name_kana' => $this->string(),
            'office_address' => $this->string(),
            'new_address_cd' => $this->string(),
        ]);
        $this->createIndex('jp_address-address_cd-idx', 'jp_address', 'address_cd');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('jp_address');
    }
}