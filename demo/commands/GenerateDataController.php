<?php
namespace app\commands;

use yii\console\Controller;
use app\models\JpAddress;
use app\models\Company;

/**
 * Generate address and name data.
 */
class GenerateDataController extends Controller
{
    /**
     * Syntax
     *   ./yii generate-data/address
     */
    public function actionAddress()
    {
        JpAddress::generateData(Company::className(), [
            'zipcode' => 'postal_code',
            'prefecture',
            'city_ward_town_village' => 'city',
            'townAreaAndFollow' => 'town',
            'office_name' => 'name',
        ], [
            'office_flag' => "1",
        ]);
    }

    /**
     * Syntax
     *   ./yii generate-data/people-name
     */
    public function actionPeopleName()
    {
        JpAddress::generateData(Company::className(), [
            'zipcode' => 'postal_code',
            'prefecture',
            'city_ward_town_village' => 'city',
            'townAreaAndFollow' => 'town',
            'office_name' => 'name',
        ], [
            'office_flag' => "1",
        ]);
    }
}
