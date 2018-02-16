<?php

namespace app\models;

use batsg\models\BaseModel;
use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $name
 * @property string $postal_code
 * @property string $prefecture
 * @property string $city
 * @property string $town
 * @property string $tel
 * @property string $fax
 *
 * @property Employee[] $employees
 */
class Company extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'postal_code', 'prefecture', 'city', 'town', 'tel', 'fax'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'postal_code' => 'Postal Code',
            'prefecture' => 'Prefecture',
            'city' => 'City',
            'town' => 'Town',
            'tel' => 'Tel',
            'fax' => 'Fax',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['company_id' => 'id']);
    }
}
