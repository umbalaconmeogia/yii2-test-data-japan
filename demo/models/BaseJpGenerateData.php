<?php

namespace app\models;

use batsg\models\BaseModel;
use Yii;
use yii\db\ActiveRecord;

class BaseJpGenerateData extends BaseModel
{

    public static function generateData($className, $attrMap, $sourceCondition = [])
    {
        // Get all JpAddress ids.
        $sourceRecords = static::find()->select(['id'])->where($sourceCondition)->limit(100)->all();
        $sourceIds = static::getArrayOfFieldValue($sourceRecords);
        $sourceRecords = NULL; // Does this help free memory?

        // Get all objects to be changed.
        $targetObjects = $className::find()->all();

        // Update objects data.
//         \Yii::$app->db->transaction(function() use ($targetObjects, $sourceIds, $attrMap) {
            foreach ($targetObjects as $targetModel) {
                // Gen a random Source.
                $sourceRecord = static::findOne(['id' => $sourceIds[mt_rand(0, count($sourceIds) - 1)]]);
                // Change specified field value.
                $sourceRecord->changeData($targetModel, $attrMap);
            }
//         });
    }

    /**
     * @param ActiveRecord $targetModel
     * @param string[] $attrMap Array define pair of models' attribute.
     *                    If both attributes are same, then it may be defined as string element,
     *                    else it should be defined as $sourceField => $destField pair.
     * @param boolean $save Save $targetModel or not.
     */
    public function changeData(ActiveRecord $targetModel, $attrMap, $save = TRUE)
    {
        foreach ($attrMap as $key => $destField) {
            $sourceField = is_numeric($key) ? $destField : $key;
            $targetModel->$destField = $this->$sourceField;
        }
        if ($save) {
            $targetModel->save();
        }
    }
}
