<?php
namespace app\commands;

use batsg\helpers\CsvWithHeader;
use app\models\JpAddress;

/**
 * This command echoes the first argument that you have entered.
 */
class LoadJpAddressCsvController extends BaseCsvLoadingController
{
    /**
     * List of attributes of JpAddress
     * @var string[]
     */
    private $jpAddressAttributes;

    /**
     * This command echoes what you have entered as the message.
     * Syntax
     *   ./yii load-jp-address-csv --csvFile=./data.csv
     *
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {
        // Set attribute list.
        $jpAddress = new JpAddress();
        $this->jpAddressAttributes = array_keys($jpAddress->attributes);

        CsvWithHeader::read($this->csvFile, function($csv) {
            \Yii::$app->db->transaction(function() use ($csv) {
                /** @var $csv CsvWithHeader */
                $csv->skipRow(); // Ignore the second row (the title row).
// $csv->loadRow();
// $attr = $csv->getRowAsAttributes();
// foreach ($attr as $attribute => $label) {
//     echo "'$attribute' => '$label',\n";
// }

                while ($csv->loadRow() !== FALSE) {
                    $attr = $csv->getRowAsAttributes();
                    $jpAddress = $this->addJpAddress($attr);
                }
            });
        });
    }

    /**
     * @param array $attr
     * @return JpAddress
     */
    private function addJpAddress($attr)
    {
        $jpAddress = JpAddress::findOneCreateNew([
            'address_cd' => $attr['address_cd'],
        ]);
        $jpAddress->setAttributeFromArray($attr, $this->jpAddressAttributes);
        $jpAddress->saveThrowError();
    }
}
