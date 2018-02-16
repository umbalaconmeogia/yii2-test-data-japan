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
            'id' => 'ID',
            'address_cd' => '�Z��CD',
            'prefecture_cd' => '�s���{��CD',
            'city_ward_town_village_cd' => '�s�撬��CD',
            'town_area_cd' => '����CD',
            'zipcode' => '�X�֔ԍ�',
            'office_flag' => '���Ə��t���O',
            'abolition_flag' => '�p�~�t���O',
            'prefecture' => '�s���{��',
            'prefecture_kana' => '�s���{���J�i',
            'city_ward_town_village' => '�s�撬��',
            'city_ward_town_village_kana' => '�s�撬���J�i',
            'town_area' => '����',
            'town_area_kana' => '����J�i',
            'town_area_complement' => '����⑫',
            'kyoto_street_name' => '���s�ʂ薼',
            'aza_cho_me' => '������',
            'aza_cho_me_kana' => '�����ڃJ�i',
            'remarks' => '�⑫',
            'office_name' => '���Ə���',
            'office_name_kana' => '���Ə����J�i',
            'office_address' => '���Ə��Z��',
            'new_address_cd' => '�V�Z��CD',
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
