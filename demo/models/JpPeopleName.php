<?php

namespace app\models;

use Codeception\Example;

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

    /**
     * @param JpPeopleName[] $lastNameList
     * @param JpPeopleName[] $firstNameList
     * @return \app\models\JpPeopleName
     */
    public static function getRandomFullName(&$lastNameList, &$firstNameList)
    {
        $lastName = self::getRandomRecord($lastNameList);
        $firstName = self::getRandomRecord($firstNameList);
        return new JpPeopleName([
            'kanji' => "{$lastName->kanji}　{$firstName->kanji}",
            'kana' => "{$lastName->kana}　{$firstName->kana}",
        ]);
    }

    /**
     * @param string $className
     * @param array $attrMap Mix between $key => $value and array (sub mapping).
     *                       Example
     *                           [
     *                               'kanji' => 'introducer_name', // Set introducer name
     *                               [ // Set this people name.
     *                                   'kanji' => 'name',
     *                                   'kana' => 'name_kana',
     *                               ],
     *                           ]
     * @param boolean $ignoreEmpty
     */
    public static function generateNameData($className, $attrMap, $ignoreEmpty = FALSE)
    {
        $lastNameList = static::getAllIdsCached(['type' => static::TYPE_LASTNAME]);
        $firstNameList = static::getAllIdsCached(['type' => static::TYPE_FIRSTNAME]);

        // Standardize $attrMap
        $mapIndividuals = [];
        $mapArr = [];
        foreach ($attrMap as $key => $value) {
            if (is_array($value)) {
                $mapArr[] = $value;
            } else {
                $mapIndividuals[$key] = $value;
            }
        }
        $attrMap = array_merge([$mapIndividuals], $mapArr);

        // Get all objects to be changed.
        $targetObjects = $className::find()->all();
        $nTargetObjects = count($targetObjects);
        // Update objects data.
        for ($i = 0; $i < $nTargetObjects; $i++) {
            $targetModel = $targetObjects[$i];
            foreach ($attrMap as $map) {
                // Gen random lastname and firstname.
                $jpPeopleName = static::getRandomFullName($lastNameList, $firstNameList);
                $jpPeopleName->changeData($targetModel, $map, $ignoreEmpty);
            }
            $targetModel->save();

            unset($targetObjects[$i]); // Free memory.
        }
    }
}
