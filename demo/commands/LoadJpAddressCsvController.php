<?php
namespace app\commands;

use app\models\JpAddress;
use batsg\helpers\CsvWithHeader;

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
            \Yii::$app->dbTestDataJapan->transaction(function() use ($csv) {
                /** @var $csv CsvWithHeader */
                $csv->skipRow(); // Ignore the second row (the title row).

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
