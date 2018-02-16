<?php

namespace app\models;

use Yii;
use batsg\models\BaseModel;

/**
 * This is the model class for table "jp_address".
 *
 * @property int $id
 * @property string $address_cd
 * @property string $prefecture_cd
 * @property string $city_ward_town_village_cd
 * @property string $town_area_cd
 * @property string $zipcode
 * @property string $office_flag
 * @property string $abolition_flag
 * @property string $prefecture
 * @property string $prefecture_kana
 * @property string $city_ward_town_village
 * @property string $city_ward_town_village_kana
 * @property string $town_area
 * @property string $town_area_kana
 * @property string $town_area_complement
 * @property string $kyoto_street_name
 * @property string $aza_cho_me
 * @property string $aza_cho_me_kana
 * @property string $remarks
 * @property string $office_name
 * @property string $office_name_kana
 * @property string $office_address
 * @property string $new_address_cd
 */
class JpAddress extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jp_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address_cd', 'prefecture_cd', 'city_ward_town_village_cd', 'town_area_cd', 'zipcode', 'office_flag', 'abolition_flag', 'prefecture', 'prefecture_kana', 'city_ward_town_village', 'city_ward_town_village_kana', 'town_area', 'town_area_kana', 'town_area_complement', 'kyoto_street_name', 'aza_cho_me', 'aza_cho_me_kana', 'remarks', 'office_name', 'office_name_kana', 'office_address', 'new_address_cd'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address_cd' => '住所CD',
            'prefecture_cd' => '都道府県CD',
            'city_ward_town_village_cd' => '市区町村CD',
            'town_area_cd' => '町域CD',
            'zipcode' => '郵便番号',
            'office_flag' => '事業所フラグ',
            'abolition_flag' => '廃止フラグ',
            'prefecture' => '都道府県',
            'prefecture_kana' => '都道府県カナ',
            'city_ward_town_village' => '市区町村',
            'city_ward_town_village_kana' => '市区町村カナ',
            'town_area' => '町域',
            'town_area_kana' => '町域カナ',
            'town_area_complement' => '町域補足',
            'kyoto_street_name' => '京都通り名',
            'aza_cho_me' => '字丁目',
            'aza_cho_me_kana' => '字丁目カナ',
            'remarks' => '補足',
            'office_name' => '事業所名',
            'office_name_kana' => '事業所名カナ',
            'office_address' => '事業所住所',
            'new_address_cd' => '新住所CD',
        ];
    }
}
