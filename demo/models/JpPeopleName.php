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

    public static function generateNameData($className, $destKanjiField = 'name', $destKanaField = 'name_kana')
    {
        $lastNameIds = static::getAllIds(['type' => static::TYPE_LASTNAME]);
        $firstNameIds = static::getAllIds(['type' => static::TYPE_FIRSTNAME]);

        // Get all objects to be changed.
        $targetObjects = $className::find()->all();

        // Update objects data.
        foreach ($targetObjects as $targetModel) {
            // Gen random lastname and firstname.
            $lastName = self::getRandomRecord($lastNameIds);
            $firstName = self::getRandomRecord($firstNameIds);
            $targetModel->$destKanjiField = "{$lastName->kanji}　{$firstName->kanji}";
            if ($destKanaField) {
                $targetModel->$destKanaField = "{$lastName->kana}　{$firstName->kana}";
            }
            $targetModel->save();
        }
    }
}
