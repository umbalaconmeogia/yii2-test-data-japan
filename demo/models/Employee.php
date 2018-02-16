<?php

namespace app\models;

use batsg\models\BaseModel;
use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $postal_code
 * @property string $address
 * @property string $tel
 * @property string $fax
 *
 * @property Company $company
 */
class Employee extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id'], 'integer'],
            [['name', 'postal_code', 'address', 'tel', 'fax'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'name' => 'Name',
            'postal_code' => 'Postal Code',
            'address' => 'Address',
            'tel' => 'Tel',
            'fax' => 'Fax',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}
