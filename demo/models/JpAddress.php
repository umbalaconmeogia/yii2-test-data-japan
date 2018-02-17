<?php

namespace app\models;



/**
 * This is the model class for table "jp_address".
 *
 * @property int $id
 * @property int $address_cd
 * @property int $prefecture_cd
 * @property int $city_ward_town_village_cd
 * @property int $town_area_cd
 * @property string $zipcode
 * @property int $office_flag
 * @property int $abolition_flag
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
 * @property int $new_address_cd
 *
 * @property string $townAreaAndFollow Combination of ���� and ������
 * @property string $townAreaAndFollowKana
 * @property string $address Combination of add address's elements into a string.
 * @property string $addressKana
 */
class JpAddress extends BaseJpGenerateData
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
            [['address_cd', 'prefecture_cd', 'city_ward_town_village_cd', 'town_area_cd', 'office_flag', 'abolition_flag', 'new_address_cd'], 'integer'],
            [['zipcode', 'prefecture', 'prefecture_kana', 'city_ward_town_village', 'city_ward_town_village_kana', 'town_area', 'town_area_kana', 'town_area_complement', 'kyoto_street_name', 'aza_cho_me', 'aza_cho_me_kana', 'remarks', 'office_name', 'office_name_kana', 'office_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
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

    /**
     * @return string
     */
    public function getTownAreaAndFollow()
    {
        $fields = [];
        if ($this->office_address) {
            $fields[] = 'office_address';
        } else {
            $fields[] = 'town_area';
            $fields[] = 'aza_cho_me';
        }
        return $this->joinFieldValues($fields);
    }

    /**
     * @return string
     */
    public function getTownAreaAndFollowKana()
    {
        $fields = [];
        $fields[] = 'town_area';
        $fields[] = 'aza_cho_me';
        return $this->joinFieldValues($fields);
    }

    /**
     * Get address by combinating all address elements.
     * @return string
     */
    public function getAddress()
    {
        $fields = [
            'prefecture',
            'city_ward_town_village',
            'townAreaAndFollow',
        ];
        return $this->joinFieldValues($fields);
    }

    public function getAddressKana()
    {
        $result = [];
        $fields = [
            'prefecture_kana',
            'city_ward_town_village_kana',
            'townAreaAndFollowKana',
        ];
        return $this->joinFieldValues($fields);
    }

    public static function officeFlagOptionArr()
    {
        return [
            0 => 'NOT 事業所',
            1 => '事業所である',
        ];
    }
}
