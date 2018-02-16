<?php

namespace app\models;

use batsg\models\BaseModel;
use yii\db\ActiveRecord;

class BaseJpGenerateData extends BaseModel
{
    /**
     * Get IDs of ActiveRecord that match $searchCondition.
     * @param array $searchCondition Condition used in where().
     * @return int[]
     */
    protected static function getAllIds($searchCondition = [])
    {
        $sourceRecords = static::find()->select(['id'])->where($searchCondition)->limit(10)->all();
        $sourceIds = static::getArrayOfFieldValue($sourceRecords);
        $sourceRecords = NULL; // Does this help free memory?
        return $sourceIds;
    }

    /**
     * Get a random ActiveRecord that ID is in an ID list.
     * @param int[] $ids
     * @return ActiveRecord
     */
    protected static function getRandomRecord(&$ids)
    {
        return static::findOne(['id' => $ids[mt_rand(0, count($ids) - 1)]]);
    }

    public static function generateData($className, $attrMap, $sourceCondition = [])
    {
        $sourceIds = self::getAllIds($sourceCondition);

        // Get all objects to be changed.
        $targetObjects = $className::find()->all();

        // Update objects data.
        foreach ($targetObjects as $targetModel) {
            // Gen a random Source.
            $sourceRecord = static::getRandomRecord($sourceIds);
            // Change specified field value.
            $sourceRecord->changeData($targetModel, $attrMap);
        }
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
