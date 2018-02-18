<?php

namespace app\models;

use batsg\models\BaseModel;
use yii\db\ActiveRecord;

class BaseJpGenerateData extends BaseModel
{
    protected static $jpDataCache = [];

    public static function clearCache($key = NULL)
    {
        if ($key && isset(static::$jpDataCache[$key])) {
            unset(static::$jpDataCache[$key]);
        } else {
            static::$jpDataCache = NULL;
        }
    }

    /**
     * Search for models that match $searchCondition.
     * @param array $searchCondition
     * @return array Mapping between model id and the models found.
     */
    protected static function getAllIdsCached($searchCondition = [])
    {
        $cacheKey = static::getCacheKey($searchCondition);
        echo "Get data for cache $cacheKey\n";

        // Get data from DB if not cached (and cache it).
        if (!isset(self::$jpDataCache[$cacheKey])) {
            echo "Generate data for cache $cacheKey\n";
            $sourceRecords = static::find()->where($searchCondition)->all();
            self::$jpDataCache[$cacheKey] = static::hashModels($sourceRecords);
        }

        return self::$jpDataCache[$cacheKey];
    }

    /**
     * Generate caching key based on search condition.
     * @param array $searchCondition
     * @return string
     */
    private static function getCacheKey($searchCondition)
    {
        // Generate cache key.
        $cacheKey = [];
        $cacheKey[] = 'CACHE_ALL_IDS';
        $cacheKey[] = static::tableName();
        if ($searchCondition) {
            foreach ($searchCondition as $key => $value) {
                $sourceKey = is_numeric($key) ? $value : $key;
                $cacheKey[] = "{$sourceKey}=>{$value}";
            }
        }
        return join('$', $cacheKey);
    }

    /**
     * Get a random ActiveRecord that ID is in an ID list.
     * @param int[] $ids
     * @return ActiveRecord
     */
    protected static function getRandomRecord(&$records)
    {
        $ids = array_keys($records);
        return $records[$ids[mt_rand(0, count($records) - 1)]];
    }

    /**
     * @param string $className
     * @param string[[] $attrMap
     * @param array $sourceCondition
     * @param boolean $ignoreEmpty If TRUE, only set a field if its previous value is not empty.
     */
    public static function generateData($className, $attrMap, $sourceCondition = [], $ignoreEmpty = FALSE)
    {
        $sourceRecordList = static::getAllIdsCached($sourceCondition);

        // Get all objects to be changed.
        $targetObjects = $className::find()->all();
        $nTargetObjects = count($targetObjects);

        // Update objects data.
        for ($i = 0; $i < $nTargetObjects; $i++) {
            $targetModel = $targetObjects[$i];
            // Gen a random Source.
            $sourceRecord = static::getRandomRecord($sourceRecordList);
            // Change specified field value.
            $sourceRecord->changeData($targetModel, $attrMap, $ignoreEmpty);

            unset($targetObjects[$i]); // Free memory
        }
    }

    /**
     * @param ActiveRecord $targetModel
     * @param string[] $attrMap Array define pair of models' attribute.
     *                    If both attributes are same, then it may be defined as string element,
     *                    else it should be defined as $sourceField => $destField pair.
     * @param boolean $ignoreEmpty If TRUE, only set a field if its previous value is not empty.
     */
    public function changeData(ActiveRecord $targetModel, $attrMap, $ignoreEmpty = FALSE)
    {
        echo "Change data of " . $targetModel->tableName() . "({$targetModel->id})\n";
        foreach ($attrMap as $key => $destField) {
            $sourceField = is_numeric($key) ? $destField : $key;
            if ($targetModel->$destField || !$ignoreEmpty) {
                $targetModel->$destField = $this->$sourceField;
            }
        }
        $targetModel->save();
    }

    public static function getDb() {
        return \Yii::$app->dbTestDataJapan;
    }
}
