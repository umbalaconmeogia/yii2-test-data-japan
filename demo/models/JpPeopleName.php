<?php

namespace app\models;

/**
 * This is the model class for table "jp_people_name".
 *
 * @property int $id
 * @property string $kanji
 * @property string $kana
 * @property int $type
 */
class JpPeopleName extends BaseJpGenerateData
{
    const TYPE_LASTNAME = 1;
    const TYPE_FIRSTNAME = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jp_people_name';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['kanji', 'kana'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kanji' => '漢字',
            'kana' => 'カナ',
            'type' => '種別',
        ];
    }

    public static function typeOptionArr()
    {
        return [
            self::TYPE_LASTNAME => '姓',
            self::TYPE_FIRSTNAME => '名',
        ];
    }
}
