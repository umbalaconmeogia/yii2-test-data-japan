<?php
namespace app\commands;

use yii\console\Controller;
use app\models\JpAddress;
use app\models\Company;
use app\models\Employee;
use app\models\JpPeopleName;

/**
 * Generate address and name data.
 */
class GenerateDataController extends Controller
{
    /**
     * Syntax
     *   ./yii generate-data/company
     */
    public function actionCompany()
    {
        JpAddress::generateData(Company::className(), [
            'zipcode' => 'postal_code',
            'prefecture',
            'city_ward_town_village' => 'city',
            'townAreaAndFollow' => 'town',
            'office_name' => 'name',
        ], [
            'office_flag' => 1,
        ]);
        JpAddress::clearCache();
    }

    /**
     * Syntax
     *   ./yii generate-data/employee
     */
    public function actionEmployee()
    {
        JpAddress::generateData(Employee::className(), [
            'zipcode' => 'postal_code',
            'address',
        ], [
            'office_flag' => 1,
        ]);
        JpAddress::clearCache();
        JpPeopleName::generateNameData(Employee::className(), [
            'kanji' => 'name',
            'kana' => 'name_kana',
        ]);
    }
}
