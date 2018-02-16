<?php
namespace app\commands;

use batsg\helpers\CsvWithHeader;
use app\models\JpAddress;
use app\models\JpPeopleName;

/**
 * This command echoes the first argument that you have entered.
 */
class LoadJpPeopleNameCsvController extends BaseCsvLoadingController
{
    /**
     * This command echoes what you have entered as the message.
     * Syntax
     *   ./yii load-jp-people-name-csv --csvFile=./data.csv
     *
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {
        CsvWithHeader::read($this->csvFile, function($csv) {
            \Yii::$app->db->transaction(function() use ($csv) {
                /** @var $csv CsvWithHeader */
                while ($csv->loadRow() !== FALSE) {
                    $attr = $csv->getRowAsAttributes();
                    $jpPeopleName = $this->addJpPeopleName($attr);
                }
            });
        });
    }

    /**
     * @param array $attr
     * @return JpPeopleName
     */
    private function addJpPeopleName($attr)
    {
        $attr['type'] = $attr['typeStr'] == '姓' ? JpPeopleName::TYPE_LASTNAME : JpPeopleName::TYPE_FIRSTNAME;
        $jpPeopleName = JpPeopleName::findOneCreateNew([
            'kana' => $attr['kana'],
            'kanji' => $attr['kanji'],
            'type' => $attr['type'],
        ]);
        $jpPeopleName->saveThrowError();
    }
}
